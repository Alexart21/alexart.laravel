<?php

namespace App\Jobs;

use App\Mail\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SenderCall implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
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
            switch ($this->data['mode']){
                case 'tg' : $mode = ' через Telegram';break;
                case 'wt' : $mode = ' через WhatsApp';break;
                default : $mode = ' по телефону';
            }
            switch ($this->data['subject']){
                case 'call' : $subject = ' Заказ обратного звонка';break;
                case 'seo' : $subject = ' Заявка на аудит сайта';break;
                default : $subject = ' Заказ обратного звонка';
            }
            $params = [// Эти параметры так же надо указать в файле app/Mail/Feedback.php.
                'tel' => htmlspecialchars($this->data['tel']),
                'body' => !$mode ? 'Просьба перезвонить' : 'Просьба связаться' . $mode,
                'name' => htmlspecialchars($this->data['name']),
                'email' => null,
                'subject' => $subject,
            ];
            Mail::to(config('app.admin_email'))->send(new Feedback($params));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
