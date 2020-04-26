<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;

class ContactCreate extends Component
{
    public $name;
    public $phone;

    private function resetInput()
    {
        $this->name = null;
        $this->phone = null;
    }

    public function render()
    {
        return view('livewire.contact.contact-create');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:3',
            'phone' => 'required|max:15'
        ]);

        Contact::create([
            'name' => $this->name,
            'phone' => $this->phone
        ]);

        $this->resetInput();

        $this->emit('contactStored');
    }
}
