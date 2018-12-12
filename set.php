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
						$searchID = '375-2';
						
						$urlBase="http://www.itn.liu.se/~stegu76/img.bricklink.com/";

						/*$contents = mysqli_query ($connection,
						"SELECT sets.SetID, sets.Setname, sets.Year, images.has_gif, images.has_jpg, images.has_largegif, images.has_largejpg, images.ItemtypeID,
						images.ItemID, inventory.Quantity, collection.Quantity
						FROM sets, images, inventory, collection
						WHERE sets.SetID = '375-2' AND sets.SetID = inventory.SetID 
						AND inventory.ItemID = images.ItemID AND images.ItemtypeID = inventory.ItemtypeID"); */
						
						$contents = mysqli_query($connection,
						"SELECT sets.Setname, sets.SetID, sets.Year, categories.Categoryname 
						FROM sets, categories 
						WHERE sets.SetID = '375-2' AND sets.CatID = categories.CatID
						LIMIT 30");
						

						
						//Skriver ut satsnamn, sats ID, år och katergori
						while($row = mysqli_fetch_array($contents)){
							
						
							$Setname = $row['Setname'];
							$SetID = $row['SetID'];
							$SetYear = $row['Year'];
							$SetCat = $row['Categoryname'];
							
							print("<p> Setname: $Setname</p>\n");
							print("<p> SetID: $SetID </p> \n");
							print("<p> Year: $SetYear </p> \n");
							print("<p> Category: $SetCat </p> \n");
							
						}
						// Räknare för antal totala bitar i ett set
						$setQuantity = mysqli_query($connection,
						"SELECT inventory.Quantity
						FROM inventory
						WHERE inventory.SetID='375-2'
						LIMIT 30");
						
						$quantity = 0;
						while($quantRow = mysqli_fetch_array($setQuantity)) {
							$quantity += $quantRow['Quantity'];
						}
						print("<p>Quantity: $quantity</p>\n");
						
						
						
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
