@extends('blog.base')

@section('content')
    <div id="single" class="page" style="min-height: 938px;">

        <div id="top" style="display: block;">
            <a class="image-icon" href="/"></a>
        </div>

        <div class="section">
            <div class="images">
            </div><div class="article">
                <div>

                    <div class="content">
                        <div id="archives">
                            @foreach($archives as $year => $month)
                                <h3 class="al_year">{{ $year }} 年</h3>
                                @foreach($month as $month => $days)
                                    <ul class="al_mon_list">
                                        @if($month < 10)
                                        <li><span class="al_mon">{{ '0'.$month }} 月 <em> ( {{ $count[$year][$month] }}
                                                    篇文章 )</em></span>
                                        @else
                                        <li><span class="al_mon">{{ $month }} 月 <em> ( {{ $count[$year][$month] }}
                                                    篇文章 )</em></span>
                                        @endif
                                            <ul class="al_post_list">
                                                @foreach($days as $day => $post)
                                                    @if( $day < 10)
                                                    <li>{{ '0'.$day }}日:
                                                    @else
                                                        <li>{{ $day }}日:
                                                    @endif
                                                    @foreach($post as $item)
                                                        <a
                                                                href="{{ route('post', ['post_id' => $item->id]) }}">{{ $item->title }}</a>
                                                        <em>({{ $item->comment_count }})</em>
                                                            @endforeach
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                @endforeach
                            @endforeach
                    </div>


                </div>
            </div>
        </div>

    </div>

@endsection