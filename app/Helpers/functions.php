<?php
/**
 * Created by PhpStorm.
 * User: zhutianyu
 * Date: 18-4-30
 * Time: 下午10:28
 */

/*
 * blog辅助函数
 */

function trim_words($content, $num_words, $more = '...') {
    $strip_tags_content = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $content);
    $strip_tags_content = strip_tags($strip_tags_content);
    $strip_tags_content = trim($strip_tags_content);
    $resutlt = mb_substr($strip_tags_content, 0, $num_words, 'utf-8');
    return $resutlt;
}

function count_words($content) {
    $strip_tags_content = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $content);
    $strip_tags_content = strip_tags($strip_tags_content);
    $strip_tags_content = trim($strip_tags_content);
    $count = mb_strlen($strip_tags_content, 'utf-8');
    return $count;
}


function create_year_month_day_lists($posts) {
    $result = array();

    foreach ($posts as $post) {
        $result[$post->created_at->year][$post->created_at->month][$post->created_at->day] [] = $post;
    }
//    foreach ($posts as $post) {
//        $result[$post->created_at->year][$post->created_at->month]['count'] = 0;
//    }
//    foreach ($posts as $post) {
//        $result[$post->created_at->year][$post->created_at->month]['count']++;
//    }


    return $result;
}


/*
 * end blog
 */

/*
 * other functions
 */

/**
 * 响应json数据
 * @param  mixed    $data
 * @param  integer  $err_code
 * @param  string   $err_msg
 * @param  string   $redirect_url
 * @return \Symfony\Component\HttpFoundation\Response
 */
function RJM($data, $err_code, $err_msg = '', $redirect_url = null)
{
    return response([
        'code' => $err_code,
        'error' => $err_msg,
        'data' => $data,
        'redirect' => $redirect_url,
    ]);
}

/**
 * @param string $ip
 * @return bool|mixed
 */
function GetIpLookup($ip = ''){
    $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
    if(empty($res)){ return false; }
    $jsonMatches = array();
    preg_match('#\{.+?\}#', $res, $jsonMatches);
    if(!isset($jsonMatches[0])){ return false; }
    $json = json_decode($jsonMatches[0], true);
    if(isset($json['ret']) && $json['ret'] == 1){
        $json['ip'] = $ip;
        unset($json['ret']);
    }else{
        return false;
    }
    return $json;
}

/*
 * end other functions
 */

