<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\CMS\Entities\CmsSection;
use Modules\CMS\Entities\CmsSectionItem;

class Teachers extends Component
{

    protected $teachers_presentation;
    protected $teachers_information;

    public function __construct()
    {
        $this->teachers_presentation = CmsSection::where('component_id', 'docentes_presemtacion_7')
            ->join('cms_section_items', 'section_id', 'cms_sections.id')
            ->join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
            ->select(
                'cms_items.content',
                'cms_section_items.position'
            )
            ->orderBy('cms_section_items.position')
            ->get();
            
        $this->teachers_information = CmsSectionItem::with('item.items')->where('section_id', 8)->get();
    }
    
    public function render(): View|Closure|string
    {
        return view('components.teachers', [
            'teachers_presentation' => $this->teachers_presentation,
            'teachers_information' => $this->teachers_information
        ]);
    }
}
