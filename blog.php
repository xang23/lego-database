<?php include "meny.txt";?>
		<div id="mainId" class="main">
			<div id="blogPosts" class="section">
			<h2> Blogg </h2>
			

			
			
			<?php
			$order = $_GET['order'];
			$limit = $_GET['limit'];
			
			//Koppla upp mot databasen
			$connection = mysqli_connect("mysql.itn.liu.se", "blog", "", "blog");
			
			if(!$order = $_GET['order']){
				$order = "desc";
			};
			if(!$limit = $_GET['limit']){
				$limit = 1000;
			};
			//$search = $_GET['blogSearch']
			$search = 'WHERE entry_heading LIKE "%'.$_GET['blogSearch'].'%" OR entry_text LIKE "%'.$_GET['blogSearch'].'%" OR entry_author LIKE "%'.$_GET['blogSearch'].'%" ';
			//$searchQuest = "SELECT * FROM blog ORDER BY entry_date $order LIMIT $limit".'WHERE * LIKE "%$search%"';
			
			//Ställ frågan
			$result = mysqli_query($connection, "SELECT * FROM jenru723 $search ORDER BY entry_date $order LIMIT $limit");
			
			//Skriv ut alla poster i svaret
			while($row = mysqli_fetch_array($result)) {
				$heading = $row['entry_heading'];
				$author = $row['entry_author'];
				$date = $row['entry_date'];
				$text = $row['entry_text'];
				
				print("<h3 class='blogTitle'>$heading</h3>\n");
				print("<p class='blogMeta'>$author, $date</p> \n");
				print("<p>$text</p>\n");
				print("<hr/>");
			}
			?>
		
			</div>
			
			<div id = "searchBar" class = "section">
				<form method="get">
					<div>
						<p>Sök:</p>
						<input type="text" name="blogSearch">
					</div>
					<div><input type="submit"></div>
				</form>
				
				<div class="searchBarLink"><a href="blog.php?order=desc">Visa poster med de nyaste först</a></div>
				<div class="searchBarLink"><a href="blog.php?order=asc">Visa poster med de äldsta först</a></div>
				<div class="searchBarLink"><a href="blog.php?order=desc&limit=10">Visa de 10 senaste posterna</a></div>
			</div>
		</div>
		<?php include "footer.txt";?>
	</body>
</html>