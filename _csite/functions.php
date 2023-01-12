<?php


//-------------------------------------------
// Display Site News

function grab_forum($fids='0',$number=1,$title='') {
  global $conf, $DB, $std, $ibforums;

//$conf['site_news_forum_ids']	= '90';
//$conf['site_news_max_rows']	= '10';
//  $forum_ids = explode(',',$conf['site_news_forum_ids']);
//require_once(THIS_PATH."../cgi-bin/news/news.cgi");

  require_once ROOT_PATH."sources/lib/post_parser.php";

  $parser = new post_parser();



//  $ibforums->lang = $std->load_words($ibforums->lang, 'lang_forum', $ibforums->lang_id);

  echo "
<H2 align='center'>$title</H2>\n";


  $query =  "SELECT * FROM ibf_topics 
  	     WHERE forum_id IN(".$fids.")
               AND approved='1'
               AND link_time IS NULL
               AND deleted='0' ";

  //+----------------------------------------------------------------
  // Do we have permission to view other posters topics?
  //+----------------------------------------------------------------
  
  if ( !$ibforums->member['g_other_topics'] ) {
    $query .= " AND starter_id='".$ibforums->member['id']."'";
  }
  
  //+----------------------------------------------------------------
  // Do we have CLUB permission ?
  //+----------------------------------------------------------------

  if ( !$std->check_perms( $ibforums->member['club_perms'] ) ) {
    $query .= " AND club='0'";
  }


  //+----------------------------------------------------------------
  // Finish off the query
  //+----------------------------------------------------------------
  
  $query .= " AND deleted=0
            ORDER BY last_post DESC
            LIMIT 0,".$number;
//            LIMIT 0,".$conf['site_news_max_rows'];
  
//DEBUG
//echo "query=".$query."<br>";

  $req = $DB->query($query);
  
  //+----------------------------------------------------------------
  // Grab the topics and print them
  //+----------------------------------------------------------------

  echo TopicListHeader();
  
  while ( $topic = $DB->fetch_row($req) ) 
  {

//DEBUG
//echo "<pre>topic=";
//print_r($topic);
//echo "</pre>";
//echo "<hr>\n";

    //+----------------------------------------------------------------
    // Grab the first post
    //+----------------------------------------------------------------


    $sql = "SELECT post
              FROM ibf_posts
    	      WHERE topic_id='".$topic['tid']."'
              ORDER BY pid
              LIMIT 1";

    $postreq = $DB->query($sql);

//    if ( !$DB->get_num_rows($main) and $this->first >= $ibforums->vars['display_max_posts'] ) {

    $row = $DB->fetch_row($postreq);
    $post = $row['post'];

$post = preg_replace("#\[CODE[^\]]*\].+?\[/CODE\]#ism",'',$post);
//$post = preg_replace("#\[ATTACH[^\]]*\].+?\[/ATTACH\]#ism",'',$post);
$post = preg_replace("#\[ATTACH[^\]]*\].*?\[/ATTACH\]#ism",'',$post);
    $post = preg_replace("/^\n*/",'',$post);
    $post = preg_replace("/\n+/","\n",$post);

    $len = strlen($post);

    $data = array(  TEXT      => $post,
    		SMILIES       => $row['use_emo'],
    		CODE          => 1,
    		SIGNATURE     => 0,
    		HTML          => 1,
    		HID	      => 0,
    		TID	      => $topic['tid'],
    		MID	      => $row['author_id'],
    	     );

    $post = $parser->prepare($data);

    $post = preg_replace("/<br\s*\/>/i",'<br>',$post);


    $apost = explode("<br>",$post);
    $rows = count($apost);
    array_splice($apost, 5);
    $post = '';
    foreach($apost as $line) {
      if(strlen($post)<255) $post .= $line."<br>";
    }

    $post = preg_replace("/<br>$/i","",$post);

//    $post = implode("<br>\n",$apost);

//    $post = substr($post,0,355);
//    if(strlen($post)<$len) $post .= '...';


    $post = preg_replace("/<img/","<img align=left hspace=8 onload='if(this.width>100) {this.resized=true; this.width=100;}'",$post);

    if($rows>5) $post .= ' ...';


    $topic['post'] = $post;



    echo RenderTopic($topic);
//    $topics[] = $topic;
  }


  echo "
</table>\n\n";

}


