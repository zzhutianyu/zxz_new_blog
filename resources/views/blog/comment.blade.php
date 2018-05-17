<div id="comments" class="comments-area">


    <h2>评论列表</h2>
    <ol class="comment-list">
        @foreach($comments as $comment)
        <li class="comment even thread-even depth-1" id="comment-5585">
            <div id="div-comment-5585" class="comment-body">
                <div class="comment-author vcard">
                    <cite class="fn"><a
                                href="http://www.zyz.tw" rel="external nofollow" class="url">{{ $comment->name }}</a></cite><span
                            class="says">说道：</span></div>

                <div class="comment-meta commentmetadata"><a href="http://isujin.com/about/comment-page-9#comment-5585">
                        {{ $comment->created_at }}</a></div>

                <p>{{ $comment->content }}</p>
            </div>
        </li>
        @endforeach
    </ol>

    <nav class="navigation comment-navigation" role="navigation">
        <h2 class="screen-reader-text">评论导航</h2>
        <div class="nav-links">

            <div class="nav-previous"><a href="{{ $comments->nextPageUrl() }}">较早评论</a></div>
            @if($comments->currentPage() != 1)
                <div class="nav-next"><a href="{{ $comments->lastPage() }}">较新评论</a></div>
            @endif
        </div>
    </nav>


    <div id="respond" class="comment-respond">
        <h2 id="reply-title" class="comment-reply-title">发表评论
            <small><a rel="nofollow" id="cancel-comment-reply-link" href="/about#respond" style="display:none;">取消回复</a>
            </small>
        </h2>
        @if(url()->current() == url('about'))
        <form action="{{ route('about-comment') }}" method="post" id="commentform" class="comment-form">
        @else
                <form action="{{ route('post-comment') }}" method="post" id="commentform" class="comment-form">
        @endif
                    {{ csrf_field() }}
            <p class="comment-notes"><span id="email-notes">电子邮件地址不会被公开。</span> 必填项已用<span class="required">*</span>标注
            </p>
            <p class="comment-form-comment"><label for="comment">评论</label> <textarea id="comment" name="comment"
                                                                                      cols="45" rows="8"
                                                                                      maxlength="65525"
                                                                                      required="required"></textarea>
            </p>
            <p class="comment-form-author"><label for="author">姓名 <span class="required">*</span></label> <input
                        id="author" name="author" type="text" value="" size="30" maxlength="245" required="required">
            </p>
            <p class="comment-form-email"><label for="email">电子邮件 <span class="required">*</span></label> <input
                        id="email" name="email" type="text" value="" size="30" maxlength="100"
                        aria-describedby="email-notes" required="required"></p>
                    @isset($id)
            <p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="发表评论"> <input
                        type="hidden" name="comment_post_id" value="{{ $id }}" id="comment_post_ID">
                    @endisset
                <input type="hidden" name="comment_parent" id="comment_parent" value="0">
            </p>
            <p style="display: none;"><input type="hidden" id="akismet_comment_nonce" name="akismet_comment_nonce"
                                             value="315ee86eaa"></p></form>
    </div>

</div>
