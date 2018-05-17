<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function create(Request $request) {
        $data = $request->all();
        Link::create($data);
        return RJM(null, 1, '添加成功');
    }

    /*
     * todo 未完成
     */
    public function delete(Request $request) {
        $linkId = $request->get('id');
        $link = Link::find($linkId);
        $link->delete();
        return RJM(null, 1, '删除成功');
    }

    public function links() {
        $links = Link::all();
        return RJM(['link' => $links], 1, 'success');
    }

    public function getNewLinkId() {
        $link = new Link();
        $link->save();
        return RJM(['id' => $link->id], 1, 'success');
    }


    public function changeName(Request $request) {
        $id = $request->get('id');
        $link = Link::where('id', $id)->first();
        $link->name = $request->get('name');
        $link->save();
        return RJM(null,1, 'success');
    }

    public function changeUrl(Request $request) {
        $id = $request->get('id');
        $link = Link::where('id', $id)->first();
        $link->url = $request->get('url');
        $link->save();
        return RJM(null,1, 'success');
    }


}
