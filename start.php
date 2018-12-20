<?php include "txt/header.txt";?>

<!-- Avslutande av header-div -->
			<h3>Beskrivande text kommer...</h3>
		</div>
		
		<div id="searchBar">
		<form id="myForm" action ="searchresult.php" method="GET">
		<!-- Hela "sökfönstret" -->
			<div id="searchField">
			<p>Search <input type="text" name="search"/></p>
			<!-- Söktext in i denna -->
			</div>
			<div id="serachButton">
			<p><input type="submit" /> </p>
			</div>
			
			<div id="catergorySearch">
			</div>
			<div id="yearSearch">
			</div>
			<div id="sortBy">
				<?php
					include "radio.txt";	
				?>
			</div>
			</form>
		</div>

	</body>
</html>