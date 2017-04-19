<!DOCTYPE html>
<html>
<head>
	<title>Moj profil</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/profile.css">
</head>
<body>
	<!-- Navigacija -->
	<div class="navigacija tamno">
		<a href="#" class="tamnije"><img src="images/home.png"> <span style="margin: 0px 20px;">Logo</span></a>
		<a href="#"><img src="images/globe.png"></a>
		<a href="#"><img src="images/pawn.png"></a>
		<a href="#"><img src="images/envelope.png"></a>
		<a href="#"><img src="images/bell.png"> 3</a> 
		<a href="login.html" id="logout-button"><img src="images/avatar.png"></a>
	</div>

	<!-- Glavni sadržaj -->
	<div id="sadrzaj">
		<div id="leva-kolona">
			<div class="kontejner svetlo">
				<div class="centrirano">
					<h3>Moj profil</h3>
					<img src="images/avatar.png" alt="Profilna slika" class="profilna-slika">
				</div>
				<hr>
				<p><img src="images/pencil_gray.png" class="ikonica"> Web programer</p>
				<p><img src="images/home_gray.png" class="ikonica"> Novi Sad, Srbija</p>
				<p><img src="images/cake_gray.png" class="ikonica"> 1.4.1995.</p>
			</div>
		</div>
			
		<div id="srednja-kolona">		
			<div class="kontejner svetlo">
				<form>
					Novi status: <input type="text" size="50">
					<input type="submit" value="Postavi">
				</form>
			</div>
			<?php

	$json = file_get_contents("posts.json");
	$data = json_decode($json, true);

	$posts = $data["wall"]["posts"];
	
	$postOriginal = "<div class=\"kontejner svetlo\">
				<div class=\"post-zaglavlje\">
					<img src=\"REPLACE_AVATAR\" alt=\"Avatar\" class=\"profilna-slika-zid\">
					<h4>REPLACE_NAME</h4>
					<p>REPLACE_TIME</p>
				</div>
				<div class=\"post-sadrzaj\">
					<p>REPLACE_CONTENT</p>
					REPLACE_IMG
				</div>
				<div>
				<button>Like</button> <button>Comment</button>
		
				
				<details>
  					<summary>REPLACE_NUM_OF_LIKES </summary>
  					<div class=\"kontejner svetlo\">REPLACE_LIKES</div>
				</details>
				
				<details>
  					<summary>REPLACE_NUM_OF_COMMENTS</summary>
  					<div class=\"kontejner svetlo\">REPLACE_COMMENTS</div>
				</details>
	
			</div>
			</div>";
			
	$commentOriginal = "
				<div>
				<div>
					<img src=\"REPLACE_AVATAR\" alt=\"Avatar\" class=\"profilna-slika-komentar\">
					<h4>REPLACE_NAME</h4>
					<p class=\"komentar-vreme\">REPLACE_TIME</p>
				</div>
				<div>
					<p>REPLACE_CONTENT</p>
				</div>
				<hr>
				</div>
			
				";
	
	$imgHtml = "<img src=\"REPLACE_IMGSRC\" width=\"30%\">";
	$detailsHTML;
	
	
	foreach($posts as $postInfo){
			$post=str_replace("REPLACE_AVATAR", $postInfo["avatar"], $postOriginal);
			$post=str_replace("REPLACE_NAME",$postInfo["name"],$post);
			$post=str_replace("REPLACE_TIME",$postInfo["time"],$post);
			$post=str_replace("REPLACE_CONTENT",$postInfo["content"],$post);
			$img="";
			foreach($postInfo["images"] as $imgs){
				$img.=str_replace("REPLACE_IMGSRC", $imgs, $imgHtml);
			}
			$post=str_replace("REPLACE_IMG",$img,$post);
			$post=str_replace("REPLACE_NUM_OF_LIKES",count($postInfo["likes"]).(count($postInfo["likes"])!=1?" Likes":" Like"),$post);
			$post=str_replace("REPLACE_NUM_OF_COMMENTS",count($postInfo["comments"]).(count($postInfo["comments"])!=1?" Comments":" Comment"),$post);
			
			$comments="";
			
			foreach ($postInfo["comments"] as $comment) {
				$commentsTemp=str_replace("REPLACE_AVATAR", $comment["avatar"], $commentOriginal);
				$commentsTemp=str_replace("REPLACE_NAME",$comment["name"],$commentsTemp);
				$commentsTemp=str_replace("REPLACE_TIME",$comment["time"],$commentsTemp);
				$commentsTemp=str_replace("REPLACE_CONTENT",$comment["content"],$commentsTemp);
				$comments.=$commentsTemp;
			}
			$post=str_replace("REPLACE_COMMENTS",$comments,$post);
			
			$likes="";
			foreach ($postInfo["likes"] as $like) {
				$likes.=$like.", ";
				
			}
			
			$likes=substr($likes, 0,strlen($likes)-2);
			$post=str_replace("REPLACE_LIKES",$likes,$post);
			
			echo $post;
		
	}


?>
			
		</div>
		<div id="desna-kolona">
			<div class="kontejner svetlo">
				<h4>Događaji:</h4>
				<img src="images/image3.jpg" width="200">
				<h5>Godišnji odmor</h5>
				<p>Petak u 15 h</p>
			</div>
			<div class="kontejner svetlo">
				<h3>Zahtevi za prijateljstvo:</h3>
				<div class="zahtev-za-prijateljstvo centrirano">
					<img src="images/avatar3.png">
					<h4>Milana Milanić</h4>
					<button>Prihvati</button> <button>Odbij</button>
				</div>
			</div>
			<div class="kontejner svetlo">
				<table border="1">
					<tr>
						<th colspan="2">Statistika</th>
					</tr>
					<tr>
						<td>Zahtevi za prijateljstvo</td>
						<td>1</td>
					</tr>
					<tr>
						<td>Broj dobijenih lajkova u proteklom mesecu</td>
						<td>36</td>
					</tr>
					<tr>
						<td>Broj tvojih postova u proteklom mesecu</td>
						<td>12</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html> 
