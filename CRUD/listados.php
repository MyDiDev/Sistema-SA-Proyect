<?php 
include('../Datos/conn.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema SA - Listados</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../Estilos/style.css" />

  </head>
  <body>
    <div
      class="container-fluid"
      style="
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        height: 100dvh;
      "
    >
     <h2>Listado de <?php echo str_replace("_", " ", ucwords($_POST["table"])) ?></h2>
     <br>
    <?php 
        function showProductoTable($conn){
            $sql = "SELECT productos.ID, proveedores.Nombre_Empresa, categorias.Nombre_Categoria, productos.Nombre_Producto, productos.Descripcion_Producto, productos.Codigo_Barra_O_SKU,  productos.Precio_Unitario_Venta, productos.Costo_Unitario_Adquisicion, productos.Stock_Actual, productos.Stock_Minimo,  productos.Unidad_De_Medida FROM productos JOIN proveedores ON productos.ID_Proveedor = proveedores.ID JOIN categorias ON productos.ID_Categoria = categorias.ID;";
            
            $result = mysqli_query($conn, $sql);
            echo "
            <table class=\"table table-striped table-hover\">
              <thead>
                <th>N.</th>
                <th>PROVEEDOR</th>
                <th>CATEGORIA</th>
                <th>PRODUCTO</th>
                <th>DESCRIPCION</th>
                <th>CODIGO SKU</th>
                <th>PRECIO UNITARIO</th>
                <th>COSTO UNITARIO</th>
                <th>STOCK ACTUAL</th>
                <th>STOCK MINIMO</th>
                <th>UNIDAD DE MEDIDA</th>

                <th></th>
                <th></th>
              </thead>
              <tbody>
            ";
            while ($row = mysqli_fetch_assoc($result)){
              $id = $row["ID"];
              $proveedor = $row["Nombre_Empresa"];
              $categoria = $row["Nombre_Categoria"];
              $producto = $row["Nombre_Producto"];
              $desc = $row["Descripcion_Producto"];
              $codigo = $row["Codigo_Barra_O_SKU"];
              $precio = $row["Precio_Unitario_Venta"];
              $costo = $row["Costo_Unitario_Adquisicion"];
              $stock_a = $row["Stock_Actual"];
              $stock_m = $row["Stock_Minimo"];
              $unidad = $row["Unidad_De_Medida"];
              echo"
                  <tr>
                    <td>$id</td>
                    <td>$proveedor</td>
                    <td>$categoria</td>
                    <td>$producto</td>
                    <td>$desc</td>
                    <td>$codigo</td>
                    <td>$precio</td>
                    <td>$costo</td>
                    <td>$stock_a</td>
                    <td>$stock_m</td>
                    <td>$unidad</td>

                    <td><a href=\"../CRUD/delete.php?id=$id&table=productos&id_col=ID\">Eliminar</a></td>
                    <td><a href=\"../CRUD/update.php?di=$id&table=productos\">Editar</a></td>
                  </tr>
              ";
            }
            echo "
              </tbody>
            </table>
            ";
        }   
        
        function showCategoriasTable($conn){
            $sql = "SELECT * FROM categorias";
            $result = mysqli_query($conn, $sql);

            echo "
              <table class=\"table table-striped table-hover\">
                <thead>
                  <th>N.</th>
                  <th>PROVEEDOR</th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
            ";

            while ($row = mysqli_fetch_assoc($result)){
                $id = $row["ID"];
                $categoria = $row["nombre_categoria"];

                echo"
                    <tr>
                      <td>$id</td>
                      <td>$categoria</td>    
                      <td><a href=\"../CRUD/delete.php?id=$id&table=categorias&id_col=ID\">Eliminar</a></td>
                      <td><a href=\"../CRUD/update.php?di=$id&table=categorias\">Editar</a></td>
                    </tr>
                ";
            }

            echo "
              </tbody>
            </table>
            ";
        }

        function showCondicionesPagoTable($conn){
            $sql = "SELECT * FROM condiciones_pago";
            $result = mysqli_query($conn, $sql);

            echo "
              <table class=\"table table-striped table-hover\">
                <thead>
                  <th>N.</th>
                  <th>DESCRIPCION</th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
            ";

            while ($row = mysqli_fetch_assoc($result)){
                $id = $row["ID"];
                $descripcion = $row["Descripcion"];

                echo"
                    <tr>
                      <td>$id</td>
                      <td>$descripcion</td>
                      <td><a href=\"../CRUD/delete.php?id=$id&table=condiciones_pago&id_col=ID\">Eliminar</a></td>
                      <td><a href=\"../CRUD/update.php?di=$id&table=condiciones_pago\">Editar</a></td>
                    </tr>
                ";
            }

            echo "
              </tbody>
            </table>
            ";
        }

        function showArticulosTable($conn){
            $sql = "SELECT * FROM articulos_ofrecidos";
            $result = mysqli_query($conn, $sql);

            echo "
              <table class=\"table table-striped table-hover\">
                <thead>
                  <th>N.</th>
                  <th>PROVEEDOR</th>
                  <th>PRODUCTO</th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
            ";

            while ($row = mysqli_fetch_assoc($result)){
                $id = $row["ID"];
                $proveedor = $row["ID_Proveedor"];
                $producto = $row["ID_Producto"];

                echo"
                    <tr>
                      <td>$id</td>
                      <td>$proveedor</td>
                      <td>$producto</td>
                      <td><a href=\"../CRUD/delete.php?id=$id&table=articulos_ofrecidos&id_col=ID\">Eliminar</a></td>
                      <td><a href=\"../CRUD/update.php?di=$id&table=articulos_ofrecidos\">Editar</a></td>
                    </tr>
                ";
            }

            echo "
              </tbody>
            </table>
            ";
        }

        function showContactosTable($conn){
            $sql = "SELECT * FROM contactos";
            $result = mysqli_query($conn, $sql);

            echo "
              <table class=\"table table-striped table-hover\">
                <thead>
                  <th>N.</th>
                  <th>PROVEEDOR</th>
                  <th>CONTACTO</th>
                  <th>TELEFONO</th>
                  <th>CORREO</th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
            ";

            while ($row = mysqli_fetch_assoc($result)){
                $id = $row["ID"];
                $proveedor = $row["ID_Proveedor"];
                $contacto = $row["Nombre_Contacto"];
                $telefono = $row["Telefono_Contacto"];
                $correo = $row["Correo_Contacto"];

                echo"
                    <tr>
                      <td>$id</td>
                      <td>$proveedor</td>
                      <td>$contacto</td>
                      <td>$telefono</td>
                      <td>$correo</td>
                      <td><a href=\"../CRUD/delete.php?id=$id&table=contactos&id_col=ID\">Eliminar</a></td>
                      <td><a href=\"../CRUD/update.php?di=$id&table=contactos\">Editar</a></td>
                    </tr>
                ";
            }

            echo "
              </tbody>
            </table>
            ";
        }


        function showProveedoresTable($conn){
          $sql = "SELECT * FROM proveedores";
          $result = mysqli_query($conn, $sql);

          echo "
            <table class=\"table table-striped table-hover\">
              <thead>
                <th>N.</th>
                <th>PROVEEDOR</th>
                <th>DIRECCION</th>
                <th>TIEMPO ENTREGA PROMEDIO</th>
                <th>ESTADO</th>
                <th></th>
                <th></th>
              </thead>
              <tbody>
          ";

          while ($row = mysqli_fetch_assoc($result)){
              $id = $row["ID"];
              $proveedor = $row["Nombre_Empresa"];
              $direccion = $row["Direccion"];
              $tiempo_promedio = $row["Tiempo_Entrega_Promedio"];
              $estado = $row["Estado"];

              echo"
                  <tr>
                    <td>$id</td>
                    <td>$proveedor</td>
                    <td>$direccion</td>
                    <td>$proveedor</td>
                    <td>$tiempo_promedio</td>
                    <td>$estado</td>
                    <td><a href=\"../CRUD/delete.php?id=$id&table=proveedores&id_col=ID\">Eliminar</a></td>
                    <td><a href=\"../CRUD/update.php?di=$id&table=proveedores\">Editar</a></td>
                  </tr>
              ";
          }

          echo "
            </tbody>
          </table>
          ";
        } 


      if (isset($_POST["table"])){
            switch (strtolower($_POST["table"])){
                case "proveedores":
                  showProveedoresTable($conn);
                  break;
                case "contactos":
                  showContactosTable($conn);
                  break;
                case "condiciones_pago":
                  showCondicionesPagoTable($conn);
                  break;
                case "productos":
                  showProductoTable($conn);
                  break;
                case "categorias":
                  showCategoriasTable($conn);
                  break;
                case "articulos_ofrecidos":
                  showArticulosTable($conn);
                  break;
                default:
                  session_destroy();
                  echo "<div class=\"alert alert-danger\">ERROR OCURRIDO: No se econtraron Datos suficientes</div>";
                  break;
            }
        } 
      ?>
    </div>

    <!--   
    ?> -->
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>
