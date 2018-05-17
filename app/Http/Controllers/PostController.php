<?php

namespace App\Http\Controllers;

use App\Image;
use App\Music;
use App\Post;
use App\Relation;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function updateLike(Request $request) {
        $post_id = $request->get('likepost');
        $post = Post::find($post_id);
        $post->like = ++$post->like;
        $post->save();
        return back();
    }



    public function getPosts() {
        $posts = Post::paginate(5);

        return RJM(['posts' => $posts], 1, '获取成功');
    }


    public function getPost(Request $request) {
        $postId = $request->get('id');
        $post = Post::where('id', $postId)->first();
        return RJM(['post' => $post], 1, 'success');
    }

    public function upload(Request $request) {
        $title = $request->get('title');
        $content = $request->get('content');
        $tags = $request->get('tags');
        $imgId = $request->get('imageId');
        $musicId = $request->get('musicId');

        $post = new Post();
        $post->title = $title;
        $post->raw_content = $content;
        $post->html_content = $content;
        $post->save();
        foreach ($tags as $k => $v) {
            if (!$tagm = Tag::where('name', $v)->first()) {
                $tagm = new Tag();
                $tagm->name = $v;
                $tagm->save();
            }
            $post_to_tag = new Relation();
            $post_to_tag->from = 'posts';
            $post_to_tag->to = 'tags';
            $post_to_tag->from_id = $post->id;
            $post_to_tag->to_id = $tagm->id;
            $post_to_tag->save();
        }


        Music::where('id', $musicId)->update(['post_id' => $post->id]);
        Image::where('id', $imgId)->update(['post_id' => $post->id]);

        return RJM(['postId' => $post->id], 1, 'success');
    }


    public function edit(Request $request) {
        $postId = $request->get('id');
        $title = $request->get('title');
        $content = $request->get('content');

        $post = Post::where('id', $postId)->first();
        $post->title = $title;
        $post->raw_content = $content;
        $post->html_content = $content;
        $post->save();
        return RJM(null, 1, 'success');
    }

}
