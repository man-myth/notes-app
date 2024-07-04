<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

 
    public function __construct(public Note $note)
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $noteURL = config('app.url') . "/notes/" . $this->note->id;
        $emailContent = "Hello, you've recieved a new note.: {$noteURL}";
        Mail::raw($emailContent, function($message) {
            $message->from('dieslogic@gmail.com', 'dieslogic')
                ->to($this->note->recipient)
                ->subject('You have anew note from ' . $this->note->user->name);
        });
    }
}
