<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component {

    public string $name;

    #[On('echo:sampleChannel,Test')]
    public function refreshPost($event)
    {
        // dd($event);
        $this->name = $event["name"];
    }
};
