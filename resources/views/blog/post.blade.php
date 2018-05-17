<div class="post">

<a data-id="{{ $post->id }}" href="{{ route('post', ['post_id' => $post->id]) }}" title="{{ $post->title }}">


    <img width="680" height="440" src="{{ url('index/img') . '?src='. urlencode($post->image) }}" class="cover" />


</a>
<div class="else">
    <p>{{ $post->created_at->format('F j, Y')}}</p>
    <h3><a data-id="{{ $post->id }}" class="posttitle" href="{{ route('post', ['post_id' => $post->id]) }}">{{ $post->title }}</a></h3>
    <p>{{ trim_words($post->html_content, 100, '...') }}</p>
    <p class="here">
        <span class="icon-letter">{{ count_words($post->html_content) }}</span>
        <span class="icon-view">{{ $post->view }}</span>
        <a href="javascript:;" class="likeThis" id="like-{{ $post->id }}"><span class="icon-like"></span><span class="count">{{ $post->like }}</span></a>
    </p>
</div>
</div>