//------------------------------------
// Draw Single Topic Row
function RenderTopic($data) {
global $ibforums,$std;

//DEBUG
//echo "<pre>data=";
//print_r($data);
//echo "</pre>";
//echo "<hr>\n";

  $data['topic_icon'] = $data['icon_id']  
  		     ? '<img src="'.$ibforums->vars['img_url'].'/icon'.$data['icon_id'].'.gif" border="0" alt="">'
  		     : '&nbsp;';

  $data['start_date'] = $std->get_date( $data['start_date'], 'LONG' );
  $data['last_post'] = $std->get_date($data['last_post'], 'LONG');
  $data['last_post'] = str_replace(', ','<br>',$data['last_post']);

  $data['starter'] = ( $data['starter_id'] )
  		  ? "<a href='{$ibforums->base_url}showuser={$data['starter_id']}'>{$data['starter_name']}</a>"
  		  : "-".$data['starter_name']."-";
  if ($data['starter_id'] and $data['starter_id'] == $ibforums->member['id'] ) 
  { 
  	$data['starter'] = "<b>".$data['starter']."</b>"; 
  }

  $data['last_poster'] = ( $data['last_poster_id'] )
  	 	      ? "<noindex><a rel='nofollow' href='{$ibforums->base_url}showuser={$data['last_poster_id']}'>{$data['last_poster_name']}</a></noindex>"
  		      : "-".$data['last_poster_name']."-";

  if ($data['last_poster_id'] and $data['last_poster_id'] == $ibforums->member['id'] ) 
  { 
  	$data['last_poster'] = "<b>".$data['last_poster']."</b>"; 
  }

  if(!$data['posts'] ) $data['posts'] = "<b>{$data['posts']}</b>";

  if($data['description']) $data['description'] = "<div class='desc'>(".$data['description'].")</div>";
//  if($data['post']) $data['post'] = "".$data['post']."";

//    <td class='topic_icon'>
//    {$data['topic_icon']}</td>
//    <td class='topic_starter'>{$data['starter']}</td>
//    <td class='topic_posts'>{$data['posts']}</td>

return <<<EOF

  <tr class='topic'> 
    <td class='topic_lastpost'>
      {$data['last_post']}
    <br>
    {$data['last_poster']}
    </td>
    <td>
      {$data['go_new_post']}{$data['prefix']}
      <div class='topic_title'><noindex><a rel='nofollow' href='{$ibforums->base_url}showtopic={$data['tid']}&view=getnewpost'>{$data['title']}</a></noindex></div>
      {$data['description']}
      <div class='post'>{$data['post']}</div>
    </td>
  </tr>

EOF;
}

//----------------------------------
function TopicListHeader() {
  global $ibforums;

  return <<<EOF

<table border='0' width='100%' cellspacing='0' cellpadding='0'>
EOF;
//  <tr class='topiclist_header'> 
//    <th width='14%' align='center' nowrap="nowrap" class='titlemedium'>{$ibforums->lang['h_topic_starter']}</th>
//    <th width='14%' align='center' nowrap="nowrap" class='titlemedium'>{$ibforums->lang['h_topic_starter']}</th>
//    <td align='center' class='titlemedium'><img src='{$ibforums->vars['img_url']}/spacer.gif' alt='' width='20' height='1'></td>
//    <th width='45%' align='left' nowrap="nowrap" class='titlemedium'>{$ibforums->lang['h_topic_title']}</th>
//    <td align='center' class='titlemedium'><img src='{$ibforums->vars['img_url']}/spacer.gif' alt='' width='20' height='1'></td>
//    <th width='7%' align='center' nowrap="nowrap" class='titlemedium'>{$ibforums->lang['h_replies']}</th>
//    <th width='7%' align='center' nowrap="nowrap" class='titlemedium'>{$ibforums->lang['h_hits']}</th>
//  </tr>

//    <td align='center' class='titlemedium'><img src='{$ibforums->vars['img_url']}/spacer.gif' alt='' width='20' height='1'></td>
//    <th width='45%' align='left' nowrap="nowrap" class='titlemedium'>{$ibforums->lang['h_topic_title']}</th>
//    <td align='center' class='titlemedium'><img src='{$ibforums->vars['img_url']}/spacer.gif' alt='' width='20' height='1'></td>
//    <th width='14%' align='center' nowrap="nowrap" class='titlemedium'>{$ibforums->lang['h_topic_starter']}</th>
//    <th width='7%' align='center' nowrap="nowrap" class='titlemedium'>{$ibforums->lang['h_replies']}</th>
//    <th width='7%' align='center' nowrap="nowrap" class='titlemedium'>{$ibforums->lang['h_hits']}</th>
}



//-------------------------------------------
// Last Meetings
function our_meetings() {
  global $conf, $ibforums;

  require_once(THIS_PATH."ssi/meetings.html");

  echo "";

}


