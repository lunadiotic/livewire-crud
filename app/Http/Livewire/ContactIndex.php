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
    public $paginate = 5;
    public $search;
    public $page = 1;

    protected $listeners = [
        'contactUpdated',
        'contactStored',
    ];

    protected $updatesQueryString = [
        ['page' => ['except' => 1]],
        ['search' => ['except' => '']],
    ];

    public function render()
    {
        return view('livewire.contact.contact-index', [
            'contacts' => $this->search === null ?
                Contact::latest()->paginate($this->paginate) :
                Contact::where('name', 'like', '%' . $this->search . '%')->latest()->paginate($this->paginate)
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
