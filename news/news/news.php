<?php

// News root directory w/o trailing slash
define ( '_D_' , str_replace('\\', '/', __DIR__) . '/');

require(_D_ . 'functions.php');
require(_D_ . 'news.conf');

header('Content-Type: text/html; charset=' . $charset);

//-------- Make Page List
$page = intval(@$_GET['page']);              // Get the current page number

//----- Get News List ------------
$newslist = getnews(_D_ . $newsfile);

//dump($newslist, '$newslist');

$total = count($newslist);

$top_news = false;
// $perpage SQL LIMIT (per page limit)
if($page < 0) {
    $page = 0;
    $perpage = 10; // Reset the current per page limit
    $top_news = true;
}

if (!$perpage) {
    $perpage = 20; // Reset the current per page limit
}
//dump($perpage, '$perpage');

// Reset the current page number
if (!$page) {
    $page = 1;
}
//dump($page, '$page');
    
$start = ($page - 1) * $perpage;              // SQL OFFSET
$end = $start + $perpage;

$news = [];

for ($i = $start; $i<$end; $i++) {
    if($i < $total) {
        $line = $newslist[$i];

        //18/05|SendMail - отправка почты через SMTP|Простая консольная программа на Delphi для отправки сообщений из командной строки или из подготовленного текстового файла. Допускает File Attach.<br>Компилятор: Delphi 2+|http://pascal.sources.ru/delphi/internet/sendmail.htm||vot
        $row = explode('|', $line);
        //dump($row, '$row');
        
        $news[] = [
            'date' => $row[0],
            'title' => $row[1],
            'text' => nl2br($row[2]),
            'link' => $row[3],
            'img' => $row[4], //         $img =~ s/\r//;
            'user' => $row[5],
        ];
    }
}

//dump($news, '$news');

$page_list = $top_news ? '' : paging($total, $perpage, $page, $url);

include(_D_ . $template);

exit;
