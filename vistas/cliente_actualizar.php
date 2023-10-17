<div class="container is-fluid mb-6">
	<h1 class="title">Clientes</h1>
	<h2 class="subtitle">Actualizar Cliente</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['cliente_id_up'])) ? $_GET['cliente_id_up'] : 0;
		$id=limpiar_cadena($id);

		/*== Verificando cliente ==*/
    	$check_cliente=conexion();
    	$check_cliente=$check_cliente->query("SELECT * FROM clientes WHERE cliente_id='$id'");

        if($check_cliente->rowCount()>0){
        	$datos=$check_cliente->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/cliente_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="cliente_id" value="<?php echo $datos['cliente_id']; ?>" required >

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="cliente_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required value="<?php echo $datos['cliente_nombre']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Telefono</label>
				  	<input class="input" type="text" name="cliente_telefono" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}" maxlength="150" value="<?php echo $datos['cliente_telefono']; ?>" >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_cliente=null;
	?>
</div>