@extends('blog.base')

@section('content')
    <div class="nav">
        <ul id="menu-menu" class="menu">
            @foreach($blog['nav'] as $k => $v)
                <li class="pview menu-item menu-item-type-post_type menu-item-object-page"><a href="{{ url($v) }}"
                                                                                              class="pviewa">{{ $k }}</a>
                </li>
            @endforeach
        </ul>
        <p>{{ $blog['cy'] }}</p>
    </div>

    <div id="container">

        @foreach($posts as $post)
            @if($loop->index == 0)

                <div id="screen">
                    <div id="mark">
                        <div class="layer" data-depth="0.4">
                            <img id="cover" crossorigin="anonymous" src="{{ $posts[0]->image }}" width="2550"
                                 height="1440"/>
                        </div>
                    </div>

                    <div id="vibrant">
                        <svg viewBox="0 0 2880 1620" height="100%" preserveAspectRatio="xMaxYMax slice">
                            <polygon opacity="0.7" points="2000,1620 0,1620 0,0 600,0 "/>
                        </svg>
                        <div></div>
                    </div>

                    <div id="header">
                        <div>
                            <a class="image-logo" href="/"></a>
                            <div class="icon-menu switchmenu"></div>
                        </div>
                    </div>
                    <div id="post0">
                        <p>{{ $posts[0]->created_at->format('F j, Y') }}</p>
                        <h2><a data-id="{{ $posts[0]->id }}" class="posttitle"
                               href="{{ route('post', ['post_id' => $posts[0]->id]) }}">{{ $posts[0]->title }}</a>
                        </h2>
                        <p>{{ trim_words($posts[0]->html_content, 100, '...') }}</p>
                    </div>
                </div>

                <div style="display: none;">
                    @include('blog.post', ['post' => $post])
                </div>

                <div id="primary">

            @else

                        @include('blog.post', ['post' => $post])
            @endif
                @endforeach
                </div>
                <div id="pager"><a href="{{ route('index') . "?page=${page}" }}" class="more">加载更多</a></div>

    </div>
    <div id="preview" class="trans"></div>
@endsection