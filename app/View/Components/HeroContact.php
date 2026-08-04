<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\CMS\Entities\CmsSection;

class HeroContact extends Component
{
    protected $hero;

    public function __construct()
    {
        $this->hero = CmsSection::where('component_id', 'hero_contactanos_14')
            ->join('cms_section_items', 'section_id', 'cms_sections.id')
            ->join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
            ->select(
                'cms_items.content',
                'cms_section_items.position'
            )
            ->orderBy('cms_section_items.position')
            ->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.hero-contact', [
            'hero' => $this->hero
        ]);
    }
}
