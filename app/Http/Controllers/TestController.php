<?php
namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Http\Requests\TestFormRequest;
use App\Models\Oauth;
use App\Models\User;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use App\Models\Content;

use MoveMoveIo\DaData\Facades\DaDataAddress;
use MoveMoveIo\DaData\Enums\Language;
use MoveMoveIo\DaData\Facades\DaDataName;
use MoveMoveIo\DaData\Enums\Gender;
use MoveMoveIo\DaData\Enums\Parts;
use MoveMoveIo\DaData\DaDataPhone;
use App\Jobs\TestJob;
use Iman\Streamer\VideoStreamer;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Auth;



class TestController extends Controller
{
    // public ?int $x;
    public function index(Request $request)
    {
       /* $ip = $request->ip();
        $data = Location::get('188.162.54.238');
        var_dump($data->countryName);
        die;*/
        /*$str = '
        {"update_id":490036471,"message":{"message_id":918,"from":{"id":5118266266,"is_bot":false,"first_name":"Alexandr","username":"Mihalych211","language_code":"ru"},"chat":{"id":5118266266,"first_name":"Alexandr","username":"Mihalych211","type":"private"},"date":1678205326,"text":"ass"}}
        ';
        dd(json_decode($str));*/

//        die('here');
        // очереди bи проверил новый бот
//       TestJob::dispatch('test new telegram bot');
//       die('test tg bot');
        // типа личный кабинет
        if(Auth::user()){
            $id =Auth::user()->id;
            $photos =  Photo::where('user_id', $id)->get();
        }else{
            $photos = null;
        }

//        dd($photos);

        return view('test.index', compact('photos'));
    }

    public function store(TestFormRequest $request)
    {
//        dd($request->file('avatar'));
//        dd($request->avatar);
        $data = $request->validated();
//        dd($data);
        $photo = new Photo();
        $id =Auth::user()->id;
        $photo->user_id = $id;
        $photo->title = $data['title'];
        $path = $request->file('avatar')->store('public/photos');
        $link = str_replace('public', 'storage', $path);
        $photo->path = $path;
        $photo->link = $link;
        $photo->save();
        return redirect()->route('test.index');
    }

    public function remove($id)
    {
        $img = Photo::findOrFail($id);
        $path = $img->path;
        // файл
        $deleteFile = Storage::delete($path);
        // запись из базы
        $deletedRows = $img->delete();
        if($deleteFile && $deletedRows){
            return redirect()->route('test.index');
        }else{
            die('Что то пошло не так...');
        }
    }

    public function save(Request $request)
    {
//        die('here');
        dd($request->q);
    }

    public function dadata()
    {
        return view('test.dadata');
    }

    public function address()
    {
//        $dadata = DaDataAddress::standardization('новы');
//        dd($dadata[0]['result']);

        return view('test.address');
    }

    public function info(Request $request)
    {

        /*return response()->json([
            'success' => true,
            'count' => 2,
            'address' => ['aaaa', 'bla-bka-bla-la-LA'],
        ]);*/

//        $dadata = DaDataName::prompt($request->q, $count=5, Gender::UNKNOWN, [Parts::NAME]);
        $dadata = DaDataAddress::prompt($request->q, $count = 10, Language::RU);
        $res = [];
        foreach ($dadata['suggestions'] as $v){
            array_push($res, $v['value']);
        }
//        dd($res);
        return response()->json([
            'success' => true,
            'count' => $count,
            'address' => $res
        ]);

    }

    public function confirm()
    {
        return view('test.confirm', ['success' => false]);
    }

    public function confirmStore(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        flash('Успешно !!!');
        return view('test.confirm', ['success' => true]);
    }

    public function form()
    {
        return view('test.form');
    }

    public function download()
    {
        return response()->download('sitemap.xml');
    }

    public function videopage()
    {
        return view('test.videopage');
    }

    // stream
    public function video()
    {
        $path = public_path('storage/files/_video.mp4');
        VideoStreamer::streamFile($path);
    }
}
