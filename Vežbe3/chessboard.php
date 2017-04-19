<!DOCTYPE html>  
<html>   
<head>   
	<title>Sahovska tabla</title>  
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style>
		td {
			width: 30px;
			height: 30px;
		}
		
		.white {
			background-color: white;
		}
		
		.black {
			background-color: black;
		}
	</style>
</head>
<body>
    <h3>Šahovska tabla</h3>
    <table width="270px" cellspacing="0px" cellpadding="0px" border="1px">
        <?php
			for($row = 1; $row <= 8; $row++) {
				echo "<tr>";
				for($col = 1; $col <= 8; $col++) {
					$total = $col + $row;
					if($total % 2 == 0) {
						$class = "black";
					} else {
						$class = "white";
					}
					echo "<td class=$class></td>";
				}
				echo "</tr>";
			}
        ?> 
    </table>  
</body>  
</html>  