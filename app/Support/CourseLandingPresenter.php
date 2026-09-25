<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaCourseLanding;
use Modules\Academic\Entities\AcaTeacher;
use Modules\CMS\Entities\CmsTestimony;
use Modules\Onlineshop\Entities\OnliItem;

/**
 * Datos de apoyo para las secciones publicas de una landing de curso
 * (resources/views/components/courselanding/*).
 *
 * Es el equivalente ERIOS de lo que la landing de referencia resuelve dentro
 * de su WebPageController: docentes del carrusel, paleta de resultados, item de
 * tienda para el carrito, testimonios aprobados y schema.org.
 *
 * Las secciones siguen leyendo su JSON desde `aca_course_landings`; este
 * presentador solo entrega lo que no viene en el JSON (relaciones de BD).
 */
class CourseLandingPresenter
{
    private const FALLBACK_LOGO = 'themes/webpage/images/logo-2.png';

    /**
     * Paleta ERIOS para las tarjetas de resultados (borde e icono por tarjeta).
     *
     * @return array<int, string>
     */
    public static function colors(): array
    {
        $palette = [
            '#004aad', // Azul institucional
            '#ffc600', // Amarillo institucional
            '#07294d', // Navy
            '#0e4a8f', // Azul medio
            '#e30613', // Rojo CTA
            '#00ab55', // Verde confirmado
            '#f8aa4b', // Naranja
            '#4a86e8', // Azul claro
        ];

        $colors = [];

        for ($i = 0; $i < 16; $i++) {
            $colors[] = $palette[$i % count($palette)];
        }

        return $colors;
    }

    /**
     * Docentes del carrusel "staff". Toma los ids de `staff_section.teachers`,
     * respeta los textos escritos en el editor (teacher_names / teacher_ocupation)
     * y completa con los datos reales del docente.
     *
     * @return array<int, array{name: string, role: string, img: string, resumes: array<int, array{type: ?string, description: string}>}>
     */
    public static function teachersPremium(?AcaCourseLanding $landing): array
    {
        $staff = self::sectionArray($landing?->staff_section);
        $rows = $staff['teachers'] ?? [];

        if (!is_array($rows) || $rows === []) {
            return [];
        }

        $ids = collect($rows)
            ->pluck('teacher_id')
            ->filter()
            ->unique()
            ->values();

        $teachers = $ids->isEmpty()
            ? collect()
            : AcaTeacher::with(['person', 'resumes'])->whereIn('id', $ids)->get()->keyBy('id');

        $premium = [];

        foreach ($rows as $row) {
            $teacher = $teachers->get($row['teacher_id'] ?? null);
            $person = $teacher?->person;

            if (!$teacher || !$person) {
                continue;
            }

            $name = filled($row['teacher_names'] ?? null)
                ? $row['teacher_names']
                : ($person->formatted_name ?: trim(($person->names ?? '') . ' ' . ($person->father_lastname ?? '')));

            $role = filled($row['teacher_ocupation'] ?? null)
                ? $row['teacher_ocupation']
                : ($person->ocupacion ?? '');

            $premium[] = [
                'name' => $name,
                'role' => $role,
                'img' => filled($person->image)
                    ? self::image($person->image)
                    : 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&rounded=true&size=200',
                'resumes' => $teacher->resumes
                    ->map(fn ($resume) => [
                        'type' => $resume->type ?? null,
                        'description' => trim((string) ($resume->description ?? '')),
                    ])
                    ->filter(fn (array $resume) => $resume['description'] !== '')
                    ->values()
                    ->all(),
            ];
        }

        return $premium;
    }

    /**
     * Id del item de tienda del curso (para el carrito en localStorage).
     */
    public static function onliItemId(?AcaCourseLanding $landing): ?int
    {
        $course = $landing?->course;

        if (!$course) {
            return null;
        }

        $id = OnliItem::where('item_id', $course->id)->value('id');

        return $id ? (int) $id : null;
    }

