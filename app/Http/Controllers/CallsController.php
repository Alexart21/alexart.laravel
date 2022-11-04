<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Support\Facades\Mail;
use App\Mail\Feedback;
use App\Http\Requests\CallFormRequest;

class CallsController extends AppFormsController
{
    public function index()
    {
        return view('call.index');
    }

    public function store(CallFormRequest $request)
    {
        $data = $request->validated();
        // если не провалидировано то уходит {success:false, errors:....}
        // это в методе failedValidation в файле app/Http/Requests/CallFormRequest.php
        $score = $this->checkReCaptcha();
        if (!$score || $score < 0.5) // не прошла recaptcha
        {
            return response()->json([
                'success' => false,
                'recaptcha' => false,
                'score' => $score,
            ]);
        }

        $db = Call::create($data) ? true : false;
        $mail = $this->sendEmail($data);
        if ($db && $mail) {
            return response()->json([
                'success' => true,
            ]);
        } else { // почемуто не записалось в базу или не отправилась почта
            return response()->json([
                'success' => false,
                'db' => $db,
                'mail' => $mail,
                'score' => $score,
            ]);
        }
    }

    private function sendEmail($data)
    {
        try {
            $params = [// Эти параметры так же надо указать в файле app/Mail/Feedback.php.
                'tel' => $data['tel'],
                'body' => 'Просьба перезвонить',
                'name' => $data['name'],
                'email' => null,
                'subject' => 'Просьба перезвонить',
            ];
            Mail::to(env('ADMIN_EMAIL'))->send(new Feedback($params));
            return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
