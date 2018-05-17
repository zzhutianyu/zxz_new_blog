@extends('blog.base')

@section('content')
    <div id="single">





        <div id="top" style="display: block;">
            <div class="bar" style="width: 1.30248%;"></div>
            <a class="image-icon" href="javascript:history.back()"></a>
            <div title="播放/暂停" data-id="{{ $post->id }}" class="icon-play"></div>
            <div title="查看壁纸" class="icon-images"></div>
            <h3 class="subtitle" style="display: block;">{{ $post->title }}</h3>
            <div class="social">
                <div class="like-icon">
                    <a href="javascript:;" class="likeThis" id="like-{{ $post->id }}"><span class="icon-like"></span><span class="count">{{ $post->like }}</span></a>            </div><!--
         --><div>
                    @include('blog.social')

                    <div id="qr"></div>
                </div>
            </div>
            <div class="scrollbar" style="width: 95.022%;"></div>
        </div>

        <div class="section">

            <div class="images">

            </div><div class="article">

                <div>

                    <h1 class="title">{{ $post->title }}</h1>

                    <div class="stuff">
                        <span>{{ $post->created_at->format('F j, Y')}} </span>
                        <span>阅读 {{ $post->view }}</span>
                        <span>字数 {{ count_words($post->html_content) }}</span>
                        <span>评论 {{ $post->comment_count }}</span>
                        <span>喜欢 <a href="javascript:;" class="likeThis" id="like-{{ $post->id }}"><span class="icon-like"></span><span class="count">{{ $post->like }}</span></a></span>
                    </div>

                    <div class="content">
                        <p>{!! $post->html_content !!}</p>
                        @if(!!$music)
                        <!--[if lt IE 9]><script>document.createElement('audio');</script><![endif]-->
                        <audio class="wp-audio-shortcode" id="audio-{{ $post->id }}-1" loop="1" preload="auto" style="width: 100%;" controls="controls"><source type="audio/mpeg" src="{{ $post->music }}"><a href="{{ $post->music }}">{{ $post->music }}</a></audio>
                        @endif
                    </div>

                    <div class="comment-wrap">
                        @include('blog.comment', ['comments' => $comments, 'id' => $post->id])
                    </div>

                </div>

            </div>

        </div>

        {{--<div class="relate">--}}
            {{--@include('blog.related')--}}
        {{--</div>--}}


    </div>


@endsection