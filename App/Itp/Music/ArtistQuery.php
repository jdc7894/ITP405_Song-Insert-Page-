<?php
namespace Itp\Music;
use Itp\Base\Database; 
use \PDO;


class ArtistQuery extends Database {
	public function __construct(){
		parent::__construct();
	}
	public function getAll(){
		$sql = "
				SELECT id, artist_name 
				from music.artists
				ORDER BY artist_name
				";
		$statement = static::$pdo->prepare($sql);
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_OBJ); 
		return $results;
	}
}
?>

