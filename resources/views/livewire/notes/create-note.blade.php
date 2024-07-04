<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    public function submit()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:5'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],

        ]);
        auth()->user()->notes()->create([
            'title'=> $this->noteTitle, 
            'body'=>$this->noteBody, 
            'recipient'=>$this->noteRecipient, 
            'send_date'=>$this->noteSendDate,
            'is_published'=>true,
        ]);

        redirect(route('notes.index'));

    }

}; ?>

<div>
    <form wire:submit='submit'>
        <x-input wire:model='noteTitle' label='Note Title' placeholder="Algebra Notes....." />
        <x-textarea wire:model='noteBody' label='Body' placeholder="five, six, seven, ate, nine....." />
        <x-input icon="user" wire:model='noteRecipient' label='Recipient' placeholder="sample@email.com" />
        <x-input icon="calendar" wire:model='noteSendDate' type="date" label='Send Date' />
        <x-button rounded type='submit' class="mt-6" right-icon="calendar" spinner>Submit</x-button>
        <x-errors/>
    </form>

</div>
