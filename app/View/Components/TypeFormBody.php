<?php

namespace App\View\Components;

use App\Models\Type;
use Illuminate\View\Component;

class TypeFormBody extends Component
{
    public $type;

    /**
     * Create a new component instance.
     *
     * @param \App\Models\Type $type
     * @return void
     */
    public function __construct($type = null)
    {
        if (is_null($type)) {
            $type = Type::make([
                "duration" => "O"
            ]);
        }

        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $params = [
            "type" => $this->type,
            "durations" => Type::DURATIONS,
        ];
        return view('components.type-form-body', $params);
    }
}
