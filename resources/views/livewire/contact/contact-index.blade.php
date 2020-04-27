<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if ($updateStatus)
        <livewire:contact-update></livewire:contact-update>
    @else
        <livewire:contact-create></livewire:contact-create>
    @endif

    <hr>

    <form>
        <div class="row">
          <div class="col">
            <select wire:model="paginate" name="" id="" class="form-control form-control-sm w-auto">
                <option value="2">2</option>
                <option value="5">5</option>
                <option value="10">10</option>
            </select>
          </div>
          <div class="col">
              <input wire:model="search" type="text" class="form-control form-control-sm" id="inputEmail3" placeholder="Search">
          </div>
        </div>
    </form>

    <hr>

    <table class="table">
        <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Phone</th>
              <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0 ?>
            @foreach ($contacts as $contact)
            <?php $no++ ?>
            <tr>
                <th scope="row">{{ $no }}</th>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->phone }}</td>
                <td>
                    <button wire:click="getContact({{ $contact->id }})" class="btn btn-sm btn-info text-white">Edit</button>
                    <button wire:click="destroy({{ $contact->id }})" class="btn btn-sm btn-danger">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $contacts->links() }}
</div>
