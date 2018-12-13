<?php include "header.txt";?>

		</div>
		<div class="main">
			 <div id="setLeftColumn">
				<div id="setInfo">
					<?php
						//Koppla upp mot databasen
						$connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
						
						if (!$connection) {
							die ('MySQL connection error.');
						}
						//$searchID = $_GET['searchID'];//
						$searchID = "'383-2'";
						
						$urlBase="http://www.itn.liu.se/~stegu76/img.bricklink.com/";

						$contents = mysqli_query($connection,
						"SELECT sets.Setname, sets.SetID, sets.Year, categories.Categoryname, images.has_gif,
						images.has_jpg, images.has_largegif, images.has_largejpg
						FROM sets, categories, images 
						WHERE sets.SetID = $searchID AND sets.CatID = categories.CatID AND images.ItemID = sets.SetID
						LIMIT 30");
						
			

						
						//Skriver ut satsnamn, sats ID, år och katergori
						while($row = mysqli_fetch_array($contents)){
							
							//För bild
							$SetID = $row['SetID'];
							$itemtype = 'S';
							$filetype;
							
							if($row['has_gif'] OR $row['has_largegif']){
								$filetype = ".gif";
								
								if($row['has_largegif']){
								$itemtype = 'SL';
								};
							}
						
							else{
								$filetype = ".jpg";
								
								if($row['has_largejpg']){
								$itemtype = 'SL';
								};
							};
							
							
							$fileName = $itemtype."/".$SetID.$filetype;
							$imgsrc = $urlBase.$fileName;
							print("<img src= $imgsrc alt=$fileName>");
	
							$Setname = $row['Setname'];
							$SetYear = $row['Year'];
							$SetCat = $row['Categoryname'];
							
							print("<h3>$Setname</h3>\n");
							print("<p> SetID: $SetID </p> \n");
							print("<p> År: $SetYear </p> \n");
							print("<p> Kategori: $SetCat </p> \n");
							
						}
						
			
						// Räknare för antal totala bitar i ett set
						$setQuantity = mysqli_query($connection,
						"SELECT inventory.Quantity
						FROM inventory
						WHERE inventory.SetID=$searchID
						LIMIT 30");
						
						$quantity = 0;
						while($quantRow = mysqli_fetch_array($setQuantity)) {
							$quantity += $quantRow['Quantity'];
						}
						
						print("<p>Quantity: $quantity</p>\n");
						
						$collectionQuant = mysqli_query($connection,
						"SELECT collection.Quantity
						FROM collection
						WHERE collection.SetID=$searchID
						LIMIT 30");
						
						
						//Kollar om satsen finns i samling
						if($colQuantRow = mysqli_fetch_array($collectionQuant)){
							
							$colQuant= $colQuantRow['Quantity'];
							
							print("<p>Satsen finns!</p>");
							print("<p>Antal av denna sats: $colQuant </p>");
						}
						else {
							print("<p>Satsen finns inte i din samling :(</p>");
							
							//Om ej i samling: kolla hur många av satsens bitar som finns i samling
							
							//Hur många av bitarna i söksatsen finns i andra satser i samlingen?
							
							//För varje bit i sökta satsen vill vi kolla om den biten finns i
							//någon annan sats i samlingen
							
							$partsInSet = mysqli_query($connection,
							"SELECT inventory.ItemID
							FROM inventory
							WHERE inventory.SetID=$searchID
							LIMIT 30"
							);
							
							//Display alla bitar och figurer i satsen som vi söker på - IN PROGRESS
							/*print("<table>");
							
							while($setRow = mysqli_fetch_array($partsInSet){
								print("<tr><td>$setRow['ItemID']</td></tr>");
							}
							
							print("</table>");*/
						}
						
						
						
						
						?>
						
						
				</div>
				
				<div id="availabilityInfo">
				</div>
			 </div>
			 <!-- php här? -->
			 <div id="setTable">
				<div id="minifigs">
				</div>
				
				<div id="parts">
				</div>
			 </div>
		
		</div>
	</body>
</html>
