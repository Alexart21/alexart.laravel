<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Call;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\Feedback;

class CallsController extends Controller
{
    public function index()
    {
        return view('call.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:128',
            'tel' => 'min:6|max:18',
        ]);
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
        /**/
        if ($validator->fails() ||  !$res) // не прошла валидация или recaptcha
        {
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
                'recaptcha' => $res,
                'score' => $score,
            ]);
        }else{ // успех
            $data = $request->all();
            $db_result = Call::create($data);
            // отправка почты
            $params = [// Эти параметры так же надо указать в файле app/Mail/Feedback.php.
                'name' => $data['name'],
                'tel' => $data['tel'],
                'body' => 'Просьба перезвонить',
                'email' => null,
            ];
            Mail::to('iskander.m.211@gmail.com')->send(new Feedback($params));
            //
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
}
