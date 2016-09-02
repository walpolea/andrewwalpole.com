<?php
require_once('tumblr.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Andrew Walpole - Interactive Designer and Flash Developer</title>

<style type='text/css'>
@import url('css/main.css');
</style>


<script type="text/javascript">

var riaStats_protocol = (("https:" == document.location.protocol) ? "https://" : "http://");

var riaStats_siteID = "61a11423f06322e378d287fea9e5cf1c610ee0b1";

if(riaStats_protocol == "http://" && document.cookie.indexOf('riastats_lock') == -1)

document.write(unescape("%3Cscript src='" + riaStats_protocol + "riastats.com/browserPluginStat.js' type='text/javascript'%3E%3C/script%3E"));

</script>

</head>
<body>
	<div id='bar'></div>
	<div id='header'>
    	<div id='leftbar'>
        	<div id='barcap'></div>
            <div id='barname'><img src='images/bar_name.png' alt='Andrew Walpole - Flash Developer and Interactive Designer' /></div>
            <div id='bar_leftend'></div>
            <div style='clear:both;'><!-- clearing --></div>
        </div>
        <div id='nav'>
        	<a id='nav_blog' class='navon' href='index.php'><div class='navtext'>blog</div></a>
            <a id='nav_work' href='work.php'><div class='navtext'>work</div></a>
            <a id='nav_resume' href='resume.php'><div class='navtext'>resume</div></a>
            <a id='nav_contact' href='contact.php'><div class='navtext'>contact</div></a>
            <div style='clear:both;'><!-- clearing --></div>
        </div>
        <div id='rightbar'>
        	<div id='bar_rightend'></div>
            <div id='bar_contactinfo'><img src='images/bar_contactinfo.png' alt='andrew [at] andrewwalpole [dot] com' /></div>
            <div style='clear:both;'><!-- clearing --></div>
        </div>
        <div style='clear:both;'><!-- clearing --></div>
    </div>
    <div id='content'>
		<h1>Who Am I</h1>
		<p>I'm an Interactive Designer and Flash Developer currently based in San Diego, California. Technological creativity is my passion. I love to dream, invent, create, design, develop, and build all things tech. I spend most of my time designing and developing interactive experiences with Flash. However I also wield other technologies like Javascript, HTML, CSS, PHP, Video, Motion Graphics, Audio, Photoshop, Illustrator, Flex, AIR, and more. If you're interested check out some of my <a href='/v4/work'>work</a>.
    	<h1>Blog</h1>
    	<?php
			echo getPosts($_GET['p']); 
			if(getPostCount() > ($_GET['p']+1)*3) { 
		?>
				<a style='padding:0 15px;' href='/v4/index.php?p=<?= $_GET['p']+1 ?>'>Older</a>
		<?php
			}
			if($_GET['p'] > 0) { 
		?> 
				<a style='padding:0 15px;' href='/v4/index.php?p=<?= $_GET['p']-1 ?>'>Newer</a>
		<?php
			}
		?>
    </div>
</body>
</html>
