<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;

class ContactIndex extends Component
{
    public $data;
    public $selectedId;
    public $updateStatus = false;

    public function render()
    {
        $this->data = Contact::latest()->get();
        return view('livewire.contact.contact-index');
    }
}
