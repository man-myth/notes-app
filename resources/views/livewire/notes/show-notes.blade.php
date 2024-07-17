<?php

use Livewire\Volt\Component;
use App\Models\Note;
use Carbon\Carbon;


new class extends Component {

    public $notes;
    public $showSentNotes = false;

    public function mount()
    {
       $this->loadNotes();
    }
    
    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);

        $note->delete();
    }

    public function toggleSentNotes()
    {
        $this->showSentNotes = !$this->showSentNotes;

       $this->loadNotes();
    }

    public function loadNotes()
    {
        // Load notes based on $showSentNotes flag
        if ($this->showSentNotes) {
            $this->notes = auth()->user()->notes()
                ->orderBy('send_date', 'asc') // Newest first
                ->get(); // Paginate results
        } else {
            $this->notes = auth()->user()->notes()
                ->where('send_date', '>', Carbon::now()) // Future notes
                ->orderBy('send_date', 'asc') // Oldest first
                ->get(); // Paginate results
        }
    }

    public function placeholder()
    {
        return <<<'HTML'
            <div role="status">
                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>

        HTML;
    }
};

?>

<div class="space-y-2">
    @if ($notes->isEmpty())
        <div class='text-center'>
            <p class="text-xl font-bold"> No notes yet</p>
            <p class="text-sm">Let's Create your first note to send.</p>
            <x-button primary icon="plus" class="mt-2" href="{{ route('notes.create') }}" wire:navigate>Create
                Note</x-button>
        </div>
    @else
        <x-button primary icon="plus" class="mb-6" href="{{ route('notes.create') }}" wire:navigate>Create</x-button>
        
        @if ($showSentNotes)
            <x-button wire:click="toggleSentNotes()" primary icon="paper-airplane" class="mb-6">
                Sent
            </x-button>
        @else
            <x-button wire:click="toggleSentNotes()" secondary icon="paper-airplane" class="mb-6">
                Sent
                 </x-button>
        @endif


        <div class='grid grid-cols-2 gap-4 mt-12'>
            @foreach ($notes as $note)
                <x-card rounded wire:key='{{ $note->id }}' class="p-2 bg-gray-900">
                    <div class="flex justify-between">
                        <div>
                            @can('update', $note)
                                <a href="{{ route('note.edit', $note) }}" wire:navigate
                                    class="text-xl font-bold text-black hover:underline hover:text-purple-700 ">
                                    {{ $note->title }}
                                </a>
                            @else
                                <a class="text-xl font-bold text-gray-400">
                                    {{ $note->title }}
                                </a>
                            @endcan
                            <p class="mt-2 text-sm"> {{ Str::limit($note->body, 50) }}</p>
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($note->send_date)->format('M/d/Y') }}
                        </div>
                    </div>

                    <div class="flex items-end justify-between mt-4 space-x-1">
                        <p class="text-xs">Recipient: <span class="font-semibold"> {{ $note->recipient }}</span></p>
                        <div>
                            <x-mini-button outline rounded icon="eye"
                                href="{{ route('notes.view', $note) }}"></x-mini-button>
                            <x-mini-button outline rounded icon="trash"
                                wire:click="delete('{{ $note->id }}')"></x-mini-button>
                        </div>
                    </div>

                </x-card>
            @endforeach

        </div>
       
    @endif

</div>
