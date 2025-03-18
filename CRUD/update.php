<?php
include('../Datos/conn.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Actualizar <?php echo isset($_GET["table"]) ? htmlspecialchars($_GET["table"]) : "Tablas"; ?></title>
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
      $id = isset($_GET['di']) ? htmlspecialchars($_GET['di']) : null;
  
      $proveedores = "";
      $categories = "";
      $conditions = "";
      $clients = "";
      $products = "";

      function getAllCondiciones($conn){
        global $conditions;
        $sql = "SELECT descripcion FROM condiciones_pago";      
        $result = mysqli_query($conn, $sql);
        if ($result) while ($row = mysqli_fetch_assoc($result)){
          $desc = $row["descripcion"];
          $conditions .= "<option value=\"$desc\">$desc</option>";
        }
      }

      function getAllClients($conn){
        global $clients;
        $sql = "SELECT nombre_razon_social FROM clientes";      
        $result = mysqli_query($conn, $sql);
        if ($result) while ($row = mysqli_fetch_assoc($result)){
          $desc = $row["nombre_razon_social"];
          $clients .= "<option value=\"$desc\">$desc</option>";
        }
      }
      
      function getAllProducts($conn){
        global $products;
        $sql = "SELECT nombre_producto FROM productos";      
        $result = mysqli_query($conn, $sql);
        
        if ($result) while ($row = mysqli_fetch_assoc($result)){
          $product = $row["nombre_producto"];
          $products .= "<option value=\"$product\">$product</option>";
        }
      }

      getAllProveedores($conn);
      getAllCategories($conn);
      getAllCondiciones($conn);
      getAllClients($conn);
      getAllProducts($conn);

      function getAllProveedores($conn){
        global $proveedores;
        $sql = "SELECT nombre_empresa FROM proveedores WHERE estado='Activo';";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)){
          $proveedor = $row["nombre_empresa"];
          $proveedores .= "<option value=\"$proveedor\">$proveedor</option>";
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
      
      function formClientes($server, $conditions, $conn, $id){
        $sql = "SELECT * FROM clientes WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $nombre_razon = $row["nombre_razon_social"];
        $nombre_contacto = $row["nombre_contacto"];
        $telefono = $row["telefono"];
        $email = $row["correo_electronico"];
        $id_condicion_pago = $row["id_condicion_pago"];
        $sql = "SELECT descripcion FROM condiciones_pago WHERE id=$id_condicion_pago;";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $condicion = $row["descripcion"];

        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
          <h2>Actualizar un Cliente</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <input type="hidden" name="createData" value="1">
          <input type="hidden" name="createTable" value="clientes">
          <input type="hidden" name="id" value="$id">
          <br />
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Del Cliente:</label>
                <input
                  type="text"
                  class="form-control"
                  name="nombre_cliente"
                  id="nombre"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  value="$nombre_razon"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="n_contacto" class="form-label">Nombre del Contacto:</label>
                <input
                  type="text"
                  class="form-control"
                  name="nombre_contacto"
                  id="n_contacto"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  value="$nombre_contacto"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Numero de Telefono:</label>
                <input
                  type="tel"
                  class="form-control"
                  name="phone_num"
                  id="phone_num"
                  maxlength="12"
                  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                  inputmode="numeric"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  value="$telefono"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email del Cliente:</label>
                <input
                  type="email"
                  class="form-control"
                  name="email"
                  id="email"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  value="$email"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="condition" class="form-label">Condicion De Pago:</label>
                <select
                  class="form-control"
                  name="condition"
                  rows="3"
                  id="condition"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  required
                >
                  <option value="$condicion">$condicion</option>
                  $conditions
                </select>
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Actualizar</button>
        </form>
        EOD;
      }

      function formArticulosComprados($server, $conn, $producto, $clients, $id){
        $sql = "SELECT articulos_comprados.id_historial, historial_compras.id_cliente, productos.nombre_producto, articulos_comprados.costo_unitario, articulos_comprados.costo_total, articulos_comprados.cantidad FROM articulos_comprados JOIN historial_compras ON historial_compras.id = articulos_comprados.id_historial JOIN productos ON productos.ID = articulos_comprados.id_producto WHERE articulos_comprados.id=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $client_id = $row["id_cliente"];
        $history_id = $row["id_historial"];
        $product = $row["nombre_producto"];
        $costo_u = $row["costo_unitario"];
        $cantidad = $row["cantidad"];

        $sql = "SELECT nombre_razon_social FROM clientes WHERE id=$client_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $client = $row["nombre_razon_social"];


        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
          <h2>Actualizar un Articulo Comprado</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <input type="hidden" name="createData" value="1">
          <input type="hidden" name="createTable" value="articulos_comprados">
          <input type="hidden" name="id" value="$id">
          <br />
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="client" class="form-label">Cliente:</label>
                <select
                  class="form-control"
                  name="client"
                  rows="3"
                  id="client"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  required
                >
                  <option value"$client">$client</option>
                  $clients
                </select>
              </div>
              <div class="mb-3">
                <label for="producto" class="form-label">Producto:</label>
                <select
                  class="form-control"
                  name="producto"
                  rows="3"
                  id="producto"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  required
                >
                  <option value="$product">$product</option>
                  $producto
                </select>
                <input type="hidden" value="null">
              </div>
              <div class="mb-3">
                <label for="quantity" class="form-label">Cantidad:</label>
                <input
                  type="number"
                  class="form-control"
                  name="quantity"
                  id="quantity"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  value="$cantidad"
                  required  
                />
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Actualizar</button>
        </form>
        EOD;
      }

      function formDirecciones($server, $clients, $id, $conn){
        $sql = "SELECT clientes.nombre_razon_social, direcciones.Tipo_Direccion, direcciones.direccion FROM direcciones JOIN clientes ON direcciones.id_cliente = clientes.id WHERE direcciones.id=$id";
        $result = mysqli_query($conn, $sql);
        if ($result) $row = mysqli_fetch_assoc($result);
        $client = $row["nombre_razon_social"];
        $direct_type = $row["Tipo_Direccion"];
        $direccion = $row["direccion"];

        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
          <h2>Actualizar una Direccion</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <input type="hidden" name="createData" value="1">
          <input type="hidden" name="createTable" value="direcciones">
          <input type="hidden" name="id" value="$id">
          <br />
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="client" class="form-label">Cliente:</label>
                <select
                  class="form-control"
                  name="client"
                  rows="3"
                  id="client"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  required
                >
                  <option value="$client">$client</option>
                  $clients
                </select>
              </div>
              <div class="mb-3">
                <label for="tipo_direccion" class="form-label">Tipo de Direccion:</label>
                <select
                  class="form-control"
                  name="tipo_direccion"
                  rows="3"
                  id="tipo_direccion"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  required
                >
                  <option value="$direct_type">$direct_type</option>
                  <option value="Residencial">Residencial</option>
                  <option value="Comercial">Comercial</option>
                  <option value="Entrega">Entrega</option>
                  <option value="De un Punto de Referencia">De un Punto de Referencia</option>
                  <option value="Rural">Rural</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="direccion" class="form-label">Direccion:</label>
                <input
                  type="text"
                  class="form-control"
                  name="direcciones"
                  id="direccion"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  value="$direccion"
                  required  
                />
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Actualizar</button>
        </form>
        EOD;
      }

      function formHistorialCompras($server, $clients, $id, $conn){
        $sql = "SELECT clientes.nombre_razon_social, historial_compras.fecha_compra, historial_compras.monto_total, historial_compras.metodo_pago, historial_compras.estado_compra FROM historial_compras JOIN clientes ON historial_compras.id_cliente = clientes.id WHERE historial_compras.id=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $client = $row["nombre_razon_social"];
        $fecha = $row["fecha_compra"];
        $monto = $row["monto_total"];
        $metodo = $row["metodo_pago"];
        $estado = $row["estado_compra"];


        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
          <h2>Registro para el Historial de Compras</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <input type="hidden" name="createTable" value="historial_compras">
          <input type="hidden" name="createData" value="1">
          <input type="hidden" name="id" value="$id">
          <br />
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="client" class="form-label">Cliente:</label>
                <select
                  class="form-control"
                  name="client"
                  rows="3"
                  id="client"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  required
                >
                  <option value="$client">$client</option>
                  $clients
                </select>
              </div>
              <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de Compra:</label>
                <input
                  type="date"
                  class="form-control"
                  name="fecha_compra"
                  rows="3"
                  id="fecha"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  value="$fecha"
                  required
                >
              </div>
              <div class="mb-3">
                <label for="monto_total" class="form-label">Monto Total:</label>
                <input
                  type="number"
                  class="form-control"
                  name="monto_total"
                  id="monto_total"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  value="$monto"
                  required  
                />
              </div>
              <div class="mb-3">
                <label for="metodo_pago" class="form-label">Metodo de Pago:</label>
                <select
                  class="form-control"
                  name="metodo_pago"
                  id="metodo_pago"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  required  
                >
                  <option value="$metodo">$metodo</option>  
                  <option value="tarjeta">Tarjeta</option>
                  <option value="fisico">Fisico</option>
                  <option value="transaccion">Transacción</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="estado_compra" class="form-label">Estado de Compra:</label>
                <select
                  class="form-control"
                  name="estado_compra"
                  id="estado_compra"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  required  
                >
                  <option value="$estado">$estado</option>
                  <option value="realizada">Realizada</option>
                  <option value="no realizada">No Realizada</option>
                </select>
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Actualizar</button>
        </form>
        EOD;
      }

      function formCategorias($server, $id, $conn){
        $sql = "SELECT * FROM categorias WHERE ID=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $descripcion = $row["nombre_categoria"];
        echo <<<EOD
        <form action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST">
          <h2>Actualizar una Categoria</h2>

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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  value="$descripcion"
                  required
                />
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Actualizar</button>
        </form>
        EOD;
      }

      function formContacto($server, $proveedores, $id, $conn){
        $sql = "SELECT contactos.ID, proveedores.nombre_empresa, contactos.Nombre_Contacto, contactos.Telefono_Contacto, contactos.Correo_Contacto FROM contactos JOIN proveedores ON contactos.ID = proveedores.ID WHERE concactos.ID=$id";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $nombre_proveedor = $row["nombre_empresa"];
        $nombre_contacto = $row["Nombre_Contacto"];
        $telefono = $row["Telefono_Contacto"];
        $correo = $row["Correo_Contacto"];
        
        echo <<<EOD
        <form action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST">
          <h2>Actualizar un Contacto</h2>
          <input type="hidden" name="createData" value="1">
          <input type="hidden" name="createTable" value="contactos">
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  required
                >
                  <option value="$nombre_proveedor">$nombre_proveedor</option>
                  $proveedores
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  value="$correo"
                  required
                />
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Actualizar</button>
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
          <h2>Actualizar una Condicion de Pago</h2>
          
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
                style="background-color:rgb(20, 20, 20); border: none; color: white"
                value="$desc"
                required
              ></textarea>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Actualizar</button>
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
          <h2>Actualizar un Producto</h2>
          
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  required
                />
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Actualizar</button>
        </form>
        EOD;
      }

      function formArticulos($server, $proveedores, $products, $id, $conn){
        $sql = "SELECT articulos_ofrecidos.ID, proveedores.nombre_empresa, productos.nombre_producto FROM articulos_ofrecidos JOIN proveedores ON articulos_ofrecidos.ID_Proveedor=proveedores.ID JOIN productos ON articulos_ofrecidos.ID_Producto=productos.ID WHERE articulos_ofrecidos.ID=$id";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $proveedor = $row["nombre_empresa"];
        $producto = $row["nombre_producto"];

        echo <<<EOD
        <form action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST">
          <h2>Actualizar un Articulo Ofrecido</h2>
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  required
                >
                  <option value="$proveedor">$proveedor</option>
                  $proveedores
                </select>
              </div>
              <div class="mb-3">
               <label for="producto" class="form-label">Producto:</label>
                <select
                  class="form-control"
                  name="producto"
                  rows="3"
                  id="producto"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  required
                >
                  <option value"$producto">$producto</option>
                  $products
                </select>
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Actualizar</button>
        </form>
        EOD;
      }

      function formProveedor($server, $proveedores, $id, $conn){
        $sql = "SELECT * FROM proveedores WHERE ID=$id";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $nombre_empresa = $row["Nombre_Empresa"];
        $direccion = $row["Direccion"];
        $tiempo = $row["Tiempo_Entrega_Promedio"];
        $estado = $row["Estado"];

        echo <<<EOD
        <form action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST">
          <h2>Actualizar un Proveedor</h2>
          
          <input type="hidden" name="createData" value="1">
          <input type="hidden" name="createTable" value="proveedores">
          <input type="hidden" name="id" value="$id">

          <hr class="w-100 mt-4" color="black" size="7px" />
          <br />
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="nombre_empresa" class="form-label">Nombre de la Empresa:</label>
                <select
                  class="form-control"
                  name="nombre_empresa"
                  rows="3"
                  id="nombre_empresa"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  required
                >
                  <option value="$nombre_empresa">$nombre_empresa</option>
                  $proveedores
                </select>
              </div>
              <div class="mb-3">
                <label for="desc" class="form-label">Direccion:</label>
                <input
                  type="text"
                  class="form-control"
                  name="direccion"
                  id="desc"
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
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
                  style="background-color:rgb(20, 20, 20); border: none; color: white"
                  value="$tiempo"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select name="estado" id="estado" class="form-control" style="background-color:rgb(20, 20, 20); border: none; color: white">
                  <option value"$estado">$estado</option>
                  <option value="Activo">Activo</option>
                  <option value="Activo">Inactivo</option>
                </select>
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Actualizar</button>
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
        

        if ($id_p and $id_c and $id){
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

        $sql = "UPDATE Contactos SET ID_Proveedor=$id_p, Nombre_Contacto='$nombre_contacto', Telefono_Contacto='$telefono', Correo_Contacto='$correo' WHERE ID=$id";
        
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
        $nombre_producto = isset($_POST["producto"]) ? htmlspecialchars($_POST["producto"]) : null;
        
        $sql = "SELECT ID FROM proveedores WHERE nombre_empresa='$proveedor';";
        $result = mysqli_query($conn, $sql);
        $id_p = (int)mysqli_fetch_assoc($result);

        $sql = "SELECT ID FROM productos WHERE nombre_producto='$nombre_producto';";
        $result = mysqli_query($conn, $sql);
        $id_pr = (int)mysqli_fetch_assoc($result);
        
        $sql = "UPDATE articulos_ofrecidos SET ID_Proveedor=$id_p, ID_Producto=$id_pr WHERE ID=$id";
        $result = mysqli_query($conn, $sql);
        header("Location: ../Principal/home.html");
      }

      function actualizarCliente($conn, $id){
        $nombre_razon = isset($_POST["nombre_cliente"]) ? htmlspecialchars($_POST["nombre_cliente"]) : "";
        $nombre_contacto = isset($_POST["nombre_contacto"]) ? htmlspecialchars($_POST["nombre_contacto"]) : "";
        $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "";
        $telefono = isset($_POST["phone_num"]) ? htmlspecialchars($_POST["phone_num"]) : "";
        $condition = isset($_POST["condition"]) ? htmlspecialchars($_POST["condition"]) : "";

        $sql = "SELECT id FROM condiciones_pago WHERE descripcion='$condition'";
        $result = mysqli_query($conn, $sql);
        if ($result) $row =  mysqli_fetch_assoc($result);
        $id_c = $row["id"];

        $sql = "UPDATE clientes SET nombre_razon_social='$nombre_razon', nombre_contacto='$nombre_contacto', telefono='$telefono', correo_electronico='$email', id_condicion_pago=$id_c WHERE id=$id";
        $result = mysqli_query($conn, $sql);
         header("Location: ../Principal/home.html");
      }

      function actualizarDireccion($conn, $id){
        $cliente = isset($_POST["client"]) ? htmlspecialchars($_POST["client"]) : "";
        $tipo = isset($_POST["tipo_direccion"]) ? htmlspecialchars($_POST["tipo_direccion"]) : "";
        $direccion = isset($_POST["direcciones"]) ? htmlspecialchars($_POST["direcciones"]) : "";

        $sql = "SELECT id FROM clientes WHERE nombre_razon_social='$cliente';";
        $result = mysqli_query($conn, $sql);
        if ($result) $row = mysqli_fetch_assoc($result);
        $id_client = $row["id"];

        $sql = "UPDATE direcciones SET id_cliente=$id_client, tipo_direccion= '$tipo', direccion='$direccion' WHERE id=$id;";
        $result = mysqli_query($conn, $sql);
        header("Location: ../Principal/home.html");
      }

      function actualizarArticuloComprado($conn, $id){
        $cliente = isset($_POST["client"]) ? htmlspecialchars($_POST["client"]) : "";
        $producto = isset($_POST["producto"]) ? htmlspecialchars($_POST["producto"]) : "";
        $cantidad = isset($_POST["quantity"]) ? htmlspecialchars($_POST["quantity"]) : "";

        $sql = "SELECT id FROM clientes WHERE nombre_razon_social='$cliente';";
        $result = mysqli_query($conn, $sql);
        if ($result) $row = mysqli_fetch_assoc($result);
        $id_client = $row["id"];

        $sql = "SELECT id FROM historial_compras  WHERE id_cliente=$id_client;";
        $result = mysqli_query($conn, $sql);
        if ($result) $row = mysqli_fetch_assoc($result); $id_historial = $row["id"];

        $sql = "SELECT costo_unitario_adquisicion, id FROM productos  WHERE nombre_producto='$producto';";
        $result = mysqli_query($conn, $sql);
        if ($result) $row = mysqli_fetch_assoc($result); $costo_u = $row["costo_unitario_adquisicion"]; $id_producto= $row["id"];

        $sql = "UPDATE articulos_comprados SET id_historial=$id_historial, id_producto= $id_producto, cantidad=$cantidad, costo_unitario= $costo_u WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        header("Location: ../Principal/home.html");
      }

      function actualizarHistorial($conn, $id){
        $cliente = isset($_POST["client"]) ? htmlspecialchars($_POST["client"]) : "";
        $fecha = isset($_POST["fecha_compra"]) ? htmlspecialchars($_POST["fecha_compra"]) : "";
        $metodo = isset($_POST["metodo_pago"]) ? htmlspecialchars($_POST["metodo_pago"]) : "";
        $monto_t = isset($_POST["monto_total"]) ? htmlspecialchars($_POST["monto_total"]) : "";
        $estado_c = isset($_POST["estado_compra"]) ? htmlspecialchars($_POST["estado_compra"]) : "";

        $sql = "SELECT id FROM clientes WHERE nombre_razon_social='$cliente';";
        $result = mysqli_query($conn, $sql);
        if ($result) $row = mysqli_fetch_assoc($result);
        $id_client = $row["id"];

        $sql = "UPDATE historial_compras id_cliente=$id_client, fecha_compra='$fecha', monto_total=$monto_t, metodo_pago='$metodo', estado_compra='$estado_c' WHERE id=$id;";
        $result = mysqli_query($conn, $sql);
        header("Location: ../Principal/home.html");
      }

      if (isset($_GET["table"])) {
        switch (strtolower($_GET["table"])){
          case "proveedores":
            formProveedor($server,$proveedores, $id, $conn);
            break;
          case "contactos":
             formContacto($server, $proveedores, $id, $conn);
            break;
          case "condiciones_pago":
             formCondicionPago($server, $id, $conn);
            break;
          case "productos":
            formProducto($server, $proveedores, $categories, $id, $conn);
            break;
          case "categorias":
            formCategorias($server, $id, $conn);
            break;
          case "articulos_ofrecidos":
            formArticulos($server, $proveedores, $products, $id, $conn);
            break;
          case "articulos_comprados":
            formArticulosComprados($server, $conn, $products, $clients, $id);
            break;
          case "clientes":
            formClientes($server, $conditions, $conn, $id);
            break;
          case "direcciones":
            formDirecciones($server, $clients, $id, $conn);
            break;
          case "historial_compras":
            formHistorialCompras($server,  $clients, $id, $conn);
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
                case "articulos_comprados":
                  actualizarArticuloComprado($conn, $_POST["id"]);
                  break;
                case "clientes":
                  actualizarCliente($conn, $_POST["id"]);
                  break;
                case "direcciones":
                  actualizarDireccion($conn, $_POST["id"]);
                  break;
                case "historial_compras":
                  actualizarHistorial($conn,  $_POST["id"]);
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
