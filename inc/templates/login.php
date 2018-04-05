	<div class="Login">
		<div class="card">
            <div class="card-header">Iniciar sesión</div>
            <div class="card-body">
            	<form class="Login-form" method="POST" action="lista-concesionarios.php">
            		<div class="form-group row">
            			<label for="user" class="col-md-4 col-form-label text-right">Usuario</label>
            			<div class="col-md-6">
            				<input id="user" type="text" class="form-control" name="fge-user" value="" required="" autofocus="">
            			</div>
            		</div>
            		<div class="form-group row">
            			<label for="password" class="col-md-4 col-form-label text-right">Contraseña</label>
            			<div class="col-md-6">
            				<input id="password" type="password" class="form-control" name="fge-password" required="">
            			</div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-secondary">Ingresar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>