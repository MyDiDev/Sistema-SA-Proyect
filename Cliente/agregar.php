<?php
include("../Datos/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
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
         <form action="<?php  echo $_SERVER['PHP_SELF'] ?>" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST">
          <h2>Registra un Producto</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <input type="hidden" name="createTable" value="productos">
          <br />
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="proveedor" class="form-label">Proveedor:</label>
                <select
                  class="form-control"
                  name="proveedor"
                  id="provider"
                  style="background-color: #151c26; border: none; color: white"
                  required
                >
                  <?php 
                    $sql = "SELECT nombre_empresa FROM proveedores WHERE estado='Activo';";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)){
                      $proveedor = $row["nombre_empresa"];
                      echo "<option value=\"$proveedor\">$proveedor</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="desc" class="form-label">Descripcion:</label>
                <textarea
                  class="form-control"
                  name="desc"
                  id="desc"
                  style="background-color: #151c26; border: none; color: white"
                  required
                ></textarea>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Codigo SKU:</label>
                <input
                  type="text"
                  class="form-control"
                  name="codigo"
                  id="codigo"
                  style="background-color: #151c26; border: none; color: white"
                  required
                >
              </div>
              <div class="mb-3">
                <label for="costo_a" class="form-label"
                  >Costo de Adquisicion:</label
                >
                <input
                  type="number"
                  class="form-control"
                  name="costo_a"
                  id="costo_a"
                  style="background-color: #151c26; border: none; color: white"
                  required
                >
              </div>
              <div class="mb-3">
                <label for="unidad_medida" class="form-label"
                  >Unidad de Medida:</label
                >
                <input
                  type="text"
                  class="form-control"
                  name="unidad_medida"
                  id="unidad_medida"
                  style="background-color: #151c26; border: none; color: white"
                  required
                />
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="nombre" class="form-label"
                  >Nombre del Producto:</label
                >
                <input
                  type="text"
                  class="form-control"
                  name="nombre"
                  id="nombre"
                  style="background-color: #151c26; border: none; color: white"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="categoria" class="form-label">Categoria:</label>
                <select
                  class="form-control"
                  name="categoria"
                  id="categoria"
                  style="background-color: #151c26; border: none; color: white"
                  required
                >
                  <?php 
                    $sql = "SELECT nombre_categoria FROM categorias;";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)){
                      $categoria = $row["nombre_categoria"];
                      echo "<option value=\"$categoria\">$categoria</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="precio_u" class="form-label">Precio Unitario:</label>
                <input
                  type="number"
                  class="form-control"
                  name="precio_u"
                  id="precio_u"
                  style="background-color: #151c26; border: none; color: white"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="stock_a" class="form-label">Stock Actual</label>
                <input
                  type="number"
                  class="form-control"
                  name="stock_a"
                  id="stock_a"
                  style="background-color: #151c26; border: none; color: white"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="stock_m" class="form-label">Stock Minimo</label>
                <input
                  type="number"
                  class="form-control"
                  name="stock_m"
                  id="stock_m"
                  style="background-color: #151c26; border: none; color: white"
                  required
                />
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Registrar</button>
        </form>
    </div>
    <?php 
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
           $proveedor = isset($_POST["proveedor"]) ? htmlspecialchars($_POST["proveedor"]) : null;
          $categoria = isset($_POST["categoria"]) ? htmlspecialchars($_POST["categoria"]) : null;
          $nombre_producto = isset($_POST["nombre"]) ? htmlspecialchars($_POST["nombre"]) : null;
          $descripcion = isset($_POST["desc"]) ? htmlspecialchars($_POST["desc"]) : null;
          $codigo = isset($_POST["codigo"]) ? htmlspecialchars($_POST["codigo"]) : null;
          $precio_u = isset($_POST["precio_u"]) ? htmlspecialchars($_POST["precio_u"]) : null;
          $costo_a =  isset($_POST["costo_a"]) ? htmlspecialchars($_POST["costo_a"]) : null;
          $stock_a =  isset($_POST["stock_a"]) ? htmlspecialchars($_POST["stock_a"]) : null;
          $stock_m =  isset($_POST["stock_m"]) ? htmlspecialchars($_POST["stock_m"]) : null;
          $unidad_medida =  isset($_POST["unidad_medida"]) ? htmlspecialchars($_POST["unidad_medida"]) : null;
          

          $sql = "SELECT ID FROM proveedores WHERE nombre_empresa='$proveedor';";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $id_p = $row["ID"];

          $sql = "SELECT ID FROM categorias WHERE nombre_categoria='$categoria';";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $id_c = $row["ID"];
          
          if ($id_p && $id_c){
            $sql = "INSERT INTO productos(ID_Proveedor, ID_Categoria, Nombre_Producto, Descripcion_Producto, Codigo_Barra_O_SKU, Precio_Unitario_Venta, Costo_Unitario_Adquisicion, Stock_Actual, Stock_Minimo, Unidad_De_Medida)  VALUES ($id_p, $id_c, '$nombre_producto', '$descripcion', '$codigo', $precio_u, $costo_a, $stock_a, $stock_m, '$unidad_medida')";

            $result = mysqli_query($conn, $sql);
            header("Location: listados.php");
          }else{
            echo "No se pudo agregar el producto, Se necesita Categoria y Proveedor";
          }
        }
    ?>
</body>
</html>