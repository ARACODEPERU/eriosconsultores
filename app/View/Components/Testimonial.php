<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\CMS\Entities\CmsSection;
use Modules\CMS\Entities\CmsSectionItem;
class Testimonial extends Component
{
    
    protected $testimonial_presentation;
    protected $testimonial_information;

    public function __construct()
    {
        $this->testimonial_presentation = CmsSection::where('component_id', 'testimonios_presentacion_9')
            ->join('cms_section_items', 'section_id', 'cms_sections.id')
            ->join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
            ->select(
                'cms_items.content',
                'cms_section_items.position'
            )
            ->orderBy('cms_section_items.position')
            ->get();
            
        $this->testimonial_information = CmsSectionItem::with('item.items')->where('section_id', 10)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.testimonial', [
            'testimonial_presentation' => $this->testimonial_presentation,
            'testimonial_information' => $this->testimonial_information
        ]);
    }
}
