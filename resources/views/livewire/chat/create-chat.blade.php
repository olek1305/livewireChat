<div>
    <div class="mt-10"></div>
    <div class="list-group-container mx-auto grid grid-cols-1">
        @foreach($users as $user)
                <button class="list-group-item" wire:click='checkconversation({{$user->id}})'> {{ $user->name }} </button>
        @endforeach
    </div>

</div>
