<?php

namespace App\View\Components;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\View\Component;

class EventFormBody extends Component
{
    public $event;
    public $types;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($event, $types)
    {
        $this->event = $event;
        $this->types = $types;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $params = [
            "event" => $this->event,
            "types" => $this->types,
        ];
        return view('components.event-form-body', $params);
    }
}