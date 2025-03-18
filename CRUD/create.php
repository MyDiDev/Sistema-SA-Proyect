<?php 
include("../Datos/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register <?php echo $_POST["table"]; ?></title>
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
      $conditions = "";
      $clients = "";
      $products = "";

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

      getAllProveedores($conn);
      getAllCategories($conn);
      getAllCondiciones($conn);
      getAllClients($conn);
      getAllProducts($conn);

      function getAllProducts($conn){
        global $products;
        $sql = "SELECT nombre_producto FROM productos";      
        $result = mysqli_query($conn, $sql);
        
        if ($result) while ($row = mysqli_fetch_assoc($result)){
          $product = $row["nombre_producto"];
          $products .= "<option value=\"$product\">$product</option>";
        }
      }

      # Formularios 

      function formClientes($server, $conditions){
        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
          <h2>Registra un Cliente</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <input type="hidden" name="createTable" value="clientes">
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
                  style="background-color: #151c26; border: none; color: white"
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
                  style="background-color: #151c26; border: none; color: white"
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
                  style="background-color: #151c26; border: none; color: white"
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
                  style="background-color: #151c26; border: none; color: white"
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
                  style="background-color: #151c26; border: none; color: white"
                  required
                >
                  $conditions
                </select>
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Registrar</button>
        </form>
        EOD;
      }

      function formArticulosComprados($server, $producto, $clients){
        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
          <h2>Registra un Articulo Comprado</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <input type="hidden" name="createTable" value="articulos_comprados">
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
                  style="background-color: #151c26; border: none; color: white"
                  required
                >
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
                  style="background-color: #151c26; border: none; color: white"
                  required
                >
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

      function formDirecciones($server, $clients){
        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
          <h2>Registra una Direccion</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <input type="hidden" name="createTable" value="direcciones">
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
                  style="background-color: #151c26; border: none; color: white"
                  required
                >
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
                  style="background-color: #151c26; border: none; color: white"
                  required
                >
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

      function formHistorialCompras($server,  $clients){
        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
          <h2>Registra una Direccion</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <input type="hidden" name="createTable" value="historial_compras">
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
                  style="background-color: #151c26; border: none; color: white"
                  required
                >
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
                  style="background-color: #151c26; border: none; color: white"
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
                  style="background-color: #151c26; border: none; color: white"
                  required  
                />
              </div>
              <div class="mb-3">
                <label for="metodo_pago" class="form-label">Metodo de Pago:</label>
                <select
                  class="form-control"
                  name="metodo_pago"
                  id="metodo_pago"
                  style="background-color: #151c26; border: none; color: white"
                  required  
                >
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
                  style="background-color: #151c26; border: none; color: white"
                  required  
                >
                  <option value="realizada">Realizada</option>
                  <option value="no realizada">No Realizada</option>
                </select>
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Registrar</button>
        </form>
        EOD;
      }

      function formCategorias($server){
        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
          <h2>Registra una Categoria</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <input type="hidden" name="createTable" value="categorias">
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

      function formContacto($server, $options){
        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
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
    
      function formCondicionPago($server){

        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
          <h2>Registra una Condicion de Pago</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <input type="hidden" name="createTable" value="condiciones_pago">
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
                required
              ></textarea>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button" type="submit">Registrar</button>
        </form>
        EOD;
      }

      function formProveedor($server){
        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
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
        EOD;
      }
      
      function formProducto($server,$proveedores, $categorias){
        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
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
        EOD;
      }

      function formArticulos($server, $proveedores, $categorias){
        echo <<<EOD
        <form  action="$server" class="w-50 p-3 rounded shadow mt-5 mb-5" method="POST" id="formulary">
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



      # Agregar

      function agregarCliente($conn){
        $nombre_razon = isset($_POST["nombre_cliente"]) ? htmlspecialchars($_POST["nombre_cliente"]) : "";
        $nombre_contacto = isset($_POST["nombre_contacto"]) ? htmlspecialchars($_POST["nombre_contacto"]) : "";
        $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "";
        $telefono = isset($_POST["phone_num"]) ? htmlspecialchars($_POST["phone_num"]) : "";
        $condition = isset($_POST["condition"]) ? htmlspecialchars($_POST["condition"]) : "";

        $sql = "SELECT id FROM condiciones_pago WHERE descripcion='$condition'";
        $result = mysqli_query($conn, $sql);
        if ($result) $row =  mysqli_fetch_assoc($result);
        $id_c = $row["id"];

        $sql = "INSERT INTO clientes(nombre_razon_social, nombre_contacto, telefono, correo_electronico, id_condicion_pago) VALUES ('$nombre_razon', '$nombre_contacto', '$telefono', '$email', $id_c)";
        $result = mysqli_query($conn, $sql);
         header("../Principal/home.html");
      }

      function agregarDireccion($conn){
        $cliente = isset($_POST["client"]) ? htmlspecialchars($_POST["client"]) : "";
        $tipo = isset($_POST["tipo_direccion"]) ? htmlspecialchars($_POST["tipo_direccion"]) : "";
        $direccion = isset($_POST["direcciones"]) ? htmlspecialchars($_POST["direcciones"]) : "";

        $sql = "SELECT id FROM clientes WHERE nombre_razon_social='$cliente';";
        $result = mysqli_query($conn, $sql);
        if ($result) $row = mysqli_fetch_assoc($result);
        $id_client = $row["id"];

        $sql = "INSERT INTO direcciones(id_cliente, tipo_direccion, direccion) VALUES($id_client, '$tipo', '$direccion');";
        $result = mysqli_query($conn, $sql);
        header("../Principal/home.html");
      }

      function agregarArticuloComprado($conn){
        $cliente = isset($_POST["client"]) ? htmlspecialchars($_POST["client"]) : "";
        $tipo = isset($_POST["tipo_direccion"]) ? htmlspecialchars($_POST["tipo_direccion"]) : "";
        $direccion = isset($_POST["direccion"]) ? htmlspecialchars($_POST["direccion"]) : "";

        $sql = "SELECT id FROM clientes WHERE nombre_razon_social='$cliente';";
        $result = mysqli_query($conn, $sql);
        if ($result) $row = mysqli_fetch_assoc($result);
        $id_client = $row["id"];

        $sql = "INSERT INTO direcciones(id_cliente, tipo_direccion, direccion) VALUES($id_client, '$tipo', '$direccion');";
        $result = mysqli_query($conn, $sql);
        header("../Principal/home.html");
      }

      
      function agregarHistorial($conn){
        $cliente = isset($_POST["client"]) ? htmlspecialchars($_POST["client"]) : "";
        $fecha = isset($_POST["fecha_compra"]) ? htmlspecialchars($_POST["fecha_compra"]) : "";
        $metodo = isset($_POST["metodo_pago"]) ? htmlspecialchars($_POST["metodo_pago"]) : "";
        $monto_t = isset($_POST["monto_total"]) ? htmlspecialchars($_POST["monto_total"]) : "";
        $estado_c = isset($_POST["estado_compra"]) ? htmlspecialchars($_POST["estado_compra"]) : "";

        $sql = "SELECT id FROM clientes WHERE nombre_razon_social='$cliente';";
        $result = mysqli_query($conn, $sql);
        if ($result) $row = mysqli_fetch_assoc($result);
        $id_client = $row["id"];

        $sql = "INSERT INTO historial_compras(id_cliente, fecha_compra, monto_total, metodo_pago, estado_compra) VALUES($id_client, '$fecha', $monto_t, '$metodo', '$estado_c')";
        $result = mysqli_query($conn, $sql);
        header("../Principal/home.html");
      }

      function agregarProducto($conn){
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
          header("Location: ../Principal/home.html");
        }else{
          echo "No se pudo agregar el producto, Se necesita Categoria y Proveedor";
        }
      }

      function agregarProveedor($conn){
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
        header("Location: ../Principal/home.html");
      }
      
      function agregarContactos($conn){
        $proveedor = isset($_POST["proveedor"]) ? htmlspecialchars($_POST["proveedor"]) : null;
        $nombre_contacto = isset($_POST["nombre"]) ? htmlspecialchars($_POST["nombre"]) : null;
        $telefono = isset($_POST["telefono_contacto"]) ? htmlspecialchars($_POST["telefono_contacto"]) : null;
        $correo = isset($_POST["correo"]) ? htmlspecialchars($_POST["correo"]) : null;

        $sql = "SELECT ID FROM proveedores WHERE nombre_empresa='$proveedor';";
        $result = mysqli_query($conn, $sql);
        if ($result) $row = mysqli_fetch_assoc($result); $id_p =$row["ID"];

        $sql = "INSERT INTO contactos (ID_Proveedor, Nombre_Contacto, Telefono_Contacto, Correo_Contacto) VALUES ($id_p, '$nombre_contacto', '$telefono', '$correo')";
        
        $result = mysqli_query($conn, $sql);
        header("Location: ../Principal/home.html");
      }
      
      function agregarCondicionPago($conn){
        $descripcion = isset($_POST["desc"]) ? htmlspecialchars($_POST["desc"]) : null;
        $sql = "INSERT INTO condiciones_pago(descripcion) VALUES ('$descripcion');";
        $result = mysqli_query($conn, $sql);
        header("Location: ../Principal/home.html");
      }
      
      function agregarCategoria($conn){
        $descripcion = isset($_POST["desc"]) ? htmlspecialchars($_POST["desc"]) : null;
        $sql = "INSERT INTO categorias(Nombre_Categoria) VALUES ('$descripcion');";
        $result = mysqli_query($conn, $sql);
        header("Location: ../Principal/home.html");
      }
      
      function agregarArticulo($conn){
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
          header("Location: ../Principal/home.html");
        }

      }

      if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST["table"])) {
          switch (strtolower($_POST["table"])){
            case "proveedores":
              formProveedor($server);
              break;
            case "contactos":
              formContacto($server, $options);
              break;
            case "condiciones_pago":
              formCondicionPago($server);
              break;
            case "productos":
              formProducto($server, $options, $categories);
              break;
            case "categorias":
              formCategorias($server);
              break;
            case "articulos_ofrecidos":
              formArticulos($server, $options, $categories);
              break;
            case "articulos_comprados":
              formArticulosComprados($server, $products, $clients);
              break;
            case "clientes":
              formClientes($server, $conditions);
              break;
            case "direcciones":
              formDirecciones($server, $clients);
              break;
            case "historial_compras":
              formHistorialCompras($server,  $clients);
              break;
            default:
              echo "<div class=\"alert alert-danger\">ERROR OCURRIDO: No se econtraron Datos suficientes</div>";
              break;
          }
        }
        elseif(isset($_POST["createTable"])){
            session_start();
            switch(strtolower($_POST["createTable"])) {
              case "proveedores":
                $_SESSION["table"] = "proveedores";
                agregarProveedor($conn);
                break;
              case "contactos":
                $_SESSION["table"] = "contactos";
                agregarContactos($conn);
                break;
              case "condiciones_pago":
                $_SESSION["table"] = "condiciones_pago";
                agregarCondicionPago($conn);
                break;
              case "productos":
                $_SESSION["table"] = "productos";
                agregarProducto($conn);
                break;
              case "categorias":
                $_SESSION["table"] = "categorias";
                agregarCategoria($conn);
                break;
              case "articulos_ofrecidos":
                $_SESSION["table"] = "articulos_ofrecidos";
                agregarArticulo($conn);
                break;
              case "articulos_comprados":
                agregarArticuloComprado($conn);
                break;
              case "clientes":
                agregarCliente($conn);
                break;
              case "direcciones":
                agregarDireccion($conn);
                break;
              case "historial_compras":
                agregarHistorial($conn);
                break;
              default:
                echo "<div class=\"alert alert-danger\">ERROR OCURRIDO: No se econtraron datos suficientes</div>";
                break;
            }
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
