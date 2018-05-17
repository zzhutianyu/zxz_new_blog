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
                        {!! config('blog.about')  !!}
                            <hr>
                    </div>


                    <div class="comment-wrap">
                        @include('blog.comment', ['comments' => $comments])
                    </div>

                </div>
            </div>
        </div>



    </div>
@endsection