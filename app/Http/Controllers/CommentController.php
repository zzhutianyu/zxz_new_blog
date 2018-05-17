<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Jobs\SendFeedBackToMe;
use App\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{
    public function aboutFeedBack(Request $request) {
        $validator = Validator::make($request->all(), [
            'author' => 'required|max:255',
            'comment' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return view('blog.error', ['errors' => $validator]);
        }
        $name = $request->get('author');
        $comment_content = $request->get('comment');
        $email = $request->get('email');

        SendFeedBackToMe::dispatch(array('name' => $name, 'email' => $email, 'content' => $comment_content));

        $comment = new Comment();
        $comment->content = $comment_content;
        $comment->name = $name;
        $comment->email = $email;
        $comment->save();
        $relation = new Relation();
        $relation->from = 'about';
        $relation->to = $comment->getTable();
        $relation->from_id = '0';
        $relation->to_id = $comment->id;
        $relation->save();
        return back();
    }

    public function postComment(Request $request) {
        $validator = Validator::make($request->all(), [
            'author' => 'required|max:255',
            'comment' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return view('blog.error', ['errors' => $validator]);
        }
        $name = $request->get('author');
        $comment_content = $request->get('comment');
        $email = $request->get('email');
        $post_id = $request->get('comment_post_id');
        SendFeedBackToMe::dispatch(array('name' => $name, 'email' => $email, 'content' => $comment_content));
        $comment = new Comment();
        $comment->content = $comment_content;
        $comment->name = $name;
        $comment->email = $email;
        $comment->save();
        $relation = new Relation();
        $relation->from = 'posts';
        $relation->to = $comment->getTable();
        $relation->from_id = (string) $post_id;
        $relation->to_id = $comment->id;
        $relation->save();
        return back();
    }
}