    /**
     * Testimonios publicables (aprobados, visibles y con texto) de un curso.
     */
    public static function testimonials(?AcaCourse $course): Collection
    {
        if (!$course) {
            return collect();
        }

        return CmsTestimony::query()
            ->with(['course.category', 'product', 'student.person'])
            ->where('course_id', $course->id)
            ->where('approval_status', CmsTestimony::STATUS_APPROVED)
            ->where('status', true)
            ->whereNotNull('description')
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (CmsTestimony $testimony) => self::payload($testimony))
            ->values();
    }

    /**
     * Normaliza un testimonio para las vistas publicas.
     *
     * @return array<string, mixed>
     */
    public static function payload(CmsTestimony $testimony): array
    {
        $course = $testimony->course;
        $product = $testimony->entitie === OnliItem::class ? $testimony->product : null;
        $studentName = optional(optional($testimony->student)->person)->full_name;

        $author = $testimony->author_name ?: $studentName ?: 'Alumno ERIOS';
        $role = $testimony->author_role ?: ($course?->type_description ?: 'Egresado');
        $program = $course?->description ?: ($testimony->item_label ?: ($product?->name ?: $testimony->title));

        $cover = null;
        if ($course && $course->image) {
            $cover = self::image($course->image);
        } elseif ($product) {
            $cover = $product->image;
        }

        return [
            'id' => $testimony->id,
            'author' => $author,
            'role' => $role,
            'program' => $program,
            'category' => $course?->category?->description ?: 'Testimonios',
            'course_id' => $testimony->course_id ? (int) $testimony->course_id : null,
            'rating' => (int) ($testimony->rating ?: 5),
            'quote' => $testimony->description,
            'photo' => filled($testimony->image) ? self::image($testimony->image) : null,
            'cover' => $cover,
            'video' => self::cleanIframe($testimony->video),
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($author) . '&size=140&rounded=true&background=004aad&color=ffffff&bold=true',
            'date' => optional($testimony->created_at)->format('d/m/Y'),
            'created_at_iso' => optional($testimony->created_at)->toIso8601String(),
        ];
    }

    /**
     * Schema markup (JSON-LD) de la landing del curso, con valoracion agregada.
     *
     * @param  iterable<int, array<string, mixed>>|null  $testimonials
     * @return array<string, mixed>|null
     */
    public static function schema(?AcaCourseLanding $landing, ?iterable $testimonials = null): ?array
    {
        $course = $landing?->course;

        if (!$landing || !$course) {
            return null;
        }

        $url = route('course_url_slug', $landing->url_slug);

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Course',
            'name' => $course->description,
            'description' => Str::limit(trim(strip_tags((string) $course->description)), 300, ''),
            'url' => $url,
            'inLanguage' => 'es',
            'provider' => [
                '@type' => 'Organization',
                'name' => 'ERIOS CONSULTORES',
                'url' => url('/'),
            ],
        ];

        if ($course->image) {
            $schema['image'] = self::image($course->image);
        }

        if ($course->category?->description) {
            $schema['about'] = $course->category->description;
        }

        $testimonials = collect($testimonials ?? self::testimonials($course));

        if ($testimonials->isNotEmpty()) {
            $schema['aggregateRating'] = self::aggregateRatingSchema($testimonials);
            $schema['review'] = $testimonials
                ->take(20)
                ->map(fn (array $testimonio) => self::reviewSchema($testimonio))
                ->values()
                ->all();
        }

        return $schema;
    }

    /**
     * Convierte un color hexadecimal (#004aad, #fc0) a rgba con la opacidad dada.
     * Se usa para los fondos suaves de las tarjetas de resultados.
     */
    public static function rgba(?string $color, float $alpha = 0.12): string
    {
        $hex = ltrim(trim((string) $color), '#');

        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        if (!preg_match('/^[0-9a-fA-F]{6}$/', $hex)) {
            $hex = '004aad';
        }

        [$red, $green, $blue] = array_map(
            fn (string $channel) => hexdec($channel),
            str_split($hex, 2)
        );

        return sprintf('rgba(%d, %d, %d, %s)', $red, $green, $blue, rtrim(rtrim(number_format($alpha, 2, '.', ''), '0'), '.'));
    }

    /**
     * Normaliza el nombre de un icono al formato Font Awesome 5 que usa el sitio.
     *
     * El editor de landings guarda nombres estilo FA6 ("fa-solid fa-users",
     * "fa-users" o "fas fa-users"); el tema publico carga Font Awesome 5.1, asi
     * que se limpia el prefijo y se deja solo el nombre del icono.
     */
    public static function icon(?string $icon, string $fallback = 'fa-circle'): string
    {
        $raw = trim((string) $icon);

        if ($raw === '') {
            return $fallback;
        }

        $name = preg_replace('/\b(fa-solid|fa-regular|fa-light|fa-thin|fa-duotone|fa-brands|fas|far|fal|fat|fad|fab|fa)\b/i', ' ', $raw) ?? '';
        $name = trim(preg_replace('/\s+/', '-', trim($name)) ?? '', '-');

        return $name !== '' ? $name : $fallback;
    }

    /**
     * Resuelve la URL publica de un archivo. Acepta rutas relativas de storage,
     * rutas ya servidas desde /themes o URLs absolutas (OnliItem ya devuelve URLs).
     */
    public static function image(?string $path, ?string $fallback = null): string
    {
        $path = trim((string) $path);

        if ($path === '') {
            return asset($fallback ?: self::FALLBACK_LOGO);
        }

        if (Str::startsWith($path, ['http://', 'https://', '//', 'data:'])) {
            return $path;
        }

        if (Str::startsWith($path, ['/storage/', '/themes/', 'storage/', 'themes/'])) {
            return asset(ltrim($path, '/'));
        }

        return asset('storage/' . $path);
    }

    /**
     * Devuelve una seccion JSON como arreglo (el cast ya lo hace, aqui se
     * contempla por si llega como string desde un editor externo).
     *
     * @return array<string, mixed>
     */
    public static function sectionArray(mixed $section): array
    {
        if (is_string($section)) {
            $section = json_decode($section, true);
        }

        return is_array($section) ? $section : [];
    }

    /**
     * Devuelve solo los items validos (arreglos no vacios) de una seccion.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function items(mixed $section): array
    {
        $items = self::sectionArray($section)['items'] ?? [];

        if (!is_array($items)) {
            return [];
        }

        return array_values(array_filter($items, fn ($item) => is_array($item) && $item !== []));
    }

    /**
     * Arma una reseña de schema.org (JSON-LD) a partir de un testimonio normalizado.
     *
     * @param  array<string, mixed>  $testimony
     * @return array<string, mixed>
     */
    private static function reviewSchema(array $testimony, string $itemType = 'Course'): array
    {
        $review = [
            '@type' => 'Review',
            'author' => [
                '@type' => 'Person',
                'name' => $testimony['author'] ?? 'Alumno ERIOS',
            ],
            'reviewRating' => [
                '@type' => 'Rating',
                'ratingValue' => $testimony['rating'] ?? 5,
                'bestRating' => 5,
                'worstRating' => 1,
            ],
            'reviewBody' => Str::limit(trim(strip_tags((string) ($testimony['quote'] ?? ''))), 500, ''),
            'itemReviewed' => [
                '@type' => $itemType,
                'name' => ($testimony['program'] ?? null) ?: 'ERIOS CONSULTORES',
            ],
        ];

        if (!empty($testimony['created_at_iso'])) {
            $review['datePublished'] = $testimony['created_at_iso'];
        }

        return $review;
    }

    /**
     * Valoracion agregada (schema.org) a partir de una coleccion de testimonios.
     *
     * @param  iterable<int, array<string, mixed>>  $testimonies
     * @return array<string, mixed>|null
     */
    private static function aggregateRatingSchema(iterable $testimonies, ?float $average = null): ?array
    {
        $collection = collect($testimonies);
        $count = $collection->count();

        if ($count === 0) {
            return null;
        }

        if ($average === null) {
            $ratings = $collection->pluck('rating')->filter();
            $average = $ratings->isNotEmpty() ? round((float) $ratings->avg(), 1) : 5.0;
        }

        return [
            '@type' => 'AggregateRating',
            'ratingValue' => $average,
            'reviewCount' => $count,
            'bestRating' => 5,
            'worstRating' => 1,
        ];
    }

    /**
     * Solo se acepta el video de un testimonio si contiene un <iframe>; se
     * eliminan <script> y manejadores inline (on*) por seguridad.
     */
    private static function cleanIframe(?string $html): ?string
    {
        $html = trim((string) $html);

        if ($html === '' || !Str::contains($html, '<iframe')) {
            return null;
        }

        $html = preg_replace('#<script\b[^>]*>.*?</script>#is', '', $html) ?? '';
        $html = preg_replace('#\son\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)#i', '', $html) ?? '';
        $html = trim($html);

        return Str::contains($html, '<iframe') ? $html : null;
    }
}
