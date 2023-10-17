<div class="main-container">
    <form class="box login" action="./php/main.php" method="POST" autocomplete="off">
        <h5 class="title is-5 has-text-centered is-uppercase">Inventarios Japocell</h5>

        <div class="field">
            <label for="usuario_usuario" class="label">Usuario</label>
            <div class="control">
                <input id="usuario_usuario" class="input" type="text" name="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
            </div>
        </div>

        <div class="field">
            <label for="usuario_clave" class="label">Clave</label>
            <div class="control">
                <input id="usuario_clave" class="input" type="password" name="usuario_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
            </div>
        </div>

        <p class="has-text-centered mb-4 mt-3">
            <button type="submit" class="button is-info is-rounded">Iniciar sesión</button>
        </p>
		
		<?php
			if(isset($_POST['usuario_usuario']) && isset($_POST['usuario_clave'])){
				require_once "./php/main.php";
				require_once "./php/iniciar_sesion.php";
			}
		?>
    </form>
</div>
