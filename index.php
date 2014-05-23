<!-- (c) 2013-2014 mkalte666 (mkalte666 [AT HERE THE @] googlemail.com -->
<html>
	<head>
		<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
		<title>Devil Streaming - A quick search for Music</title>
		<style type="text/css">
			body {
				background-color: 	#eeeeee;
				color:			#555555;
			}
			#plist {
				background-color:	#ffffff;
				color:			#5555ff;
				-moz-border-radius: 40px;
				-webkit-border-radius: 40px;
				border-radius: 40px;
				text-align: center;
			
			}
			iframe {
  				border: none;
			}
			#pbutton {
				width: 80%;
				border-radius: 2px;
				background-color: #333333;
				color: #ffffff;
				border-style: none;
			}
			#searchtext {
				width: 20%;
				height: 20px;
				margin-left: 20%;
			}
			#sbutton {
				background-color: #333333;
				color: #ffffff;
				height: 20px;
				border-style: none;
			}
			
		</style>
		<script type="text/javascript">
			titles = "";	
			function addTitle(artist, song, id) {
				if(titles=="") document.getElementsByName("plist")[0].innerHTML = "";
				titles += id+",";
				pliststring = artist + " - " + song + "<br>";
				document.getElementsByName("plist")[0].innerHTML += pliststring;
			}
			function PlayAll()
			{
				document.getElementsByName("player")[0].src = "./play.php?play="+titles;
				titles = "";
			}
		</script>
	</head>
	<body>
		<div id="title" align="center">
			<p><h1>Listen to your favorite musik</h1></p>
			<p><h2>Just type your search and be happy!</h2></p>
		</div>
		<div width="100%" name="player_frame" align="right">
			<table width="100%"><tr>
			<td name="plist" id="plist" width="80%" height="250"></td>
			<td>
			<?php 
				if(!isset($_GET['play'])) echo '<iframe name="player" width="300" height="290" scrolling="no">';
				else {
					$plistdata = $_GET['play'];
					echo "<iframe src=\"./play.php?play=$plistdata\" name=\"player\" width=\"300\" height=\"290\" scrolling=\"no\">";
				}
			?>
			</iframe></td>
			</tr></table>
		</div>
		<button id="pbutton" onclick="PlayAll()" >PLAY!</button>	
		<div name="search_frame" align="left">
			<form name="search_form" id="serach_form_id" method="POST" target="searchframe" action="./search.php">
				<p><input type="text" id="searchtext"name="query" \>
				<input type="submit" value="Search!" id="sbutton"\></p>
				<p>				
				<?php if(!isset($_GET['s'])) echo "<iframe name=\"searchframe\" width=\"100%\" height=\"45%\" >";
				  else {
					$urlsearch = $_GET['s'];
					echo "<iframe src=\"./search.php?s=$urlsearch\" name=\"searchframe\" width=\"100%\" height=\"45%\" >";
					}
				?>
				</iframe></p>
			</form>
		</div>
		<div align="center">POWERD BY GROOVESHARK TINYSONK API | (c) 2013-2014 <b>mkalte666</b> ( mkalte666 [put the AT (@) here] googlemail.com )</div>
	</body>
</html>

