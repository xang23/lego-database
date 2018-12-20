<?php
	//om sökrutan är tom sök inget
	
		
		$sequered = mysqli_real_escape_string($link, $_GET["search"]);
		
		$search = ' WHERE (sets.SetID LIKE "'.$sequered.'%" OR sets.Setname LIKE "%'.$sequered.'%") ';
		
	if(isset($_GET["search"]))
	{
		
		//$test = "sets.SetID LIKE '%".$_GET["search"]."%'";//Vi vill söka på setID, men i start vill vi inte ha alla.
		//$test_name="sets.Setname LIKE '%".$_GET["search"]."%'";
		$limit = $_GET["limit"];
		$order = mysqli_real_escape_string($link, $_GET["searchorder"]);
		
		
		
			//Spara radiobuttons och söka antingen på setID eller setname
				if ($_GET["searchorder"] == "sbname")
				{
					$order = "Setname, SetID";
					setcookie("rbutton", "sbname" , time()+(60*60*24*30));
				}
				else
				{
					$order = "SetID, Setname";
					setcookie("rbutton", "sbid" , time()+(60*60*24*30));
				}
				
				
				/*
				if(isset($_GET["pagenr"]))
				{
					$pagenr=$_GET["pagenr"];
				}
				else
				{
					$pagenr = 1;
				}
				
				$d_offset_pp=2;
				$offset=($pagenr-1)*$d_offset_pp;
				
				$tot_p_sql ="SELECT COUNT(*) FROM TABLE";
				$res= mysqli_query($conn,$tot_p_sql);
				$total_rows= mysqli_query($res)[0];
				$total_pages= ceil($total_rows/$d_offset_pp);
				
				$sql =""
				*/
				
				
				//visa nästa sida av sökning eller tidigare
		
				
				/*
				else if(isset( $_GET["next"])
				{
					$offset += 2;
				}
				else {}*/
				
				
			
			echo "rbutton = ".$_COOKIE['rbutton'];
			if(!$limit = $_GET["limit"])
			{
				$limit = 15;
			}

			
			print "GET:". $_GET["searchorder"]. "end";
		
		
		$result = mysqli_query($link, //I FROM behöver vi sets?
		"SELECT sets.SetID, sets.Setname, images.ItemID, images.has_gif, images.has_jpg, images.has_largejpg, images.has_largegif
		FROM sets, images 
		$search AND sets.SetID = images.ItemID AND images.ItemtypeID = 'S'
		ORDER BY $order 
		LIMIT $limit" //Vi vill ha en offset här < så att man kan visa de andra satserna! Helst med hjälp av att klicka på en knapp elr något.
		);


		
	

	}
	else{
		echo "din sökning:".$_GET['search'];
		
	}
	
	
	?>