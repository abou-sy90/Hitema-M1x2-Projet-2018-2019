<?php include './assets/inc/application_include.php'; ?>
<html>        
    <head>
        <title>Accueil</title>
        <!-- Les includes communs -->
        <?php include $MyHomePath.'assets/inc/head.php'; ?>
        <!-- Les includes de groupes pour la page -->
        <script src="./assets/js/connexion.js"></script>
        <?php include $MyHomePath.'assets/inc/include_allModule.php'; ?>
    </head>
	<body>
	<center>
		<section class="login-block">
		<?php 

			$container = $_POST['id_container'];
			$module = $_POST['type_module'];
			$vue = $_POST['id_vue'];
			$res = Affiche_Details_Module($module, $vue, $container);
			
			echo "<table style='border:1px solid white;'>";
			$entete = 1;
			foreach ($res as $idLine => $line) {
				echo "<tr>".$line->AfficherModule($entete)."</tr>";
				$entete = 0;
			}
			echo "</table>";

		?>
		
		<form action="EcranVue.php" methode="POST">
			<input id="RealViewId" name="vueId" type="hidden" value='<?php //echo $vue ?>'>
			<input type="submit" value="Retour">
			

		</form>
		
		

		</section>
		</center>
	</body>
</html>