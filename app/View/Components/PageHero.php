<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\CMS\Entities\CmsSection;

class PageHero extends Component
{
    protected $eyebrow;
    protected $title;
    protected $subtitle;
    protected $heroComponent;
    protected $fallbackImage;

    public function __construct(
        $eyebrow = 'ERIOS Consultores',
        $title = null,
        $subtitle = null,
        $heroComponent = 'hero_nosotros_11',
        $fallbackImage = 'bg-2.jpg'
    ) {
        $this->eyebrow = $eyebrow;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->heroComponent = $heroComponent;
        $this->fallbackImage = $fallbackImage;
    }

    public function render(): View|Closure|string
    {
        $rows = CmsSection::where('component_id', $this->heroComponent)
            ->join('cms_section_items', 'section_id', 'cms_sections.id')
            ->join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
            ->select(
                'cms_items.content',
                'cms_section_items.position'
            )
            ->orderBy('cms_section_items.position')
            ->get();

        $cmsTitle = optional($rows->firstWhere('position', 1))->content;
        $image = optional($rows->firstWhere('position', 2))->content ?? '';

        $imageUrl = '';
        if ($image !== '' && file_exists(public_path('storage/' . $image))) {
            $imageUrl = asset('storage/' . $image);
        }

        return view('components.page-hero', [
            'eyebrow' => $this->eyebrow,
            'title' => $this->title ?? $cmsTitle ?? '',
            'subtitle' => $this->subtitle,
            'imageUrl' => $imageUrl,
            'fallbackUrl' => asset('themes/webpage/images/' . $this->fallbackImage),
        ]);
    }
}
