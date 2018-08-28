<?php 
require 'dbconfig.php';

$data1 = $_POST['data'];
$data = json_decode($data1, true);
$a = $_GET['a'];

// isset any data
if (isset($data1)){

// what is your conditiion save or delete
if ($a == 'save'){

	$movie_id1 = $data[0]['movie_id']; //movie id
	$user_id1 = $data[0]['user_id']; //userid
	$query_movie = "INSERT INTO `movies_meta` (movie_id,user_id) VALUES ('$movie_id1','$user_id1')"; // save movies
	mysql_query($query_movie);
/* All Genres insert db */
foreach ($data as $key ) {
	$genres = $key['genre_id']; // genre id
	$movie_id = $key['movie_id']; //movie id

	$check_genre = mysql_query("select * from `genres_meta` where genre_id='$genres' && movie_id='$movie_id'");
	$check_genre = mysql_num_rows($check_genre); 
if(!isset($check_genre)){	
	$query_genre = "INSERT INTO `genres_meta` (genre_id,movie_id) VALUES ('$genres','$movie_id')"; // save movies
	mysql_query($query_genre);
	}
 }

} elseif ($a == 'delete') {

	$movie_id1 = $data[0]['movie_id']; //movie id
	$query_movie = "DELETE FROM `movies_meta` WHERE movie_id = '$movie_id1'"; // save movies
	mysql_query($query_movie);

/* All Genres delete db */

/*
foreach ($data as $key ) {
	$genres = $key['genre_id']; // genre id
	$movie_id2 = $key['movie_id']; // genre id

	$query = "DELETE FROM `genres_meta` WHERE genre_id = $genres && movie_id = $movie_id2"; // save movies
	mysql_query($query);
}
*/

} else {
	echo 'Unauthorized';
}

}




?>