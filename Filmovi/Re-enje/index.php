<!DOCTYPE html>
<html>
<head>
	<title>Filmovi</title>
	<meta charset="utf-8">
	<link type="text/css" rel="stylesheet" href="style.css"/>
</head>
<body>
	<?php
	$json = file_get_contents("data.json");
	$data = json_decode($json, true);
	?>
	
	<div class="naslov">
		<?php
			$godine = "";
			foreach ($data as $key => $value) {
				if ($godine) {
					$godine .= ", " . $key;
				} else {
					$godine = $key;
				}
			}
			echo "<h1>Najbolje ocenjeni filmovi za godine: $godine.";
		?>
	</div>
	
	<?php
	
	$movie_template = 
"<div class=\"CLASS\">
	<div class=\"film-zaglavlje\">
		<div class=\"film-naslov\"><h3>FILM_NASLOV</h3></div>
	</div>
	<div class=\"film-sadrzaj\">
		<img src=\"FILM_COVER\">
		<table>
			<tr><td>Datum:</td><td>FILM_DATUM</td></tr>
			<tr KLASA><td>Opis:</td><td>FILM_OPIS</td></tr>
		</table>
	</div>
</div>";
	
	foreach ($data as $key => $value) {
		echo "<div class=\"lista-filmova\"><h2>$key</h2>";
		foreach ($value as $movie) {
			$movie_html = str_replace("FILM_NASLOV", $movie["title"], $movie_template);
			$movie_html = str_replace("FILM_COVER", "http://image.tmdb.org/t/p/original" . $movie["poster_path"], $movie_html);
			$movie_html = str_replace("FILM_DATUM", $movie["release_date"], $movie_html);
			$movie_html = str_replace("FILM_OPIS", $movie["overview"], $movie_html);
			$movie_html = str_replace("KLASA", $movie["overview"] ? "" : "class=\"crveno\"", $movie_html);
			echo $movie_html;
		}
		echo "</div>";
	}
	?>
</body>
</html>