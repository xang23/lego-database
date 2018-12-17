<!doctype html>


<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Grupp1 Lego</title>
		<link href="style.css" media="screen" rel="stylesheet" />
		
	</head>
	<body>
		<form action ="sida1.php" method="GET">
					<p>Search <input type="text" name="search"/></p>
					<p><input type="submit"/></p>
					
		</form>
		<table>
	
		<tr>
			<th>SetID</th>
			<th>Item-ID</th>
			<th>Setname</th>
			<th>Image</th>
		</tr>
		

	
		
		
	
<?php

$link = mysqli_connect("mysql.itn.liu.se" ,"lego","", "lego");
	
	


if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

include "search2.php";

//Sidan ska söka på ett setId elr setnamn, ge förslag på matchande sökresultat. Skriver man något som matchar 100% så kmr detta bara. Annars visas de som matchar fast i ordning.
//Koppla upp <li> blog.php?order=asc;<li> blog.php?order=desc&limit=10 colors.Colorname LIKE "%'.$_GET["search"].'%" OR Setname LIKE "%'.$_GET["search"].'%"  ;

//Search keyword thingy:

//Skriv ut alla poster
$urlBase="http://www.itn.liu.se/~stegu76/img.bricklink.com/";

while($row = mysqli_fetch_array($result)) {
	
	//För bild
	$SetID = $row['SetID'];
	$itemtype = 'S';
	$filetype;
	
	
	
	if($row['has_largegif']OR $row['has_largejpg']){
		$itemtype = 'SL';
		
			if ($row['has_largegif'])
			{
				$filetype = ".gif";
			}
			else
			{
				$filetype = ".jpg";
			}
		}
		else{
		$itemtype= 'S';	
			
			if($row['has_jpg'])
			{
				$filetype=".jpg";
			}
			else
			{
				$filetype=".gif";
			}
		}
		
	
	
	
	
	
	
	
	
	$fileName = $itemtype."/".$SetID.$filetype;
	$imgsrc = $urlBase.$fileName;
	
	
	$setname=$row['Setname'];
	
	print ("<tr><td><p>$fileName</p></td>");
	print ("<td><p>$SetID</p></td>");
	print ("<td><p>$setname</p></td>");
	print("<td><img src= $imgsrc alt=$fileName></td></tr>");
	}

mysqli_close($link);
						
?>

	
	
	</table>
		
	</body>
</html>