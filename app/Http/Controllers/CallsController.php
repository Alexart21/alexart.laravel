<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Feedback;
use App\Http\Requests\CallFormRequest;
use MoveMoveIo\DaData\Enums\Gender;
use MoveMoveIo\DaData\Enums\Parts;
use MoveMoveIo\DaData\Facades\DaDataName;

class CallsController extends AppFormsController
{
    public function index()
    {
        return 'Only POST method';
    }

    public function store(CallFormRequest $request)
    {
        $data = $request->validated();
        // если не провалидировано то уходит {success:false, errors:....}
        // это в методе failedValidation в файле app/Http/Requests/CallFormRequest.php
        /*$score = $this->checkReCaptcha();
        if (!$score || $score < 0.5) // не прошла recaptcha
        {
            return response()->json([
                'success' => false,
                'recaptcha' => false,
                'score' => $score,
            ]);
        }*/

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
//                'score' => $score,
            ]);
        }
    }

    private function sendEmail($data)
    {
        try {
            $params = [// Эти параметры так же надо указать в файле app/Mail/Feedback.php.
                'tel' => htmlspecialchars($data['tel']),
                'body' => 'Просьба перезвонить',
                'name' => htmlspecialchars($data['name']),
                'email' => null,
                'subject' => 'Просьба перезвонить',
            ];
            Mail::to(config('app.admin_email'))->send(new Feedback($params));
            return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function info(Request $request)
    {
        /*return response()->json([
            'success' => true,
            'count' => 4,
            'names' => ['вася', 'василий', 'василиса', 'васискис'],
        ]);*/
        $dadata = DaDataName::prompt($request->name, $count=5, Gender::UNKNOWN, [Parts::NAME]);
        $res = [];
        foreach ($dadata['suggestions'] as $v){
            array_push($res, $v['value']);
        }
        return response()->json([
            'success' => true,
            'count' => $count,
            'names' => $res
        ]);

    }

}
