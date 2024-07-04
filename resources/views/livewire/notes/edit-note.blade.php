<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $isPublished;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecipient = $note->recipient;
        $this->noteSendDate = $note->send_date;
        $this->isPublished = $note->is_published;
    }

    public function saveNote()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:5'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ]);
        $this->note->update([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => $this->isPublished,
        ]);

        $this->dispatch('note-saved');
    }
}; ?>


<x-slot name="header">
    <h2 class="text-xl font-normal leading-tight text-gray-800 dark:text-gray-200">
        Edit Note: <span class="font-semibold"> {{ $note->title }}</span>
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <x-button flat s class="mb-6" icon="arrow-left" href="{{route('notes.index')}}" wire:navigate secondary rounded> All Notes</x-button>
        <form wire:submit='saveNote'>
            <x-input wire:model='noteTitle' label='Note Title' placeholder="Algebra Notes....." />
            <x-textarea wire:model='noteBody' label='Body' placeholder="five, six, seven, ate, nine....." />
            <x-input icon="user" wire:model='noteRecipient' label='Recipient' placeholder="sample@email.com" />
            <x-input icon="calendar" wire:model='noteSendDate' type="date" label='Send Date' />
            <x-checkbox label="Note Published" wire:model='isPublished'/>
            <x-button rounded type="submit" class="mt-6" spinner="saveNote">Save</x-button>
            {{-- <x-alert title="Success Message!" positive outline on="note-saved"/> --}}
            <x-action-message on="note-saved"></x-action-message>
            <x-errors />
        </form>
    </div>
</div>
