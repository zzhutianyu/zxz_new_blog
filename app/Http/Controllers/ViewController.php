<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Link;
use App\Music;
use App\Post;
use App\Relation;
use App\Visit;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index(Request $request) {
        $ip = $request->ip();

        if (!!$ip_info = GetIpLookup($ip)) {
            $visit = new Visit();
            $visit->ip = $ip;
            $visit->country = $ip_info['country'];
            $visit->province = $ip_info['province'];
            $visit->city = $ip_info['city'];
            $visit->save();
        }

        $page = !$request->get('page') ? 0 : $request->get('page');

        $posts = Post::orderBy('id', 'desc')
                     ->skip($page * 15)
                     ->take(15)
                     ->get();
        return view('blog.index', ['posts' => $posts, 'blog' => config('blog'), 'page' => ++$page]);
    }

    public function about() {
        $about_to_comments = Relation::where('from', 'about')
                                     ->where('to', 'comments')
                                     ->orderBy('created_at', 'desc')
                                     ->get();
        $comments_id = array();
        foreach ($about_to_comments as $about_to_comment) {
            $comments_id [] = $about_to_comment->to_id;
        }
        $comments = Comment::whereIn('id', $comments_id)->paginate(30);
        return view('blog.about', ['comments' => $comments]);
    }

    public function archive() {
        $posts = Post::all();
        $count = $posts->count();
//        return $posts;
        $archive_lists = create_year_month_day_lists($posts);
        $count = array();
        foreach ($archive_lists as $year => $months) {
            foreach ($months as $month => $days){
                foreach ($days as $day => $item) {
                    $count[$year][$month] = 0;
                }
            }
        }
        foreach ($archive_lists as $year => $months) {
            foreach ($months as $month => $days){
                foreach ($days as $day => $items) {
                    foreach ($items as $item)
                    $count[$year][$month]++;
                }
            }
        }


        return view('blog.archive', ['archives' => $archive_lists, 'count' =>  $count]);

    }

    public function post($post_id) {
        $post = Post::find($post_id);
        $music = Music::where('post_id', $post->id)->first();
        $post_comments = Relation::where('from', 'posts')
                                ->where('from_id', $post->id)
                                ->where('to', 'comments')
                                ->orderBy('created_at', 'desc')
                                ->get();
        $comments_id = array();
        foreach ($post_comments as $post_comment) {
            $comments_id [] = $post_comment->to_id;
        }
        $post->view  = ++$post->view;
        $comments = Comment::whereIn('id', $comments_id)->paginate(30);
        return view('blog.content', ['post' => $post, 'comments' => $comments, 'music' => $music]);

    }

    public function link() {
        $links = Link::all();
        return view('blog.links', ['links' => $links]);
    }


}
