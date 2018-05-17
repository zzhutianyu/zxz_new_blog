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
                        @foreach($errors->messages()->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                            <p><a href="javascript:history.back()">« 返回</a></p>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection