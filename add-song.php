<?php

require_once __DIR__ . '/vendor/autoload.php';

use \Symfony\Component\HTTPFoundation\Session\Session;
use \Itp\Music\ArtistQuery;
use \Itp\Music\GenreQuery;
use \Itp\Music\Song;

$session = new Session();
$session->start(); 

if (isset($_POST['submit'])) {

	$title = $_POST['title'];
	$artist = $_POST['artist'];
	$genre = $_POST['genre'];
	$price = $_POST['price'];
	$song = new Song();
	$song->setTitle($title);
	$song->setArtistId($artist);
	$song->setGenreId($genre);
	$song->setPrice($price);
	$song->save();
	$session->getFlashBag()->add('add-success', '<p>The song "' . $song->getTitle() . '" with an ID of ' . $song->getId() . ' was inserted successfully!</p>');
	header('Location: add-song.php');
	exit; 
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Song</title>
</head>	
<body>

<?php
$artist_query = new \Itp\Music\ArtistQuery();
$artists = $artist_query->getAll();
$genre_query = new GenreQuery();
$genres = $genre_query->getAll();
?>

<div class="content">
	<div id = "container">
	<?php
		foreach ($session->getFlashBag()->get('add-success') as $message) {
			echo $message;
		}
	?>
	<form method="post">
	Title:
	<input type="text" name="title" required>
	<br><br>
	Artist:
		<select name="artist">

		<?php foreach($artists as $artist): ?>
		<div><?php echo '<option value="' . $artist->id . '">' . $artist->artist_name . '</option>' ?></div>
		<?php endforeach; ?>
		
		</select>

	<br><br>
	Genre:
		<select name="genre">
		<?php foreach($genres as $genre): ?>
		<div><?php echo '<option value="' . $genre->id . '">' . $genre->genre . '</option>' ?></div>
		<?php endforeach; ?>
		
		</select>
	<br><br>
		Price:
		<input type="text" name="price" required>
	<br><br>
	<button type="submit" name="submit">Submit</button>
	</form>
	<br><br>
</div>

</body>
</html>