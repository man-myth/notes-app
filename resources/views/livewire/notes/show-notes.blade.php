<?php

use Livewire\Volt\Component;

new class extends Component {
    public function with():array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get()
        ];
    }
}; ?>

<div>
    @foreach ($notes as $note )
        <x-card wire:key='{{$note->id}}' class="dark:bg-gray-900">
            <div class="flex justify-between">
                <a href="#" class = "text-xl font-bold hover:underline hover:text-yellow-300">
                    {{$note->title}}
                </a>
            </div>
        </x-card>
    @endforeach
    
</div>
