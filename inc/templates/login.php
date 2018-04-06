    <div class="Login">
        <?php if (isset($_GET['err'])==1): ?>
            <div class="alert alert-danger">
              <strong>Datos incorrectos</strong>, verifica tus datos por favor.
            </div>
        <?php endif; ?>
		<div class="card">
            <div class="card-header">Iniciar sesión</div>
            <div class="card-body">
            	<form class="Login-form" method="POST" action="inc/functions/user.php">
                    <input type="hidden" name="home-url" value="">
            		<div class="form-group row">
            			<label for="user" class="col-md-4 col-form-label text-right">Usuario</label>
            			<div class="col-md-6">
            				<input id="user" type="text" class="form-control" name="fgevcv-user" value="" required="" autofocus="">
            			</div>
            		</div>
            		<div class="form-group row">
            			<label for="password" class="col-md-4 col-form-label text-right">Contraseña</label>
            			<div class="col-md-6">
            				<input id="password" type="password" class="form-control" name="fgevcv-password" required="">
            			</div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <input type="submit" name="fgevcv-login" value="Ingresar" class="btn btn-secondary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
