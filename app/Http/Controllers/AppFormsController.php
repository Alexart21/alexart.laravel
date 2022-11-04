<?php


namespace App\Http\Controllers;


use App\Mail\Feedback;
use Illuminate\Support\Facades\Mail;

class AppFormsController extends Controller
{

    protected function checkReCaptcha()
    {
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = env('RECAPTCHA_V3_SECRET_KEY');
        $recaptcha_response = $_POST['reCaptcha'];
        if (!$recaptcha_response) {
            return false;
        }
        // Отправляем POST запрос и декодируем результаты ответа
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);
        $score = $recaptcha->score;
        return $score ?? false;
    }

}
