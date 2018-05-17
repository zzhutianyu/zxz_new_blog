<?php

namespace App\Http\Controllers;

use App\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function upload(Request $request) {
        $music = $request->file('file');
//        dd($music);
        $path = $music->store('public/musics');
        $musicModel = new Music();
        $musicModel->url = substr($path, 7);
        $musicModel->save();
        return RJM(['musicId' => $musicModel->id], 1, 'success');
    }
}
