<!DOCTYPE html>
<!-- (c) 2013-2014 mkalte666 (mkalte666 [AT HERE THE @] googlemail.com -->
<html>
	<head>
		<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
		<title>Devil Streaming - A quick search for Music</title>
		<style type="text/css">
			body {
				background-color: 	#eeeeee;
				color:			#555555;
				padding-bottom:3em;
			}
			
			#title {
				text-align: center;
			}
			#player_table {
				width: 100%;
			}
			
			#plist {
				background-color:	#ffffff;
				color:			#5555ff;
				-moz-border-radius: 40px;
				-webkit-border-radius: 40px;
				border-radius: 40px;
				text-align: center;
				width:80%;  

			}
			#plist_div {
				height:250px;
				max-height:250px;
				overflow:auto; 
			}
			
			iframe {
  				border: none;
			}
			
			
			#addallbutton {
				width: 30%;
				border-radius: 2px;
				background-color: #333333;
				color: #ffffff;
				border-style: none;
			}
			#searchframe {
				position: absolute;
				width: 100%;
				height: 40%;
			}
			
			#pbutton {
				width: 50%;
				left: 30%;
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
			
			#footer {
				position:absolute;
				bottom:0%;
				text-align:center;
				padding:10px;
				margin-left: 25%;
        }
			
		</style>
		<script type="text/javascript">
			titles = "";	
			function addTitle(artist, song, id) {
				if(titles=="") document.getElementById("plist_data").innerHTML = "";
				titles += id+",";
				pliststring = artist + " - " + song + "<br>";
				document.getElementById("plist_data").innerHTML += pliststring;
			}
			function PlayAll()
			{
				document.getElementsByName("player")[0].src = "./play.php?play="+titles;
				titles = "";
			}
			function AddAll()
			{
				document.getElementsByName('searchframe')[0].contentWindow.AddAll();
				window.frames["searchframe"].window.AddAll();
			}
		</script>
	</head>
	<body>
		<div id="title" >
			<h1>Listen to your favorite musik</h1>
			<h2>Just type your search and be happy!</h2>
		</div>
		<div id="player_frame">
			<table id="player_table"><tr>
			<td id="plist" ><div id="plist_div"><p id="plist_data">~</p></div></td>
			<td>
			<?php 
				if(!isset($_GET['play'])) echo '<iframe name="player" width="300" height="300" >';
				else {
					$plistdata = $_GET['play'];
					echo "<iframe src=\"./play.php?play=$plistdata\" name=\"player\" width=\"300\" height=\"300\" >";
				}
			?>
			</iframe></td>
			</tr></table>
		</div>
		<button id="pbutton" onclick="PlayAll()" >PLAY!</button>
		<button id="addallbutton" onclick="AddAll()" >ADD ALL</button>
		<div id="search_frame">
			<form name="search_form" id="serach_form_id" method="POST" target="searchframe" action="./search.php">
				<p><input type="text" id="searchtext" name="query" />
				<input type="submit" value="Search!" id="sbutton"/></p>
				<p>				
				<?php if(!isset($_GET['s'])) echo "<iframe name=\"searchframe\" id=\"searchframe\"  >";
				  else {
					$urlsearch = $_GET['s'];
					echo "<iframe src=\"./search.php?s=$urlsearch\" id=\"searchframe\" name=\"searchframe\"  >";
					}
				?>
				</iframe></p>
			</form>
		</div>
		<div id="footer"><p>POWERD BY GROOVESHARK TINYSONK API | (c) 2013-2014 <b>mkalte666</b> ( mkalte666 [put the AT (@) here] googlemail.com )</p></div>
	</body>
</html>

