<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{
    use WithPagination;

    public $selectedContact;
    public $updateStatus = false;

    protected $listeners = [
        'contactUpdated',
        'contactStored'
    ];

    public function render()
    {
        return view('livewire.contact.contact-index', [
            'contacts' => Contact::latest()->paginate(3)
        ]);
    }

    public function getContact($id)
    {
        $this->updateStatus = true;
        $this->selectedContact = Contact::find($id);
        $this->emit('getContact', $this->selectedContact);
    }

    public function destroy($id)
    {
        if ($id) {
            $data = Contact::find($id);
            $data->delete();
            session()->flash('message', 'Your contact was deleted');
        }
    }

    public function contactStored()
    {
        session()->flash('message', 'Your contact was stored');
    }

    public function contactUpdated()
    {
        session()->flash('message', 'Your contact was updated');
    }
}
