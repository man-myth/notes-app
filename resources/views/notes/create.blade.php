<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Create a Note
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <x-button flat s class="mb-6" icon="arrow-left" href="{{route('notes.index')}}" wire:navigate secondary rounded> All Notes</x-button>
            <livewire:notes.create-note />
        </div>
    </div>
</x-app-layout>
