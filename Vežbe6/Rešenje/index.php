<!DOCTYPE html>
<html>
<head>
	<title>Vremenska prognoza</title>
	<meta charset="utf-8">
	<link type="text/css" rel="stylesheet" href="style.css"/>
</head>
<body>
	<?php
	$json = file_get_contents("data.json");
	$data = json_decode($json, true);
	?>
	
	<div class="naslov">
		<h1>Vremenska prognoza</h1>
		<h2>Lokacija: <?php echo $data["city"]["name"] . ", " . $data["city"]["country"]; ?></h2>
	</div>
	
	<?php
	$row_template = 
"<div class=\"CLASS\">
	<h3>Datum: NUMBER</h3>
	<img src=\"http://openweathermap.org/img/w/ICON_ID.png\"><br>
	DESCRIPTION<br>
	Temperatura: TEMPERATURE&#8451;<br>
	Oblačnost: CLOUDS%<br>
	Pritisak: PRESSURE mbar
</div>";

	$kelvin_to_celsius = 273.15;
	while ($element = each($data["list"])) {
		$value = $element["value"];
		$weather = $value["weather"][0];
		$temp = $value["temp"];
		
		$class;
		if (array_key_exists("rain", $value) && $value["rain"] > 3) {
			$class = "kisovito";
		} else {
			$class = $value["clouds"] < 20 ? "suncano" : "oblacno";
		}
		
		$row = str_replace("CLASS", $class, $row_template);
		$row = str_replace("NUMBER", date('d. m. Y.', $value["dt"]), $row);
		$row = str_replace("ICON_ID", $weather["icon"], $row);
		$row = str_replace("DESCRIPTION", $weather["main"] . " (" . $weather["description"] . ")", $row);
		$row = str_replace("TEMPERATURE", (int)(($temp["min"]+$temp["max"])/2-$kelvin_to_celsius), $row);
		$row = str_replace("CLOUDS", $value["clouds"], $row);
		$row = str_replace("PRESSURE", $value["pressure"], $row);
		
		echo $row;
	}
	?>
</body>
</html>