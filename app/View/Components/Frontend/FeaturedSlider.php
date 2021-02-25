<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class FeaturedSlider extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $featuredSlider;
    public function __construct($featuredSlider)
    {
        $this->featuredSlider = $featuredSlider;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.frontend.featured-slider');
    }
}
