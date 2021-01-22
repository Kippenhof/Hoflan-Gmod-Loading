<?php
error_reporting(0);
// A Steam API Key is required so as to be able to contact steam and get a users profile image and name
// You can get a Steam API Key by visiting http://steamcommunity.com/dev/apikey
// Don't worry about the web address, it won't have any effect so just type in any web site
// Once you have your steam API Key simply paste the key below. (Make sure the quotation marks are still there or else it won't work)
$SteamAPIKey = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";


// Don't edit any of the PHP stuff here or else you may break the script
// If you website isn't displaying correctly then please make sure you have configured your loading url correctly

$error_url = 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI];
$error_url_test = $error_url . '?steamid=76561198000430367';
$error_url_server = $error_url . '?steamid=%s';

if (!isset($_GET["steamid"])) {
	die("Woops, you don't seem to be using the correct extension in the address bar to get the loading screen to work.<br />
	Please make sure it has the correct extension it should have ?steamid= at the end of it and look something like this: www.yourdomain.com/loading/index.php?steamid=%s<br /><br />

	You can use the link below which will automatically add a test steam id to see if your loading screen is configured properly<br />
	<a href='$error_url_test'>$error_url_test</a><br /><br />
	
	When setting your loading url please make sure you set the steam id to %s as shown in the link below<br />
	<a href='$error_url_server'>$error_url_server</a>
	
	");
}

$steamid64 = $_GET["steamid"];

$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $SteamAPIKey . "&steamids=" . $steamid64;
$json = file_get_contents($url);
$table2 = json_decode($json, true);
$table = $table2["response"]["players"][0];

?>

<!DOCTYPE HTML>
<html>
	<head>
    <!-- Hello, your reading the source code for the server load page -->
	<!-- Created by CaptainMcMarcus for CoderHire -->
    <!-- This is the HTML code below and is safe to edit to your needs -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta name="description" content="Wilkommen - Loading..." /> <!-- Webpage Description --> 
	<title>Hofload</title> <!-- Webpage Title -->
	<link href="style.css" rel="stylesheet" type="text/css" /> <!-- Links to the Stylesheet -->
    <link href="colour.css" rel="stylesheet" type="text/css" /> <!-- Links to the Stylesheet for main colours -->
	
    <script type="text/javascript" src="scripts/jquery.js"></script><!-- Link to jquery so we can do cool stuff -->
    <script type="text/javascript" src="scripts/cycle.js"></script><!-- For Rotating Backgrounds -->
    
    <script type="text/javascript"><!-- Script to center content -->
	$(document).ready(function() {
		//Changes volume of song. 0.5=50% volume
		$('.audio').prop("volume", 0.8);
			
		//Perfectly centres content to the middle of the screen both vertically and horizontally
		$(window).resize(function(){
			  $('.core-wrapper').css({
			   position:'absolute',
			   left: ($(window).width() 
				 - $('.core-wrapper').outerWidth())/2,
			   top: ($(window).height() 
				 - $('.core-wrapper').outerHeight())/2
			  });	
		});
		
		
		//Lets get thos backgrounds moving
		$('#background-scroll').cycle({ 
			fx: 'fade',
			pause: 0, 
			speed: 4500, //Time to fade into the next image [in milliseconds]
			timeout: 20000  //Time spent on image [in milliseconds]
		});		
		//Lets get thos pictures moving
		$('#img-scroll').cycle({ 
			fx: 'fade',
			pause: 0, 
			speed: 4500, //Time to fade into the next image [in milliseconds]
			timeout: 2500  //Time spent on image [in milliseconds]
		});
		// Initiate centre function
		$(window).resize();
	});
    </script>
    

	</head>
	
	<body>
    
    <div id="background-scroll"><!-- Add Backgrounds so we can have multiple ones -->
    	<!-- IF YOU NEED LESS BACKGROUNDS JUST REMOVE THEM OUT OF THE LIST -->
        <!-- TO ADD EXTRA BACKGROUNDS YOU NEED TO MODIFY THE STYLESHEET [ADVANCED USERS ONLY] -->
    	<div id="bg1"></div><!-- BG 1 -->
        <div id="bg2"></div><!-- BG 2 -->
        <div id="bg3"></div><!-- BG 3 -->
        <div id="bg4"></div><!-- BG 4 -->
        <div id="bg5"></div><!-- BG 5 -->
        <div id="bg6"></div><!-- BG 6 -->
        <div id="bg7"></div><!-- BG 7 -->	
   	</div>
    
    <div class="core-wrapper"><!-- Opens the wrapper so we can contain and center everything -->
    	
        <img src="images/logo.png" width="960" height="120" alt="Your Logo" /><!-- This adds in the logo, simply change logo.png to make this look different -->
    
    	<div id="left-items"><!-- Opens the wrapper for the left content, there isn't really much to change on the left side as it's dynamic -->
    
			<?php
				//PHP Code for the avatar display, it's probably best to leave this section alone
				echo "<div id=\"profile-wrap\">";
					
					//Add in the players avatar
					echo "<div id=\"profile-top\">";
						echo "<div id=\"avatarimg\">";
							echo "<img src=\"" . $table["avatarfull"] . "\" />";
						echo "</div>";
					echo "</div>";
					
					//Adds in the players name
					echo "<div id=\"profile-bottom\">";
						echo "<p>" . $table["personaname"] . "</p>";
					echo "</div>";
					
				echo "</div>";
            ?>
            <div class="clear"></div>
            
            <!--<li><img src="images/asuna.png" alt="Asuna SAO" name="asuna" style="position:absolute;top:50px;left:180px;z-index:-1;width:350px;height:350px;"/></li>-->
            <div class="title server">
            	<h2>Hof Lan</h2><!-- Adds in the server title, you can change the text to be whatever you would like -->
           	</div>
            
            <!-- Lets get the server Details in here -->
            <ul id="server-list">
				
            	<li><img src="images/server-name.png" alt="Server Name" /> <span id="s-name">Server Name</span></li><!-- Dynamically adds the server name -->
                <li><img src="images/server-mode.png" alt="Game Mode" /> <span id="s-mode">Server Game Mode</span></li><!-- Dynamically adds game mode name -->
                <li><img src="images/server-map.png" alt="Map Name" /> <span id="s-map">Server Map Name</span></li><!-- Dynamically adds map name -->
			<div id="img-scroll"><!-- Add Backgrounds so we can have multiple ones -->
				<!-- IF YOU NEED LESS BACKGROUNDS JUST REMOVE THEM OUT OF THE LIST -->
				<!-- TO ADD EXTRA BACKGROUNDS YOU NEED TO MODIFY THE STYLESHEET [ADVANCED USERS ONLY] -->	

			</div>
			
           	</ul>
            
     	</div><!-- Close The Wrapper for the Left Items -->
        
        <div id="right-items"><!-- Open wrapper for the items on the right -->
        	
            <div class="title">
            	<h2>Regeln</h2><!-- Adds in the rules title, you can change the text to be whatever you would like -->
           	</div>
            
            <!-- Let's add in all the rules, the number inside the <span></span> tags will appear in a brighter coloured box  -->
            <ul id="rules">
            	<li><span>1</span> Kein Random Killen (es gelten Einschränkungen)</li>
                <li><span>2</span> Fair Play</li>
                <li><span>3</span> New-Live Regel bezogen auf Maps.</li>
                <li><span>4</span> Nicht Beleidigen</li>
                <li><span>5</span> Propkillen erlaubt. (nicht für Cedi)</li>
                <li><span>6</span> Nicht  DDossen. Bitte <3</li>
                <li><span>7</span> Kein Spamen</li>
                <li><span>8</span> Kein Bug Ambusing</li>
                <li><span>9</span> Nicht unnötig Trollen </li>

            </ul>
            <!--<li><img src="images/mirai.png" alt="Mirai Kyoukai no Kanata" name="mirai" style="position:absolute;top:0px;right:0px;z-index:-1;width:350px;height:350px;"/></li>-->
      	</div><!-- This close the right content wrapper -->
        
        <div class="clear"></div><!-- This clears things up so that we can vertically align things correctly -->
 <?php
	
	$musiclist = [
	1 => "music/1.ogg",
	2 => "music/2.ogg",
	3 => "music/3.ogg",
	4 => "music/4.ogg",
	5 => "music/5.ogg",
	6 => "music/6.ogg",
	7 => "music/7.ogg",
	8 => "music/8.ogg",
	9 => "music/9.ogg",
	10 => "music/10.ogg",
	11 => "music/11.ogg",
	12 => "music/12.ogg",
	13 => "music/13.ogg",
	14 => "music/14.ogg",
	15 => "music/15.ogg",
	16 => "music/16.ogg",
	17 => "music/17.ogg",
	18 => "music/18.ogg",
	19 => "music/19.ogg",
	20 => "music/20.ogg",
	21 => "music/21.ogg",
	22 => "music/22.ogg",
	23 => "music/23.ogg",
	24 => "music/24.ogg",
	25 => "music/25.ogg",
	26 => "music/26.ogg",
	27 => "music/27.ogg"

	];
	$musicname = [
	1 => "Jeremiah Perez - I Thought I Farted but I Shit",
	2 => "shittyflute - I'VE GOT NO FRIENDS",
	3 => "Rainer Winkler - Skrrr Skrrr",
	4 => "Mariachi Vargas de Tecalitlán - Jarabe Tapatio",
	5 => "Super27 - İsyan Tetick Patlamaya Devam",
	6 => "neofish - Retrowave",
	7 => "Slimek - CS:GO Theme - Synthwave Remix",
	8 => "Randy Crenshaw - Perry The Platypus Theme Song",
	9 => "Vigiland - Friday Night‬‬‬",
	10 => "LITTLE BIG - TACOS",
	11 => "L'Orchestra Cinématique - Gravity Falls Theme | EPIC VERSION",
	12 => "thelonelyisland - Jack Sparrow (feat. Michael Bolton)",
	13 => "Dopedrop, Alfons - Basta Boi Remix",
	14 => "Zwoa Bier - Kater-Song",
	15 => "PSYCHOSTICK - We Ran out of CD Space",
	16 => "Rucka Rucka Ali ~ Deportito",
	17 => "pi pi - Baustelle song",
	18 => "NilsOfficial Avicii & Rick Astley - Never Gonna Wake You Up  [ Mashup ]",
	19 => "TOTO, shittyflute - Africa SHITTYFLUTED",
	20 => "Dopedrop, Bony M - Rasputin Remix",
	21 => "Matthew Taranto - Bohemian WAApsody (Queen sung by five Waluigis)",
	22 => "Alexander Marcus - Homo Dance",
	23 => "Mirella Precek - Ein Strauß Clamydien",
	24 => "Los Cuates de Sinaloa - Negro Y Azul [Heisenberg Song]",
	25 => "Randy Newman - Monster Inc. [Good Version]",
	26 => "Piano Fantasia - for denise [Wide Putin ER]",
	27 => "Dieter Falk, Michael Kunze - Wer ist Martin Luther? (L-U-T-H-E-R)",
	];
	$rand = rand(1,sizeof($musiclist));
	
    echo '<audio id="bgmusic" class="audio" autoplay autobuffer="autobuffer" volume="0.9">';
    echo '<source src='.$musiclist[$rand].' type="audio/ogg">';
    echo '</audio>' ;
	echo '<div id="songbg"><h3 id="mc"> Aktuelles Lied: </h3><h4 id="song">'.$musicname[$rand].'</div>';

 ?>       
        <!-- This adds in the progress bar -->
        <div id="bar">
        	<div id="bar-width" style="width: 0%;"></div>
       	</div>
        
        <!-- This adds in the progress percentage bar -->
        <div id="percentage">
        	<p></p>
       	</div>
        
        <!-- This adds the current item being downloaded, we use the word connecting by default because if we don't download anything then it won't change -->
        <div id="download-item">
        	<p>Connecting...</p>
      	</div>
    
    
    
    <!-- MUSIC SCRIPT -->
    <!-- To activate simply delete the comment tags and replace music.mp3 with the path to your sound file. -->
    <!-- Adding copyrighted music is illegal as you will be redistributing from the server this is hosted from, this means that you will be held liable -->
    
    <!--
    <audio class="audio" autoplay autobuffer="autobuffer">
    	<source src="music.ogg" type="audio/ogg">
    </audio>
 -->
 
	</div><!-- now we close the core wrapper to keep everything nicely contained and in the middle -->
    <script type="text/javascript" src="scripts/main.js"></script><!-- Script to get downloads, map, players, game mode and sort out the loading bar -->

	</body><!-- Closes off the HTML Document -->
</html>
