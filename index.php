<?php

 

  require "conexion.php";

  session_start();

  $resp = "";

  if(!empty($_SESSION['active']))
  {
    header("Location: index.php"); 
  }
  else{
    if(isset($_POST['btn-login']))
    {

      $usuario = $_POST['usuario'];
      $password = $_POST['password'];

      $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND pass = '$password'";

      $resultado = mysqli_query($connection,$sql);
      $num = $resultado->num_rows;

      if ($num > 0) 
      {
        
        $row = mysqli_fetch_array($resultado);
        $password_bd = $row['pass'];

        //echo print_r($row);
        
        $_SESSION['active'] = true;
        $_SESSION['id_usuario'] = $row['id_usuario'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['id_rol'] = $row['id_rol'];
        header("Location: front/financiacion.php");
        
      }
      else
      {
        $resp = "<strong style='font-size: 15px;'> No existe el usuario </strong>";
      }

    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>WebCost - Login</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
  </script>
</head>

<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4"><strong>Acceso al sistema</strong></h3>
                </div>
                <div class="card-body">
                  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                    <div class="form-group">
                      <label class="small mb-1" for="inputEmailAddress">Usuario</label>
                      <input class="form-control py-4" id="inputEmailAddress" type="text" name="usuario"
                        placeholder="usuario" />
                    </div>

                    <div class="form-group">
                      <label class="small mb-1" for="inputPassword">Contraseña</label>
                      <input class="form-control py-4" id="inputPassword" type="password" name="password"
                        placeholder="********" />
                    </div> 
                    
                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                      <!-- <a class="small" href="password.html">Forgot Password?</a> -->
                      <button class="btn btn-primary" name="btn-login" type="submit">Acceder</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center" style="height: 40px;"> <!-- class="card-footer text-center" -->
                  <div class="small"><?php echo $resp ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <div id="layoutAuthentication_footer">
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website <?php   echo date('Y'); ?></div>
            <div>
             <!--  <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a> -->
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
  <script src="js/scripts.js"></script>
</body>

</html>