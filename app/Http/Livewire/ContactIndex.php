<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;

class ContactIndex extends Component
{
    public $data, $name, $phone, $selectedId;
    public $updateStatus = false;

    public function render()
    {
        $this->data = Contact::all();
        return view('livewire.contact.contact-index');
    }
}
