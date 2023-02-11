<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Chat;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $msg;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $chat = new Chat();
        $chat->name = 'Test';
        $chat->msg = $this->msg;
        $chat->save();
    }
}
