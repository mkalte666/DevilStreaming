<!DOCTYPE html>
<!-- (c) 2013-2014 mkalte666 (mkalte666 [AT HERE THE @] googlemail.com -->
<div align="center">
<?php
	function request_search($query) {
		$APIKey = "YOUR_TINYSONGAPI_KEY_HERE";
		$message = "http://tinysong.com/s/";
		$message .= urlencode($query);
		$message .= "?format=json&limit=32&key=";
		$message .= $APIKey;
		$request = utf8_encode(file_get_contents($message));
		
		$data = json_decode($request);
		return $data;
	}
	
	function is_in_list($objects, $name) 
	{
		for ($i = 0; $i<count($objects ); $i++) {
			$obj = $objects[$i];
			if($obj->name == $name) return $i;
		}
		return -1;
	}
	
	class song
	{
		public $interpret;
		public $album;
		public $name;
		public $id;
	}
	
	class album
	{
		public $interpret;
		public $name;
		public $id;
		public $songs = array();
		public function AddSong($song)
		{
			if(!$this->IsSongInList($song)) 
				$this->songs[] = $song;
				
		}
		
		public function IsSongInList($insong)
		{
			foreach($this->songs as $song) {
				if($insong->id == $song->id) return TRUE;
			}
			return FALSE;
		}
	}
	
	class interpret
	{
		public $name;
		public $albums = array();
		public function AddAlbum($album) {
				$albums[] = $album;
		}
		public function AddSong($song) {
			$albumID = is_in_list($this->albums, $song->album);
			if($albumID == -1) {
				$new_album = new album();
				$new_album->name = $song->album;
				$this->albums[] = $new_album;
				//array_push($albums, $new_album);
				$albumID = count($this->albums)-1;
			}
			$this->albums[$albumID]->AddSong($song);
		}
		
	}

	
	$query = "asdf";
	if(isset($_POST['query'])) $query = $_POST['query'];
	else if(isset($_GET['s'])) $query = $_GET['s'];
	
	$data = request_search($query);
	
	
	$interprets = array();
	//Next step is that we parse every field for our query-return. Is there an Interpret with this name? Such things.
	foreach($data as $line) {
		//Lets add our search to our Interpret-system. 
		$song = new song();
		$song->interpret = $line->ArtistName;
		$song->album = $line->AlbumName;
		$song->name	= $line->SongName;
		$song->id = $line->SongID;
		
		$interID = is_in_list($interprets, $song->interpret);
		if($interID == -1) {
			$new_interpret = new interpret();
			$new_interpret->name = $song->interpret;
			$interprets[] = $new_interpret;
			$interID = count($interprets)-1;
		}
		$interprets[$interID]->AddSong($song);
	}
	//If we have an interpret with that name, we want to fill all its albums. -> Query with Interpret + Album-name
	foreach($interprets as $interpret) {
		if($interpret->name == $query) {
			foreach($interpret->albums as $album) {
				$interpret_query = $interpret->name." ".$album->name;
				$new_data_raw = request_search($interpret_query);
				foreach($new_data_raw as $new_data) {
					$song = new song();
					$song->interpret = $new_data->ArtistName;
					$song->album = $new_data->AlbumName;
					$song->name	= $new_data->SongName;
					$song->id = $new_data->SongID;
					$interID = is_in_list($interprets, $song->interpret);
					if($interID == -1) continue; //If it has another interpret.. fail. 
					//NOTE: We dont exit if we find new albums, cause that is awesome and helpfull
					$interprets[$interID]->AddSong($song);
				}
				
			}
		}
	}
	
	
	//So. This is done. Next step is to test every interprets albums if their name is like $query, and if yes, search for interpret+query and add this.
	foreach($interprets as $interpret) {
		foreach($interpret->albums as $album) {
			if($album->name == $query) {
				$interpret_query = $interpret->name." ".$album->name;
				$new_data_raw = request_search($interpret_query);
				foreach($new_data_raw as $new_data) {
					$song = new song();
					$song->interpret = $new_data->ArtistName;
					$song->album = $new_data->AlbumName;
					$song->name	= $new_data->SongName;
					$song->id = $new_data->SongID;
					$interID = is_in_list($interprets, $song->interpret);
					if($interID == -1) continue; //If it has another interpret.. fail. 
					$albumID = is_in_list($interprets[$interID]->albums, $song->album); //Also fail if we have another album
					if($albumID == -1) continue; 
					//Here we go!
					$interprets[$interID]->AddSong($song);
				}
			}
		}
	}
	
	//Generate functions that add lists (like albums, interprets or the whole stuff)
	?>
	<script type="text/javascript">
	function AddAll() {
	<?php
	foreach($interprets as $interpret) {
		foreach($interpret->albums as $album) {
			foreach($album->songs as $song) {
				?>
				parent.addTitle(<?php echo "'".addslashes($song->interpret)."', '".addslashes($song->name)."', '$song->id'"; ?> );
				<?php
			}
		}
	}
	?>
	}
	</script>
	<?php
	
	//At the end we show all the Data we got
	echo "<table width=\"100%\"><tr><th>Interpret</th><th>Title</th><th>Album</th><th>Add to list?</th><tr>";
	foreach($interprets as $interpret) {
		foreach($interpret->albums as $album) {
			foreach($album->songs as $song) {
			
	?>
			<tr style="background-color: #dddddd;text-align: center" >
				<td><a href="./search.php?s=<?php echo $song->interpret; ?>"><?php echo $song->interpret?></a></td>
				<td><?php echo $song->name;?></td>
				<td><a href="./search.php?s=<?php echo $song->album; ?>"><?php echo $song->album;?></a></td>
				<td><button onclick="parent.addTitle(<?php echo "'".addslashes($song->interpret)."', '".addslashes($song->name)."', '$song->id'"; ?> )">Add to list</button></td>
			</tr>
<?php
			}
		}
	}
		echo "</table>";
	
?>
</div>
