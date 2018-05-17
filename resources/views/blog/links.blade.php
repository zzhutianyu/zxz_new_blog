@extends('blog.base')


@section('content')
    <div id="single" class="page">



        <div id="top">
            <a class="image-icon" href="javascript:history.back()"></a>
        </div>

        <div class="section">
            <div class="images">
            </div><div class="article">
                <div>

                    <div class="content">
                        {{--todo link-content--}}
                        {{ config('blog.link') }}
                    </div>

                    <ul class="friend">
                        {{--todo frend-a-list --}}
                        @foreach($links as $link)
                             <li><a href="{{ $link->url }}" target="_blank">{{ $link->name }}</a></li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>

    </div>

@endsection