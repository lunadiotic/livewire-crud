<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;

class ContactUpdate extends Component
{
    public $contactId;
    public $name;
    public $phone;

    protected $listeners = [
        'getContact' => 'showContact'
    ];

    private function resetInput()
    {
        $this->name = null;
        $this->phone = null;
    }

    public function render()
    {
        return view('livewire.contact.contact-update');
    }

    public function showContact($contact)
    {
        $this->contactId = $contact['id'];
        $this->name = $contact['name'];
        $this->phone = $contact['phone'];
    }

    public function update()
    {
        $this->validate([
            'contactId' => 'required|numeric',
            'name' => 'required|min:3',
            'phone' => 'required|max:15'
        ]);

        if ($this->contactId) {
            $contact = Contact::find($this->contactId);
            $contact->update([
                'name' => $this->name,
                'phone' => $this->phone,
            ]);

            $this->resetInput();

            $this->emit('contactUpdated');
        }
    }
}
