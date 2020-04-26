<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;

class ContactIndex extends Component
{
    public $data;
    public $selectedContact;
    public $updateStatus = false;

    protected $listeners = [
        'contactUpdated' => '$refresh',
        'contactStored' => '$refresh'
    ];

    public function render()
    {
        $this->data = Contact::latest()->get();
        return view('livewire.contact.contact-index');
    }

    public function getContact($id)
    {
        $this->updateStatus = true;
        $this->selectedContact = Contact::find($id);
        $this->emit('getContact', $this->selectedContact);
    }

    // public function contactUpdated($data)
    // {
    //     // $this->updateStatus = false;
    // }
}
