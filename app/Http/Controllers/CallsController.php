<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Call;
use Illuminate\Support\Facades\Validator;

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
        // Принимаем меры в зависимости от полученного результата
        if ($recaptcha->score >= 0.2) {
            // Проверка пройдена
            $recaptcha = true;
        } else {
            // Проверка не пройдена
            $recaptcha = false;
        }
        /**/
        if ($validator->fails() ||  !$recaptcha) // не прошла валидация или recaptcha
        {
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
                'recaptcha' => $recaptcha,
            ]);
        }else{ // успех
            $data = $request->all();
            $db_result = Call::create($data);
            if($db_result){
                return response()->json([
                    'success' => true,
                    'db' => true,
                    'recaptcha' => $recaptcha,
                ]);
            }else{
                return response()->json([
                    'success' => true,
                    'db' => false,
                    'recaptcha' => $recaptcha,
                ]);
            }
        }
    }
}
