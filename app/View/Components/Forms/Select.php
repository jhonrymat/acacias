<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Select extends Component
{
    public $options;
    public $selected;
    public $placeholder;
    public $searchable;

    public function __construct($options = [], $selected = '', $placeholder = '', $searchable = true)
    {
        $this->options = $options;
        $this->selected = $selected;
        $this->placeholder = $placeholder;
        $this->searchable = $searchable;
    }

    public function render()
    {
        return view('components.forms.select');
    }
}