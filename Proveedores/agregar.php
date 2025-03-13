<?php 
include("../Datos/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proveedor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../Estilos/style.css" />
</head>
<>
    <div class="container-fluid">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST">
          <h2>Registra un Proveedor</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <input type="hidden" name="createTable" value="proveedores">
          <br />
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="" class="form-label">Nombre de la Empresa:</label>
                <input
                  type="text"
                  class="form-control"
                  name="nombre_empresa"
                  id="provider"
                  style="background-color: #151c26; border: none; color: white"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="desc" class="form-label">Direccion:</label>
                <input
                  type="text"
                  class="form-control"
                  name="direccion"
                  id="desc"
                  style="background-color: #151c26; border: none; color: white"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Fecha de Entrega:</label>
                <input
                  type="date"
                  class="form-control"
                  name="tiempo_entrega"
                  id="tiempo_entrega"
                  style="background-color: #151c26; border: none; color: white"
                  required
                />
              </div>
              <div class="mb-3">
                <input type="hidden" name="estado" value="Activo" />
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Registrar</button>
        </form>
    </div>
    <?php 
      if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nombre_empresa = isset($_POST["nombre_empresa"]) ? htmlspecialchars($_POST["nombre_empresa"]) : null;
        $direccion = isset($_POST["direccion"]) ? htmlspecialchars($_POST["direccion"]) : null;
        $tiempo_entrega = isset($_POST["tiempo_entrega"]) ? htmlspecialchars($_POST["tiempo_entrega"]) : null;
        
        $today = date("Y-m-d");
        $today_obj = new DateTime($today);
        $tiempo_entrega_date = new DateTime($tiempo_entrega);
        $tiempo_entrega_avg = $tiempo_entrega_date->diff($today_obj);
        $avg = $tiempo_entrega_avg->days;

        $sql = "INSERT INTO Proveedores (Nombre_Empresa, Direccion, Tiempo_Entrega_Promedio, Estado) VALUES ('$nombre_empresa', '$direccion', $avg, 'Activo');";
        $result = mysqli_query($conn, $sql);
        header("Location: listados.php");
      }
    ?>
</body>
</html>