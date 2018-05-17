<?php

namespace App\Http\Controllers;

use App\Image;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageM;
use Illuminate\Http\Request;
use Overtrue\Socialite\SocialiteManager;

class ImageController extends Controller
{

    public function indexImage(Request $request) {
        $client = new Client();
        $url = $request->get('src');
        if (preg_match('/default/', $url)) {
            $img = ImageM::make(Storage::get('public/images/default.jpg'));
            return $img->response('jpg');
        }

        $pattern = url('storage');
        $url = preg_replace("~$pattern~", 'public', $url);
        $img = ImageM::make(Storage::get($url))->resize(680, 480);
        return $img->response('jpg');
    }

    public function upload(Request $request) {

        $img = $request->file('file');

        $path = $img->store('public/images');
        $image = new Image();
        $image->url = substr($path, 7);
        $image->save();
        return RJM(['imageId' => $image->id], 1, 'success');
    }


}
