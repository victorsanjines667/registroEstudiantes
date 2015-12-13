<?php
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Certificaciones D.L.E.G.S.S.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="recursos/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="recursos/css/bootstrapValidator.min.css">
    <script type="text/javascript" src="recursos/js/jquery-1.11.2.min.js"></script>
     <script src="recursos/js/bootstrap.min.js"></script>
     <script type="text/javascript" src="recursos/js/inicio.js"></script>
    <script type="text/javascript" src="recursos/js/bootstrapValidator.min.js"></script>
    <script type="text/javascript" src="recursos/js/es_ES.js"></script>
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
                color: #0182ba;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
     </style>
  </head>

  <body>

 <div class="container">

     <form id="frm-login" class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" target="_self">
         <h4 class="form-signin-heading" style="text-align: center;">Certificaciones - Fondos</h4>
         <h5 class="form-signin-heading">Por favor identifíquese</h5>
        
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                <input name="nombreusuario" type="text" class="form-control" placeholder="Usuario">
                </div>
            </div>
        </div>
        <div class="form-group">
            <input name="password" type="password" class="form-control" placeholder="Contraseña">
        </div>
        <button id="btnLoguear" class="btn btn-primary" type="submit">Ingresar</button>
    </form>

    </div> <!-- /container -->


    <script>
        $(document).ready(function(){
            login();
        });
    </script>
  </body>
</html>
