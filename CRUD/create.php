<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register <php>Productos</php></title>
    <link rel="stylesheet" href="style.css" />
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
    <link rel="stylesheet" href="style.css" />
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
      function formCategorias(){
        echo <<<EOD
          <form action="" class="w-75 p-3 rounded shadow mt-5 mb-5">
          <h2>Registra una Categoria</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <br />
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="" class="form-label">Nombre de la Categoria:</label>
                <input
                  type="email"
                  class="form-control"
                  name="nombre"
                  rows="3"
                  id="nombre"
                  style="background-color: #151c26; border: none; color: white"
                  required
                />
              </div>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button">Registrar</button>
        </form>
        EOD;
      }

      function formContacto(){
        echo <<<EOD
        <form action="" class="w-75 p-3 rounded shadow mt-5 mb-5">
          <h2>Registra un Contacto</h2>

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
                  <option value="null">...</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Nombre del Contacto:</label>
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
                <label for="" class="form-label">Telefono del Contacto:</label>
                <input
                  type="text"
                  class="form-control"
                  name="telefono"
                  rows="3"
                  id="telefono"
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
          <button class="btn w-100" id="button">Registrar</button>
        </form>
        EOD;
      }
    
      function formCondicionPago(){
        echo <<<EOD
        <form action="" class="w-75 p-3 rounded shadow mt-5 mb-5">
          <h2>Registra una Condicion de Pago</h2>

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
                required
              ></textarea>
            </div>
          </div>
          <br />
          <button class="btn w-100" id="button">Registrar</button>
        </form>
        EOD;
      }

      function formProveedor(){
        echo <<<EOD
        <form action="" class="w-75 p-3 rounded shadow mt-5 mb-5">
          <h2>Registra un Proveedor</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <br />
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="" class="form-label">Nombre de la Empresa:</label>
                <input
                  type="text"
                  class="form-control"
                  name="proveedor"
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
                  name="desc"
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
                  name="codigo_sku"
                  id="codigo_sku"
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
          <button class="btn w-100" id="button">Registrar</button>
        </form>
        EOD;
      }

      function formProducto(){
        echo <<<EOD
        <form action="" class="w-75 p-3 rounded shadow mt-5 mb-5">
          <h2>Registra un Producto</h2>

          <hr class="w-100 mt-4" color="black" size="7px" />
          <br />
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="" class="form-label">Proveedor:</label>
                <select
                  class="form-control"
                  name="proveedor"
                  id="provider"
                  style="background-color: #151c26; border: none; color: white"
                  required
                ></select>
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
                <select
                  class="form-control"
                  name="codigo_sku"
                  id="codigo_sku"
                  style="background-color: #151c26; border: none; color: white"
                  required
                ></select>
              </div>
              <div class="mb-3">
                <label for="costo_a" class="form-label"
                  >Costo de Adquisicion:</label
                >
                <select
                  class="form-control"
                  name="costo_a"
                  id="costo_a"
                  style="background-color: #151c26; border: none; color: white"
                  required
                ></select>
              </div>
              <div class="mb-3">
                <label for="proveedor" class="form-label">Proveedor:</label>
                <select
                  class="form-control"
                  name="proveedor"
                  id="proveedor"
                  style="background-color: #151c26; border: none; color: white"
                  required
                ></select>
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
                ></select>
              </div>
              <div class="mb-3">
                <label for="precio_u" class="form-label">Precio Unitario:</label>
                <input
                  class="form-control"
                  name="precio_u"
                  id="precio_u"
                  style="background-color: #151c26; border: none; color: white"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="stock_actual" class="form-label">Stock Actual</label>
                <input
                  type="number"
                  class="form-control"
                  name="stock_actual"
                  id="stock_actual"
                  style="background-color: #151c26; border: none; color: white"
                  required
                />
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
          </div>
          <br />
          <button class="btn w-100" id="button">Registrar</button>
        </form>
        EOD;
      }

      function formArticulos(){
        echo <<<EOD

        EOD;
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
        $id_p = (int)mysqli_fetch_assoc($result);

        $sql = "SELECT ID FROM categorias WHERE descripcion='$categoria';";
        $result = mysqli_query($conn, $sql);
        $id_c = (int)mysqli_fetch_assoc($result);
        

        if ($id_p && $id_c){
            $sql = "INSERT INTO productos(ID_Proveedor, ID_Categoria, Nombre_Producto, Descripcion_Producto, Codigo_Barra_O_SKU, Precio_Unitario_Venta, Costo_Unitario_Adquisicion, Stock_Actual, Stock_Minimo, Unidad_De_Medida)  VALUES ($id_p, $id_c, '$nombre_producto', '$descripcion', '$codigo', $precio_u, $costo_a, $stock_a, $stock_m, '$unidad_medida')";
            $result = mysqli_query($conn, $sql);
            header("Location: listados.php");
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
        header("Location: listados.php");
      }
      function agregarContactos($conn){
        $proveedor = isset($_POST["proveedor"]) ? htmlspecialchars($_POST["proveedor"]) : null;
        $nombre_contacto = isset($_POST["nombre"]) ? htmlspecialchars($_POST["nombre"]) : null;
        $telefono = isset($_POST["telefono_contacto"]) ? htmlspecialchars($_POST["telefono_contacto"]) : null;
        $correo = isset($_POST["correo"]) ? htmlspecialchars($_POST["correo"]) : null;

        $sql = "SELECT ID FROM proveedores WHERE nombre_empresa='$proveedor';";
        $result = mysqli_query($conn, $sql);
        if ($result) $id_p = (int)mysqli_fetch_assoc($result);

        $sql = "INSERT INTO Proveedores_Contactos (ID_Proveedor, Nombre_Contacto, Telefono_Contacto, Correo_Contacto) VALUES ($id_p, '$nombre_contacto', '$telefono', '$correo')";
        
        $result = mysqli_query($conn, $sql);
        header("Location: listados.php");
      }
      function agregarCondicionPago($conn){
        $descripcion = isset($_POST["desc"]) ? htmlspecialchars($_POST["desc"]) : null;
        $sql = "INSERT INTO condiciones_pago(descripcion) VALUES ('$descripcion');";
        $result = mysqli_query($conn, $sql);
        header("Location: listados.php");
      }
      function agregarCategoria($conn){
        $descripcion = isset($_POST["desc"]) ? htmlspecialchars($_POST["desc"]) : null;
        $sql = "INSERT INTO categorias(descripcion) VALUES ('$descripcion');";
        $result = mysqli_query($conn, $sql);
        header("Location: listados.php");
      }
      function agregarArticulo($conn){
        $proveedor = isset($_POST["proveedor"]) ? htmlspecialchars($_POST["proveedor"]) : null;
        $nombre_producto = isset($_POST["nombre_producto"]) ? htmlspecialchars($_POST["nombre_producto"]) : null;
        
        $sql = "SELECT ID FROM proveedores WHERE nombre_empresa='$proveedor';";
        $result = mysqli_query($conn, $sql);
        $id_p = (int)mysqli_fetch_assoc($result);

        $sql = "SELECT ID FROM productos WHERE nombre_producto='$nombre_producto';";
        $result = mysqli_query($conn, $sql);
        $id_pr = (int)mysqli_fetch_assoc($result);
        
        if ($id_p && $id_pr){
            $sql = "INSERT INTO articulos_ofrecidos(ID_Proveedor, ID_Producto) VALUES($id_p, $id_pr);";
            $result = mysqli_query($conn, $sql);
            header("Location: listados.php");
        }

      }

      if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST["table"])) {
          switch (strtolower($_POST["table"])){
            case "proveedores":
              formProveedor();
              break;
            case "contactos":
              formContacto();
              break;
            case "condiciones_pago":
              formCondicionPago();
              break;
            case "productos":
              formProducto();
              break;
            case "categorias":
              formCategorias();
              break;
            case "articulos_ofrecidos":
              formArticulos();
              break;
            default:
              echo "<div class=\"alert alert-danger\">ERROR OCURRIDO: No se econtraron Datos suficientes</div>";
              break;
          }
        }

        if (isset($_POST["createData"])){
          if(isset($_POST["createTable"])){
             switch($_POST["creatTable"]) {
                case "proveedores":
                    agregarProveedor($conn);
                    break;
                case "contactos":
                    agregarContactos($conn);
                    break;
                case "condiciones_pago":
                    agregarCondicionPago($conn);
                    break;
                case "productos":
                    agregarProducto($conn);
                    break;
                case "categorias":
                    agregarCategoria($conn);
                    break;
                case "articulos_ofrecidos":
                    agregarArticulo($conn);
                    break;
                default:
                    echo "<div class=\"alert alert-danger\">ERROR OCURRIDO: No se econtraron datos suficientes</div>";
                    break;
            }
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
