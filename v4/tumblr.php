<?php
require_once dirname(__FILE__).'/tumblr/clearbricks/_common.php';
require_once dirname(__FILE__).'/tumblr/class.read.tumblr.php';
require_once dirname(__FILE__).'/tumblr/class.utf8htmldecode.php';




function getPosts($p) {

	if(!$p) {
		$p = 0;
	}
	$tumblrObj = new readTumblr('andrewwalpole');
	$tumblrObj->getPosts($p*3, ($p*3)+3,'regular');
	$tumblrObj->sortArray();

	$tumblrArr = $tumblrObj->getArray();
	
	foreach($tumblrArr['posts'] as $post) {
		displayPost($post);
	}
	
}

function displayPost($post) {
	echo '<div id="post'.$post['id'].'" class="post">
	<h2>'.$post['content']['title'].'</h2>
	<div class="postbody">'.$post['content']['body'].'</div>
	<div class="postdate">'.date('F jS, Y', $post['timestamp']).'</div>
	<div class="postdivide"></div>
	</div>';
}

function getPostCount() {
	
	$tumblrObj = new readTumblr('andrewwalpole');
	
	$count = 0;
	$ret = 0;
	$inc = 0;
	
	do {
		$tumblrObj->getPosts(20*$inc, (20*$inc)+19,'regular');
		$tumblrArr = $tumblrObj->getArray();
		$tumblrObj->sortArray();
		$ret = count($tumblrArr['posts']);
		$inc++;
		$count += $ret;
	} while($ret >= 20);
	
	return $count;
}


/*
$tumblrObj = new readTumblr('andrewwalpole');
$tumblrObj->getPosts($p, $p,'regular');
$tumblrObj->sortArray();

$tumblrArr = $tumblrObj->getArray();
header('Content-Type: text/plain; charset=utf-8');
print_r($tumblrArr);
*/
?>