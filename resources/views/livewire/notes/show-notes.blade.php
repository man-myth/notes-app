<?php

use Livewire\Volt\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
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
        <div class='grid grid-cols-2 gap-4 mt-12'>
            @foreach ($notes as $note)
                <x-card rounded wire:key='{{ $note->id }}' class="px-1 py-2 bg-gray-900">
                    <div class="flex justify-between">
                        <a href="#" class="text-xl font-bold text-black hover:underline hover:text-yellow-500 ">
                            {{ $note->title }}
                        </a>
                        <div class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($note->send_date)->format('m/d/y') }}
                        </div>
                    </div>
                    <div class="flex items-end justify-between mt-4 space-x-1">
                        <p class="text-xs">Recipient: <span class="font-semibold"> {{ $note->recipient }}</span></p>
                        <div>
                            <x-mini-button rounded secondary icon="eye"></x-mini-button>
                            <x-mini-button rounded secondary icon="trash"></x-mini-button>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>
    @endif

</div>
