
<?php
	
	$search = ' WHERE sets.SetID LIKE "'.$_GET["search"].'%" OR sets.Setname LIKE "%'.$_GET["search"].'%" ';
	
	//$test = "sets.SetID LIKE '%".$_GET["search"]."%'";//Vi vill söka på setID, men i start vill vi inte ha alla.
	//$test_name="sets.Setname LIKE '%".$_GET["search"]."%'";
	$limit = $_GET["limit"];
	$order = $_GET["order"];
	
	
	
		/*if(!(isset($_GET["search"])))
		{
			$test = "sets.SetID='375-2'";
			$test_name = "sets.Setname='Castle'";
			$_GET["search"]="'375-2'";
		}*/
		if(!$order = $_GET["order"])
		{
			$order = "inventory.Quantity";
		}
		if(!$limit = $_GET["limit"])
		{
			$limit = 10;
		}

	/*Att offset ger 'bla' men search ger "bla"
	Långsam, vårt fel?*/

	/*$result = mysqli_query($link, //I FROM behöver vi sets?
	"SELECT sets.SetID, sets.Setname, images.ItemID, images.has_gif, images.has_jpg, images.has_largejpg, images.has_largegif FROM sets, images 
	WHERE ((sets.SetID LIKE $doubledeath) OR (sets.Setname LIKE "Castle")) AND sets.SetID=images.ItemID ORDER BY FIELD(SetID, ".$_GET["search"].") DESC LIMIT $limit"
	
	);*/
	
	$result = mysqli_query($link, //I FROM behöver vi sets?
	"SELECT sets.SetID, sets.Setname, images.ItemID, images.has_gif, images.has_jpg, images.has_largejpg, images.has_largegif
	FROM sets, images 
	$search AND sets.SetID = images.ItemID AND images.ItemtypeID = 'S'
	LIMIT 30"
	
	);

	print("<p>Hello World</p>");
	//print $test;	
	print "GET:". $_GET["search"];	
	

	
	?>
