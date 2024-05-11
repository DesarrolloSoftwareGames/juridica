<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Themis 1.0</title>
  <link rel="icon" type="image/vnd.icon" href="favicon.ico">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="wrapper">
    <form action="INGRESO.php" class="formulario__login" method=post>
      <img src="logob.png" alt="Girl in a jacket" width="300" height="80">
      <br>
      <h2>Iniciar Sesión</h2>
      <div class="input-field">
      <input type="text" NAME="login" class="form-control" placeholder="Usuario" required="" />
        <!--<input type="text" required>
        <label>Usuario</label>-->
      </div>
      <div class="input-field">
      <input type="password" NAME=password class="form-control" placeholder="Password" required="" />
        <!--<label>Password</label>-->
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Recuerdame</p>
        </label>
        <a href="#">¿Perdiste tu contraseña?</a>
      </div>
      <button type=SUBMIT href="/production/index.html">Ingresar</button>
      <div class="register">
        <p>¿No tienes una cuenta? <a href="#">&nbsp; Registrate</a></p>
      </div>
    </form>
  </div>
</body>

</html>