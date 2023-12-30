<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $href;
    public $variant;
    public $outline;
    public $block;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($variant, $outline = false, $block = false, $href = '')
    {
        $this->variant = $variant;
        $this->outline = $outline;
        $this->block = $block;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }

    public function buttonClasses()
    {
        $classes = 'outline-none py-2 px-4 border text-md text-center rounded-md font-semibold border-' . $this->variant . ' ';

        if ($this->outline) {
            $classes .= 'bg-white text-' . $this->variant . ' hover:text-white hover:bg-' . $this->variant;
        } else {
            $classes .= 'bg-' . $this->variant . ' text-white hover:text-' . $this->variant . ' hover:bg-white';
        }

        if ($this->block) {
            $classes .= ' w-full';
        }
        // switch ($this->variant) {
        //     case 'primary':
        //         $classes .= ' bg-primary text-white hover:text-primary hover:bg-white';
        //         break;
        //     case 'outline':
        //         $classes .= ' bg-white text-primary hover:text-white hover:bg-primary';
        //         break;
        // }

        return $classes;
    }
}
