<div class="share">

    <a title="获取二维码" class="icon-wechat" href="javascript:;"></a>
</div>

<div id="qr">{!! QrCode::size(128)->generate(url()->current()); !!}</div>
