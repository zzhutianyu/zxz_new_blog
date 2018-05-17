<?php

namespace App;

use App\Helpers\Parser;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $appends = [
        'comment_count', 'image', 'music', 'content'
    ];


    public function getCommentCountAttribute($key)
    {
        $comment_count = Relation::where('from', $this->table)->where('from_id', $this->id)->count();
        return $comment_count;
    }

    public function getImageAttribute($key)
    {
        $image = Image::where('post_id', $this->id)->first();
        return !$image ? url('images/default.jpg') : url('storage/' .$image->url);
    }

    public function getMusicAttribute($key)
    {
        $music = Music::where('post_id', $this->id)->first();
        return !$music ? url('images/default.jpg') : url('storage/' . $music->url);
    }
    public function getContentAttribute() {
        $content = trim_words($this->html_content, 100, '...');
        return $content;
    }

    public function setHtmlContentAttribute($value)
    {
        $parser = new Parser;
        $this->attributes['html_content'] = $parser->makeHtml($value);
    }


}


