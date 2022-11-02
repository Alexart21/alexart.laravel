<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Call;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\Feedback;
use App\Http\Requests\CallFormRequest;

class CallsController extends Controller
{
    public function index()
    {
        return view('call.index');
    }

    public function store(CallFormRequest $request)
    {
        /* ReCaptcha */
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = env('RECAPTCHA_V3_SECRET_KEY');
        $recaptcha_response = $_POST['reCaptcha'];
        // Отправляем POST запрос и декодируем результаты ответа
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);
        $score = $recaptcha->score;
        // Принимаем меры в зависимости от полученного результата
        if ($score >= 0.5) {
            // Проверка пройдена
            $res = true;
        } else {
            // Проверка не пройдена
            $res = false;
        }
        /* end ReCaptcha */
        if (!$res) // не прошла recaptcha
        {
            return response()->json([
                'success' => false,
                'recaptcha' => $res,
                'score' => $score,
            ]);
        }else{ // recaptCha успешно
            $data = $request->validated();
            // если не провалидировано то уходит {success:false, errors:....}
            // это в методе failedValidation в файле app/Http/Requests/CallFormRequest.php
            $db_result = Call::create($data);
            $this->sendEmail($data);
            if($db_result){
                return response()->json([
                    'success' => true,
                    'db' => true,
                    'recaptcha' => $res,
                    'score' => $score,
                ]);
            }else{
                return response()->json([
                    'success' => true,
                    'db' => false,
                    'recaptcha' => $res,
                    'score' => $score,
                ]);
            }
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
        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }

}
