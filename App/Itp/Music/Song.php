<?php
namespace Itp\Music; 

use Itp\Base\Database; 
use \PDO;

// Song class
class Song extends Database {
	private $title;
	private $artistID;
	private $genreID;
	private $price;
	private $id;
	public function __construct()
	{
		parent::__construct();
	}
	public function setTitle($title)
	{
		$this->title = $title;
	}
	public function setArtistId($artistID)
	{
		$this->artistID = $artistID;
	}
	public function setGenreId($genreID)
	{
		$this->genreID = $genreID;
	}
	public function setPrice($price)
	{
		$this->price = $price;
	}
	public function save()
	{
		$sql = "
			INSERT INTO songs
			(title, artist_id, genre_id, price)
			VALUES ('$this->title', '$this->artistID', '$this->genreID', '$this->price') 
				
		";
		$statement = static::$pdo->prepare($sql);
		$statement->execute();
		$this->id = static::$pdo->lastInsertId();	
		
	}
	public function getTitle()
	{
		return $this->title;
	}

	public function getId()
	{
		return $this->id;
	}
}