<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\CMS\Entities\CmsSection;

class CeoProfile extends Component
{
    protected $data;

    public function __construct(public bool $showLink = false)
    {
        $section = CmsSection::with([
            'items' => fn ($q) => $q->orderBy('position'),
            'items.item.items' => fn ($q) => $q->orderBy('position'),
        ])
            ->where('component_id', 'ceo_presentacion')
            ->first();

        $fields = collect();

        if ($section && ($first = $section->items->first())) {
            $fields = $first->item?->items?->values() ?? collect();
        }

        $get = fn (int $i, string $default = '') => $fields->get($i)?->content ?: $default;

        $this->data = [
            'photo'    => $get(0),
            'name'     => $get(1, 'Esther Ríos Córdova'),
            'role'     => $get(2, 'CEO & Fundadora'),
            'summary'  => $get(3, 'Contadora Pública Colegiada con Maestría en Tributación y Auditoría, y más de una década de trayectoria en el sector público y privado.'),
            'body'     => $get(4, 'Ex Auditora de SUNAT y fundadora de ERIOS CONSULTORES, lidera un equipo especializado en cumplir con las normativas tributarias vigentes, con un enfoque en transparencia y control en cada proceso.'),
            'quote'    => $get(5, 'La transparencia y el control son la base de la confianza empresarial.'),
            'stat1num' => $get(6, '12+'),
            'stat1lbl' => $get(7, 'Años de experiencia'),
            'stat2num' => $get(8, '500+'),
            'stat2lbl' => $get(9, 'Empresas asesoradas'),
        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.ceo-profile', [
            'd'        => $this->data,
            'showLink' => $this->showLink,
        ]);
    }
}
