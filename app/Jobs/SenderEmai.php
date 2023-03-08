<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\Feedback;
use App\Models\Post;

class SenderEmai implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $params = [// Эти параметры так же надо указать в файле app/Mail/Feedback.php.
                'email' => htmlspecialchars($this->data['email']),
                'tel' => htmlspecialchars($this->data['tel']),
                'body' => nl2br(htmlspecialchars($this->data['body'])),
                'name' => htmlspecialchars($this->data['name']),
                'subject' => 'Письмо с сайта',
            ];
            Mail::to(config('app.admin_email'))
                ->send(new Feedback($params));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
