<?php
   function Nettruyen($url,$curl)
    {
        $string = $curl->getContent($url);
        preg_match('#<h1 class="title-detail">(.*)</h1>#imsU', $string, $name);
        preg_match('#<h2 class="other-name.*>(.*)</h2>#ismU', $string, $other_name);
        preg_match('#<li class="kind.*>(.*)</li>#imsU', $string, $the_loai);
        preg_match_all('#<a.*>(.*)</a>#imsU', $the_loai[1], $genres);
        preg_match('#<li class="author.*>(.*)</li>#ismU', $string, $tac_gia);
        preg_match('#<a.*>(.*)</a>#ismU', $tac_gia[1], $authors);
        preg_match('#<li class="status.*>.*<p class="col-xs-8">(.*)</p>#imsU', $string, $m_status);
        preg_match('#class="detail-content">.*<p>(.*)</p>#imsU', $string, $desc);
        preg_match('#col-image">.*src="(.*)".*>#ismU', $string, $cover);

        $manga                = array();
        $manga['other_name']  = !empty($other_name[1]) ? $other_name[1] : "Đang cập nhật";
        $manga['name']        = !empty($name[1]) ? trim($name[1]) : '';
        $manga['authors']     = !empty($authors[1]) ? $authors[1] : "Đang cập nhật";
        $manga['artists']     = !empty($authors[1]) ? $authors[1] : "Đang cập nhật";
        $manga['trans_group'] = "Đang cập nhật";
        $manga['genres']      = !empty($genres[1]) ? $genres[1] : '';
      return $manga ;
    }
?>