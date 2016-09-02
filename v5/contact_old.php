<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Andrew Walpole - Interactive Designer and Flash Developer - Contact</title>

<style type='text/css'>
@import url('css/main.css');
</style>

<style type="text/css">
#contact_left {
	margin:20px 50px 0 0;
	padding:0;
	
	width:350px;
	float:left;

}

#contact_right {
	margin:0;
	padding:0;
	
	width:300px;
	float:left;
}
</style>
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
        	<a id='nav_blog' href='index.php'><div class='navtext'>blog</div></a>
            <a id='nav_work' href='work.php'><div class='navtext'>work</div></a>
            <a id='nav_resume' href='resume.php'><div class='navtext'>resume</div></a>
            <a id='nav_contact' class='navon' href='contact.php'><div class='navtext'>contact</div></a>
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
    	<h1>Contact Me</h1>
    <div id="contact_left">
	<p>Feel free to contact me with any thoughts, questions, concerns or anecdotes you would like to share using the following form. If you prefer to use a traditional email client, I can be reached at <a href="mailto:andrew@andrewwalpole.com">andrew at andrewwalpole dot com</a></p>
    </div>
    <div id="contact_right">
        <div id="contactform">
            <form id="mailform" action="http://www.andrewwalpole.com/cgi-bin/formmail/formmail.pl" method="POST">
                <input id="recipient" name="recipient"  type="hidden" value="andrew@andrewwalpole.com" />
                <br />
                <label>who are you?</label><br />
                <input id="name" name="name" type="text" size="20" />
                <br />
                <br />
                <label>how can I contact you?</label><br />
                <input id="email" name="email" type="text" size="20" />
                <br />
                <br />
                <input type="hidden" id="subject" name="subject" value="A Message from AndrewWalpole.com" />
                <label>what would you like to tell me?</label><br />
                <textarea id="comments" name="comments" rows="8" cols="30" wrap="on"></textarea>
                <br />
                <input class="button" type="submit" value="deploy message" />
            </form>
        </div>
	</div>
    <div style='clear:both;'><!-- clearing --></div>
    </div>

</body>
</html>





