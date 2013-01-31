<!--
	Auteur : LAJALI Rachid.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-3166-1" />
        <title>Liste des Pays</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
    	<div id="container">
	        <h3>Liste des pays de monde</h3>
	        <?php
				mysql_connect('localhost', 'root', '');
				mysql_select_db('testDb');
				
				//
				$nombreLignePage = 5;
				$rqt = mysql_query('SELECT COUNT(*) AS nombreTotalLigne FROM countries');
				$total = mysql_fetch_array($rqt);
				$nombreTotalLigne = $total['nombreTotalLigne'];
				$nombrePage = ceil($nombreTotalLigne/$nombreLignePage);
				
				//
				$page = 1;
				if(isset($_GET['page']))
					$page = $_GET['page']; // On récupère le numéro de la page indiqué dans l'adresse (index.php?page=4)
					
					
				// On calcule le numéro du premier du liste qu'on prend pour le LIMIT de MySQL
				$premierListe = ($page - 1) * $nombreLignePage;
				
				//$result = mysql_query('SELECT * FROM countries LIMIT 25, 5');
				$result = mysql_query('SELECT * FROM countries LIMIT '.$premierListe.', '.$nombreLignePage);
			?>
	        <table>
	            <tr>
	                <th>Code</th>
	                <th>Pays 2 c</th>
	                <th>Pays 3 c</th>
					<th>Pays</th>
	            </tr>
				
	            <?php 
					$x = 0;
					while($data = mysql_fetch_array($result)) {?>
					<tr class="<?php if($x%2===0)echo "row-a"; else echo "row-b"; ?>">
						<td><?= $data['code']?></td>
						<td><?= $data['alpha2']?></td>
						<td><?= $data['alpha3']?></td>
						<td><?= $data['langFR']?></td>
					</tr>
	            <?php 
						$x++;
					}
				?>
	        </table>
			<?php
				echo 'Page :';
				
				$nbAvant = 5;
				$nbApres = 10;
				$depart  = $page - $nbAvant;
				$fin = $nbApres + $page;
				
				if($depart<1){
					$depart = 1;
					$fin = ($nbAvant + $nbApres) + 1;
				}
				if($fin > $nombrePage){
					$depart = $nombrePage - ($nbAvant + $nbApres);
					$fin = $nombrePage;
				}
				for($i = $depart; $i< $fin; $i++){
					$pg = $i;
					if($i == 1) $pg = "First";
					if($i == $nombrePage-1) $pg = "Last";
					if($i == $page){
						echo ' <a class= "page dark active" href=index.php?page='.$i.' ">'.$pg.'</a>';
					}else{
						echo ' <a class="page dark gradient" href = index.php?page=' .$i. '">'.$pg.'</a>';
					}
				}
			?>
		</div>
    </body>
</html>
