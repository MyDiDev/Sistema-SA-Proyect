<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<>
    <div class="container-fluid">
       <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST">
          <h2>Registra un Contacto</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <input type="hidden" name="createTable" value="contactos">
          <br />
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="" class="form-label">Proveedor:</label>
                <select
                  class="form-control"
                  name="proveedor"
                  rows="3"
                  id="proveedor"
                  style="background-color: #151c26; border: none; color: white"
                  required
                >
                  <?php 
                    $sql = "SELECT nombre_empresa FROM proveedores;";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)){
                      $proveedor = $row["nombre_empresa"];
                      echo "<option value=\"$proveedor\">$proveedor</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="mb-3">
               <label for="categoria" class="form-label">Categoria:</label>
                <select
                  class="form-control"
                  name="categoria"
                  rows="3"
                  id="categoria"
                  style="background-color: #151c26; border: none; color: white"
                  required
                >
                  <?php 
                    $sql = "SELECT nombre_categoria FROM categorias;";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)){
                      $categorie = $row["nombre_categoria"];
                      echo "<option value=\"$categorie\">$categorie</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Registrar</button>
        </form>
    </div>
    <?php 
      if($_SERVER['REQUEST_METHOD'] == "POST"){
        $proveedor = isset($_POST["proveedor"]) ? htmlspecialchars($_POST["proveedor"]) : null;
        $nombre_producto = isset($_POST["nombre_producto"]) ? htmlspecialchars($_POST["nombre_producto"]) : null;
        
        $sql = "SELECT ID FROM proveedores WHERE nombre_empresa='$proveedor';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id_p = $row["ID"];

        $sql = "SELECT ID FROM productos WHERE nombre_producto='$nombre_producto';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id_pr = $row["ID"];
        
        if ($id_p && $id_pr){
          $sql = "INSERT INTO articulos_ofrecidos(ID_Proveedor, ID_Producto) VALUES($id_p, $id_pr);";
          $result = mysqli_query($conn, $sql);
          header("Location: listados.php");
        }
      }
    ?>
</body>
</html>