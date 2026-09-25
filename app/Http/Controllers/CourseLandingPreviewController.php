<?php

namespace App\Http\Controllers;

use App\Support\CourseLandingPresenter;
use Illuminate\Http\Request;
use Modules\Academic\Entities\AcaCourseLanding;

/**
 * Vista aislada para revisar las secciones de landing de curso
 * (resources/views/components/courselanding) sin tocar la pagina publica
 * /curso/{slug}, que sigue usando pages/curso-descripcion.blade.php.
 */
class CourseLandingPreviewController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $landing = AcaCourseLanding::with([
            'course.category',
            'course.modality',
            'course.brochure',
        ])->where('url_slug', $slug)->firstOrFail();

        $testimonials = CourseLandingPresenter::testimonials($landing->course);

        return view('pages.curso-landing-preview', [
            'landing' => $landing,
            'teachers_premium' => CourseLandingPresenter::teachersPremium($landing),
            'colors' => CourseLandingPresenter::colors(),
            'onli_item_id' => CourseLandingPresenter::onliItemId($landing),
            'course_testimonials' => $testimonials,
            'course_schema' => CourseLandingPresenter::schema($landing, $testimonials),
            'only' => $this->requestedSections($request->query('solo')),
        ]);
    }

    /**
     * Convierte ?solo=hero,faq en la lista de secciones a mostrar (null = todas).
     *
     * @return array<int, string>|null
     */
    private function requestedSections(?string $solo): ?array
    {
        if (!filled($solo)) {
            return null;
        }

        $requested = collect(explode(',', $solo))
            ->map(fn (string $section) => trim($section))
            ->filter()
            ->all();

        // El orden y el catalogo de secciones viven en config/course_landing.php:
        // aqui solo se filtran las que el revisor pidio con ?solo=.
        $sections = array_values(array_intersect($requested, (array) config('course_landing.sections', [])));

        return $sections !== [] ? $sections : null;
    }
}
