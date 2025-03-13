<?php
include('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register <php>Productos</php></title>
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
        height: 110dvh;
      "
    >
    <?php
     $server = $_SERVER['PHP_SELF'];
  
      $options = "";
      $categories = "";
      
      getAllProveedores($conn);
      getAllCategories($conn);

      $id = $_GET['di'];
    

      function getAllProveedores($conn){
        global $options;
        $sql = "SELECT nombre_empresa FROM proveedores WHERE estado='Activo';";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)){
          $proveedor = $row["nombre_empresa"];
          $options .= "<option value=\"$proveedor\">$proveedor</option>";
        }
      }

      function getAllCategories($conn){
        global $categories;
        $sql = "SELECT nombre_categoria FROM categorias;";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)){
          $categorie = $row["nombre_categoria"];
          $categories .= "<option value=\"$categorie\">$categorie</option>";
        }
      }

      function formCategorias($server, $id, $conn){
        $sql = "SELECT * FROM categorias WHERE ID=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $descripcion = $row["nombre_categoria"];
        echo <<<EOD
        <form action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST">
          <h2>Registra una Categoria</h2>

          <input type="hidden" name="createData" value="1">
          <input type="hidden" name="createTable" value="categorias">
          <input type="hidden" name="id" value="$id">
          <hr class="w-100 mt-4" color="black" size="7px" />
          <br />
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="desc" class="form-label">Nombre de la Categoria:</label>
                <input
                  type="text"
                  class="form-control"
                  name="desc"
                  rows="3"
                  id="desc"
                  style="background-color: #151c26; border: none; color: white"
                  value="$descripcion"
                  required
                />
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Registrar</button>
        </form>
        EOD;
      }

      function formContacto($server, $options, $id, $conn){
        $sql = "SELECT contactos.ID, proveedores.nombre_empresa, contactos.Nombre_Contacto, contactos.Telefono_Contacto, contactos.Correo_Contacto FROM contactos JOIN proveedores ON contactos.ID = proveedores.ID WHERE concactos.ID=$id";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $nombre_proveedor = $row["nombre_empresa"];
        $nombre_contacto = $row["Nombre_Contacto"];
        $telefono = $row["Telefono_Contacto"];
        $correo = $row["Correo_Contacto"];
        
        echo <<<EOD
        <form action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST">
          <h2>Registra un Contacto</h2>
          <input type="hidden" name="createData" value="1">
          <input type="hidden" name="createTable" value="contactos">
          <input type="hidden" name="id" value="$id">

          <hr class="w-100 mt-4" color="black" size="7px" />
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
                  <option value="$nombre_proveedor">$nombre_proveedor</option>
                  $options
                </select>
              </div>
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Contacto:</label>
                <input
                  type="text"
                  class="form-control"
                  name="nombre"
                  rows="3"
                  id="nombre"
                  style="background-color: #151c26; border: none; color: white"
                  value="$nombre_contacto"
                  required
                />
              </div>

              <div class="mb-3">
                <label for="telefono_contacto" class="form-label">Telefono del Contacto:</label>
                <input
                  type="text"
                  class="form-control"
                  name="telefono_contacto"
                  rows="3"
                  id="telefono_contacto"
                  style="background-color: #151c26; border: none; color: white"
                  value="$telefono"
                  required
                />
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Correo del Contacto:</label>
                <input
                  type="email"
                  class="form-control"
                  name="correo"
                  rows="3"
                  id="correo"
                  style="background-color: #151c26; border: none; color: white"
                  value="$correo"
                  required
                />
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Registrar</button>
        </form>
        EOD;
      }
    
      function formCondicionPago($server, $id, $conn){
        $sql = "SELECT * FROM condiciones_pago WHERE ID=$id";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $desc = $row["Descripcion"];
        
        echo <<<EOD
        <form action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST">
          <h2>Registra una Condicion de Pago</h2>
          
          <input type="hidden" name="createData" value="1">
          <input type="hidden" name="createTable" value="condiciones_pago">
          <input type="hidden" name="id" value="$id">

          <hr class="w-100 mt-4" color="black" size="7px" />
          <br />
          <div class="row">
            <div class="col">
              <label for="" class="form-label">Describa la Condicion:</label>
              <textarea
                class="form-control"
                name="desc"
                rows="3"
                id="desc"
                style="background-color: #151c26; border: none; color: white"
                value="$desc"
                required
              ></textarea>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Registrar</button>
        </form>
        EOD;
      }


      function formProducto($server,$proveedores, $categorias, $id, $conn){
        $sql = "SELECT productos.ID, proveedores.Nombre_Empresa, categorias.Nombre_Categoria, productos.Nombre_Producto, productos.Descripcion_Producto, productos.Codigo_Barra_O_SKU, productos.Precio_Unitario_Venta, productos.Costo_Unitario_Adquisicion, productos.Stock_Actual, productos.Stock_Minimo, productos.Unidad_De_Medida FROM productos JOIN proveedores ON productos.ID_Proveedor = proveedores.ID JOIN categorias ON productos.ID_Categoria = categorias.ID WHERE productos.ID=$id";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $nombre_proveedor = $row["Nombre_Empresa"];
        $nombre_categoria = $row["Nombre_Categoria"];
        $Nombre_Producto = $row["Nombre_Producto"];
        $descripcion = $row["Descripcion_Producto"];
        $codigo = $row["Codigo_Barra_O_SKU"];
        $precio = $row["Precio_Unitario_Venta"];
        $costo = $row["Costo_Unitario_Adquisicion"];
        $stock_a = $row["Stock_Actual"];
        $stock_m = $row["Stock_Minimo"];
        $unidad = $row["Unidad_De_Medida"];
        
        echo <<<EOD
        <form action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST">
          <h2>Registra un Producto</h2>
          
          <input type="hidden" name="createData" value="1">
          <input type="hidden" name="createTable" value="productos">
          <input type="hidden" name="id" value="$id">


          <hr class="w-100 mt-4" color="black" size="7px" />
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
                  <option value="$nombre_proveedor">$nombre_proveedor</option>
                  $proveedores
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
                >$descripcion</textarea>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Codigo SKU:</label>
                <input
                  type="text"
                  class="form-control"
                  name="codigo"
                  id="codigo"
                  style="background-color: #151c26; border: none; color: white"
                  value="$codigo"
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
                  value="$costo"
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
                  value="$unidad"
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
                  value="$Nombre_Producto"
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
                  <option value="$nombre_categoria">$nombre_categoria</option>
                  $categorias
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
                  value="$precio"
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
                  value="$stock_a"
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
                  value="$stock_m"
                  style="background-color: #151c26; border: none; color: white"
                  required
                />
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Registrar</button>
        </form>
        EOD;
      }

      function formArticulos($server, $proveedores, $categorias, $id, $conn){
        $sql = "SELECT articulos_ofrecidos.ID, proveedores.Nombre_Empresa, categorias.Nombre_Categoria FROM articulos_ofrecidos WHERE articulos_ofrecidos.ID=$id";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $proveedor = $row["Nombre_Empresa"];
        $nombre_categoria = $row["Nombre_Categoria"];

        echo <<<EOD
        <form action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST">
          <h2>Registra un Contacto</h2>
          <input type="hidden" name="createData" value="1">
          <input type="hidden" name="createTable" value="articulos_ofrecidos">
          <input type="hidden" name="id" value="$id">

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
                  <option value="$proveedor">$proveedor</option>
                  $proveedores
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
                  <option value"$nombre_categoria">$nombre_categoria</option
                  $categorias
                </select>
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Registrar</button>
        </form>
        EOD;
      }

      function formProveedor($server, $id, $conn){
        $sql = "SELECT * FROM proveedores WHERE ID=$id";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $nombre_empresa = $row["Nombre_empresa"];
        $direccion = $row["direccion"];
        $tiempo = $row["tiempo_entrega_promedio"];
        $estado = $row["estado"];

        echo <<<EOD
        <form action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST">
          <h2>Registra un Proveedor</h2>
          
          <input type="hidden" name="createData" value="1">
          <input type="hidden" name="createTable" value="proveedores">
          <input type="hidden" name="id" value="$id">

          <hr class="w-100 mt-4" color="black" size="7px" />
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
                  value="$nombre_empresa"
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
                  value="$direccion"
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
                <select name="estado" class="form-control" style="background-color: #151c26; border: none; color: white">
                  <option value"$estado">$estado</option>
                  <option value="Activo">Activo</option>
                  <option value="Activo">Inactivo</option>
                </select>
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Registrar</button>
        </form>
        EOD;
      }
      

      function actualizarProducto($conn, $id){
        if(!$id){
          echo "NULL ID given"; 
          return;
        }

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
        

        if ($id_p && $id_c && $id){
            $sql = "UPDATE productos SET ID_Proveedor=$id_p, ID_Categoria=$id_c, Nombre_Producto = '$nombre_producto',Descripcion_Producto = '$descripcion', Codigo_Barra_O_SKU = '$codigo',Precio_Unitario_Venta = $precio_u, Costo_Unitario_Adquisicion = $costo_a, Stock_Actual = $stock_a, Stock_Minimo = $stock_m, Unidad_De_Medida='$unidad_medida' WHERE ID = $id;";

            $result = mysqli_query($conn, $sql);
            header("Location: ../Principal/home.html");
        }else{
            echo "No se pudo actualizar el producto, Se necesita Categoria y Proveedor";
        }
      }
      function actualizarProveedor($conn, $id){
        $nombre_empresa = isset($_POST["nombre_empresa"]) ? htmlspecialchars($_POST["nombre_empresa"]) : null;
        $direccion = isset($_POST["direccion"]) ? htmlspecialchars($_POST["direccion"]) : null;
        $tiempo_entrega = isset($_POST["tiempo_entrega"]) ? htmlspecialchars($_POST["tiempo_entrega"]) : null;
        
        $today = date("Y-m-d");
        $today_obj = new DateTime($today);
        $tiempo_entrega_date = new DateTime($tiempo_entrega);
        $tiempo_entrega_avg = $tiempo_entrega_date->diff($today_obj);
        $avg = $tiempo_entrega_avg->days;

        $sql = "UPDATE Proveedores (Nombre_Empresa, Direccion, Tiempo_Entrega_Promedio, Estado) VALUES ('$nombre_empresa', '$direccion', $avg, 'Activo') WHERE ID=$id";
        $result = mysqli_query($conn, $sql);
        header("Location: ../Principal/home.html");
        
      }
      function actualizarContactos($conn, $id){
        $proveedor = isset($_POST["proveedor"]) ? htmlspecialchars($_POST["proveedor"]) : null;
        $nombre_contacto = isset($_POST["nombre"]) ? htmlspecialchars($_POST["nombre"]) : null;
        $telefono = isset($_POST["telefono_contacto"]) ? htmlspecialchars($_POST["telefono_contacto"]) : null;
        $correo = isset($_POST["correo"]) ? htmlspecialchars($_POST["correo"]) : null;

        $sql = "SELECT ID FROM proveedores WHERE nombre_empresa='$proveedor';";
        $result = mysqli_query($conn, $sql);
        if ($result) $id_p = (int)mysqli_fetch_assoc($result);

        $sql = "UPDATE Proveedores_Contactos (ID_Proveedor, Nombre_Contacto, Telefono_Contacto, Correo_Contacto) VALUES ($id_p, '$nombre_contacto', '$telefono', '$correo') WHERE ID=$id";
        
        $result = mysqli_query($conn, $sql);
            header("Location: ../Principal/home.html");
        
      }
      function actualizarCondicionPago($conn, $id){
        $descripcion = isset($_POST["desc"]) ? htmlspecialchars($_POST["desc"]) : null;
        $sql = "UPDATE condiciones_pago(descripcion) VALUES ('$descripcion') WHERE ID=$id";
        $result = mysqli_query($conn, $sql);
            header("Location: ../Principal/home.html");
        
      }
      function actualizarCategoria($conn, $id){
        $descripcion = isset($_POST["desc"]) ? htmlspecialchars($_POST["desc"]) : null;
        $sql = "UPDATE categorias(descripcion) VALUES ('$descripcion') WHERE ID=$id";
        $result = mysqli_query($conn, $sql);
            header("Location: ../Principal/home.html");
        
      }
      function actualizarArticulo($conn, $id){
        $proveedor = isset($_POST["proveedor"]) ? htmlspecialchars($_POST["proveedor"]) : null;
        $nombre_producto = isset($_POST["nombre_producto"]) ? htmlspecialchars($_POST["nombre_producto"]) : null;
        
        $sql = "SELECT ID FROM proveedores WHERE nombre_empresa='$proveedor';";
        $result = mysqli_query($conn, $sql);
        $id_p = (int)mysqli_fetch_assoc($result);

        $sql = "SELECT ID FROM productos WHERE nombre_producto='$nombre_producto';";
        $result = mysqli_query($conn, $sql);
        $id_pr = (int)mysqli_fetch_assoc($result);
        
        if ($id_p && $id_pr){
            $sql = "UPDATE articulos_ofrecidos(ID_Proveedor, ID_Producto) VALUES($id_p, $id_pr) WHERE ID=$id";
            $result = mysqli_query($conn, $sql);
            header("Location: ../Principal/home.html");
            
        }

      }

       if (isset($_GET["table"])) {
          switch (strtolower($_GET["table"])){
            case "proveedores":
              formProveedor($server, $id, $conn);
              break;
            case "contactos":
              formContacto($server, $options, $id, $conn);
              break;
            case "condiciones_pago":
              formCondicionPago($server, $id, $conn);
              break;
            case "productos":
              formProducto($server, $options, $categories, $id, $conn);
              break;
            case "categorias":
              formCategorias($server, $id, $conn);
              break;
            case "articulos_ofrecidos":
              formArticulos($server, $options, $categories, $id, $conn);
              break;
            default:
              echo "<div class=\"alert alert-danger\">ERROR OCURRIDO: No se econtraron datos suficientes</div>";
              break;
          }
        }

        if (isset($_POST["createData"])){
            switch($_POST["createTable"]) {
                case "proveedores":
                    actualizarProveedor($conn, $_POST["id"]);
                    break;
                case "contactos":
                    actualizarContactos($conn, $_POST["id"]);
                    break;
                case "condiciones_pago":
                    actualizarCondicionPago($conn, $_POST["id"]);
                    break;
                case "productos":
                    actualizarProducto($conn, $_POST["id"]);
                    break;
                case "categorias":
                    actualizarCategoria($conn, $_POST["id"]);
                    break;
                case "articulos_ofrecidos":
                    actualizarArticulo($conn, $_POST["id"]);
                    break;
                default:
                    echo "<div class=\"alert alert-danger\">ERROR OCURRIDO: No se econtraron datos suficientes</div>";
                    break;
            }
        }
    ?>
  
  </div>
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
