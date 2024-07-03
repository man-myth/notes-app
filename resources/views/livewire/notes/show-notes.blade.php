<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {

    public function delete($noteId){
        Note::where('id', $noteId)->first()->delete();
    }

    public function with(): array
    {
        return [
            'notes' => auth()->user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }
}; ?>

<div class="space-y-2">
    @if ($notes->isEmpty())
        <div class='text-center'>
            <p class="text-xl font-bold"> No notes yet</p>
            <p class="text-sm">Let's Create your first note to send.</p>
            <x-button primary icon-right="plus" class="mt-6" href="{{route('notes.create')}}" wire:navigate>Create Note</x-button>
        </div>
    @else
        <x-button primary icon-right="plus" class="mb-6" href="{{route('notes.create')}}" wire:navigate>Create Note</x-button>
        <div class='grid grid-cols-2 gap-4 mt-12'>
            @foreach ($notes as $note)
                <x-card rounded wire:key='{{ $note->id }}' class="p-2 bg-gray-900">
                    <div class="flex justify-between">
                        <div>
                         <a href="#" class="text-xl font-bold text-black hover:underline hover:text-yellow-500 ">
                            {{ $note->title }}
                        </a>
                        <p class="mt-2 text-sm"> {{Str::limit($note->body, 50)}}</p>
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($note->send_date)->format('M/d/Y') }}
                        </div>
                    </div>
                    <div class="flex items-end justify-between mt-4 space-x-1">
                        <p class="text-xs">Recipient: <span class="font-semibold"> {{ $note->recipient }}</span></p>
                        <div>
                            <x-mini-button outline rounded  icon="eye"></x-mini-button>
                            <x-mini-button outline rounded icon="trash" wire:click="delete('{{$note->id}}')"></x-mini-button>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>
    @endif

</div>
