<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\Feedback;
use App\Http\Requests\IndexFormRequest;

class PostsController extends Controller
{
    public function index()
    {
        return 'Only POST method';
    }

//    public function store(IndexFormRequest $request)
    public function store(Request $request)
    {
//        $data = $request->validated();
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:128',
            'email' => 'email',
            'tel' => 'min:6|max:18',
            'body' => 'required|min:2|max:10000',
        ]);
        /* ReCaptcha */
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = env('RECAPTCHA_V3_SECRET_KEY');
        $recaptcha_response = $_POST['reCaptcha'];
        // Отправляем POST запрос и декодируем результаты ответа
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);
        $score = $recaptcha->score;
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
            $db_result = Post::create($data);
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
                'email' => $data['email'],
                'tel' => $data['tel'],
                'body' => $data['body'],
                'name' => $data['name'],
            ];
            Mail::to(env('ADMIN_EMAIL'))->send(new Feedback($params));
        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }
}

