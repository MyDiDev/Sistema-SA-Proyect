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
            <table class=\"table table-dark table-striped table-hover w-75\">
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

                    <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=productos&id_col=ID\">Eliminar</a></td>
                    <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=productos\">Editar</a></td>
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
              <table class=\"table table-dark table-striped table-hover w-75\">
                <thead>
                  <th>N.</ w-75th>
                  <th>CATEGORIA</th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
            ";

            while ($row = mysqli_fetch_assoc($result)){
                $id = $row["ID"];
                $categoria = $row["Nombre_Categoria"];

                echo"
                    <tr>
                      <td>$id</td>
                      <td>$categoria</td>    
                      <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=categorias&id_col=ID\">Eliminar</a></td>
                      <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=categorias\">Editar</a></td>
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
              <table class=\"table table-dark table-striped table-hover w-75\">
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
                      <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=condiciones_pago&id_col=ID\">Eliminar</a></td>
                      <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=condiciones_pago\">Editar</a></td>
                    </tr>
                ";
            }

            echo "
              </tbody>
            </table>
            ";
        }

        function showArticulosTable($conn){
            $sql = "SELECT articulos_ofrecidos.id, proveedores.nombre_empresa, productos.nombre_producto FROM articulos_ofrecidos JOIN proveedores ON articulos_ofrecidos.ID_Proveedor = proveedores.ID JOIN productos ON articulos_ofrecidos.ID_Producto = productos.ID";
            $result = mysqli_query($conn, $sql);

            echo "
              <table class=\"table table-dark table-striped table-hover w-75\">
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
                $id = $row["id"];
                $proveedor = $row["nombre_empresa"];
                $producto = $row["nombre_producto"];

                echo"
                    <tr>
                      <td>$id</td>
                      <td>$proveedor</td>
                      <td>$producto</td>
                      <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=articulos_ofrecidos&id_col=ID\">Eliminar</a></td>
                      <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=articulos_ofrecidos\">Editar</a></td>
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
              <table class=\"table table-dark table-striped table-hover w-75\">
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
                      <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=contactos&id_col=ID\">Eliminar</a></td>
                      <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=contactos\">Editar</a></td>
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
            <table class=\"table table-dark table-striped table-hover w-75\">
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
                    <td>$tiempo_promedio</td>
                    <td>$estado</td>
                    <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=proveedores&id_col=ID\">Eliminar</a></td>
                    <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=proveedores\">Editar</a></td>
                  </tr>
              ";
          }

          echo "
            </tbody>
          </table>
          ";
        } 

        function showClientesTable($conn){
            $sql = "SELECT clientes.id, clientes.nombre_razon_social, clientes.nombre_contacto, clientes.telefono, clientes.correo_electronico, condiciones_pago.descripcion FROM clientes JOIN condiciones_pago  ON clientes.id_condicion_pago = condiciones_pago.ID;";
            
            $result = mysqli_query($conn, $sql);
            echo "
            <table class=\"table table-dark table-striped table-hover w-75\">
              <thead>
                <th>N.</th>
                <th>NOMBRE O RAZON SOCIAL</th>
                <th>NOMBRE DEL CONTACTO</th>
                <th>TELEFONO</th>
                <th>EMAIL</th>
                <th>CONDICION DE PAGO</th

                <th></th>
                <th></th>
                <th></th>

              </thead>
              <tbody>
            ";
            while ($row = mysqli_fetch_assoc($result)){
              $id = $row["id"];
              $nombre_razon = $row["nombre_razon_social"];
              $nombre_contacto = $row["nombre_contacto"];
              $telefono = $row["telefono"];
              $email = $row["correo_electronico"];
              $condicion_pago = $row["descripcion"];
              echo"
                  <tr>
                    <td>$id</td>
                    <td>$nombre_razon</td>
                    <td>$nombre_contacto</td>
                    <td>$telefono</td>
                    <td>$email</td>
                    <td>$condicion_pago</td>

                    <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=clientes&id_col=ID\">Eliminar</a></td>
                    <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=clientes\">Editar</a></td>
                  </tr>
              ";
            }
            echo "
              </tbody>
            </table>
            ";
        }   
        
        function showDireccionesTable($conn){
            $sql = "SELECT direcciones.id, clientes.nombre_razon_social, direcciones.tipo_direccion, direcciones.direccion FROM direcciones JOIN clientes ON direcciones.id_cliente = clientes.id;";
            
            $result = mysqli_query($conn, $sql);
            echo "
            <table class=\"table table-dark table-striped table-hover w-75\">
              <thead>
                <th>N.</th>
                <th>NOMBRE DEL CLIENTE</th>
                <th>TIPO DE DIRECCION</th>
                <th>DIRECCION</th>

                <th></th>
                <th></th>
              </thead>
              <tbody>
            ";
            while ($row = mysqli_fetch_assoc($result)){
              $id = $row["id"];
              $nombre_razon = $row["nombre_razon_social"];
              $tipo_direccion = $row["tipo_direccion"];
              $direccion = $row["direccion"];

              echo"
                  <tr>
                    <td>$id</td>
                    <td>$nombre_razon</td>
                    <td>$tipo_direccion</td>
                    <td>$direccion</td>

                    <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=direcciones&id_col=id\">Eliminar</a></td>
                    <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=direcciones\">Editar</a></td>
                  </tr>
              ";
            }
            echo "
              </tbody>
            </table>
            ";
        }   
        
        function showHistorialComprasTable($conn){
          $sql = "SELECT historial_compras.id, clientes.nombre_razon_social, historial_compras.fecha_compra, historial_compras.monto_total, historial_compras.metodo_pago, historial_compras.estado_compra  FROM historial_compras JOIN clientes ON historial_compras.id_cliente = clientes.id;";
            
          $result = mysqli_query($conn, $sql);
            echo "
            <table class=\"table table-dark table-striped table-hover w-75\">
              <thead>
                <th>N.</th>
                <th>NOMBRE DEL CLIENTE</th>
                <th>FECHA DE COMPRA</th>
                <th>MONTO TOTAL</th>
                <th>METODO DE PAGO</th>
                <th>ESTADO DE LA COMPRA</th>

                <th></th>
                <th></th>
              </thead>
              <tbody>
            ";
          while ($row = mysqli_fetch_assoc($result)){
            $id = $row["id"];
            $nombre_razon = $row["nombre_razon_social"];
            $fecha_compra = $row["fecha_compra"];
            $metodo = $row["metodo_pago"];
            $monto_total = $row["monto_total"];
            $estado_compra = $row["estado_compra"];
              
            echo"
                <tr>
                  <td>$id</td>
                  <td>$nombre_razon</td>
                  <td>$fecha_compra</td>
                  <td>$monto_total</td>
                  <td>$metodo</td>
                  <td>$estado_compra</td>
                  <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=historial_compras&id_col=id\">Eliminar</a></td>
                  <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=historial_compras\">Editar</a></td>
                  </tr>
              ";
            }
            echo "
              </tbody>
            </table>
            ";
        }   

        function showArticulosComprado($conn){
            $sql = "SELECT articulos_comprados.id, historial_compras.id as id_historial, productos.nombre_producto, articulos_comprados.cantidad, articulos_comprados.costo_unitario, articulos_comprados.costo_total FROM articulos_comprados JOIN productos ON articulos_comprados.id_producto = productos.id JOIN historial_compras ON articulos_comprados.id_historial = historial_compras.id;";
            
            $result = mysqli_query($conn, $sql);
            echo "
            <table class=\"table table-dark table-striped table-hover w-75\">
              <thead>
                <th>N.</th>
                <th>N. DE HISTORIAL</th>
                <th>NOMBRE DEL PRODUCTO</th>
                <th>CANTIDAD</th>
                <th>COSTO UNITARIO</th>
                <th>COSTO TOTAL</th>
                <th></th>
                <th></th>
              </thead>
              <tbody>
            ";
            while ($row = mysqli_fetch_assoc($result)){
              $id = $row["id"];
              $id_h = $row["id_historial"];
              $nombre_producto = $row["nombre_producto"];
              $cantidad = $row["cantidad"];
              $costo_u = $row["costo_unitario"];
              $costo_t = $row["costo_total"];
              
              echo"
                  <tr>
                    <td>$id</td>
                    <td>$id_h</td>
                    <td>$nombre_producto</td>
                    <td>$cantidad</td>
                    <td>$costo_u</td>
                    <td>$costo_t</td>
                    <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=articulos_comprados&id_col=id\">Eliminar</a></td>
                    <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=articulos_comprados\">Editar</a></td>
                  </tr>
              ";
            }
            echo "
              </tbody>
            </table>
            ";
        }   

        function showInventarioTable($conn){
          $sql = "SELECT inventario.id, productos.Nombre_Producto, inventario.cantidad_disponible, inventario.stock_maximo, inventario.stock_minimo, inventario.ubicacion FROM inventario JOIN productos ON inventario.id_producto = productos.ID;";
          $result = mysqli_query($conn, $sql);
          
          echo "
            <table class=\"table table-dark table-striped table-hover w-75\">
              <thead>
                <th>N.</th>
                <th>NOMBRE DEL PRODUCTO</th>
                <th>CANTIDAD</th>
                <th>STOCK MAX.</th>
                <th>STOCK MIN.</th>
                <th>UBICACION</th>
                <th></th>
                <th></th>
              </thead>
              <tbody>
            ";
            while ($row = mysqli_fetch_assoc($result)){
              $id = $row["id"];
              $nombre_producto = $row["Nombre_Producto"];
              $cantidad = $row["cantidad_disponible"];
              $stock_max = $row["stock_maximo"];
              $stock_min = $row["stock_minimo"];
              $ubi = $row["ubicacion"];
              
            echo"
                  <tr>
                    <td>$id</td>
                    <td>$nombre_producto</td>
                    <td>$cantidad</td>
                    <td>$stock_max</td>
                    <td>$stock_min</td>
                    <td>$ubi</td>
                    <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=inventario&id_col=id\">Eliminar</a></td>
                    <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=inventario\">Editar</a></td>
                  </tr>
              ";
            }
            echo "
              </tbody>
            </table>
            ";
        }

        function showHistorialMovTable($conn){
          $sql = "SELECT historial_movimiento.id, productos.Nombre_Producto, historial_movimiento.tipo_movimiento, historial_movimiento.cantidad, historial_movimiento.fecha_movimiento, historial_movimiento.motivo FROM historial_movimiento JOIN productos ON historial_movimiento.id_producto = productos.ID;";
          $result = mysqli_query($conn, $sql);
          
          echo "
            <table class=\"table table-dark table-striped table-hover w-75\">
              <thead>
                <th>N.</th>
                <th>NOMBRE DEL PRODUCTO</th>
                <th>TIPO DEL MOVIMIENTO</th>
                <th>CANTIDAD</th>
                <th>FECHA DEL MOVIMIENTO</th>
                <th>MOTIVO</th>
                <th></th>
                <th></th>
              </thead>
              <tbody>
            ";
            while ($row = mysqli_fetch_assoc($result)){
              $id = $row["id"];
              $nombre_producto = $row["Nombre_Producto"];
              $t_mov = $row["tipo_movimiento"];
              $cant = $row["cantidad"];
              $f_mov = $row["fecha_movimiento"];
              $motivo = $row["motivo"];
              
            echo"
                  <tr>
                    <td>$id</td>
                    <td>$nombre_producto</td>
                    <td>$t_mov</td>
                    <td>$cant</td>
                    <td>$f_mov</td>
                    <td>$motivo</td>
                    <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=historial_movimiento&id_col=id\">Eliminar</a></td>
                    <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=historial_movimiento\">Editar</a></td>
                  </tr>
              ";
            }
            echo "
              </tbody>
            </table>
            ";
        }
        
        function showVentasTable($conn){
          $sql = "SELECT ventas.id, clientes.nombre_razon_social, ventas.codigo_venta, ventas.fecha_venta, ventas.monto_total, ventas.estado_venta FROM ventas JOIN clientes ON ventas.id_cliente = clientes.id;";

          $result = mysqli_query($conn, $sql);
          
          echo "
            <table class=\"table table-dark table-striped table-hover w-75\">
              <thead>
                <th>N.</th>
                <th>NOMBRE CLIENTE</th>
                <th>CODIGO VENTA</th>
                <th>FECHA DE VENTA</th>
                <th>MONTO TOTAL</th>
                <th>ESTADO</th>
                <th></th>
                <th></th>
              </thead>
              <tbody>
            ";
            while ($row = mysqli_fetch_assoc($result)){
              $id = $row["id"];
              $client = $row["nombre_razon_social"];
              $code = $row["codigo_venta"];
              $f_venta = $row["fecha_venta"];
              $total = $row["monto_total"];
              $state = $row["estado_venta"];
              
            echo"
                  <tr>
                    <td>$id</td>
                    <td>$client</td>
                    <td>$code</td>
                    <td>$f_venta</td>
                    <td>$total</td>
                    <td>$state</td>
                    <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=ventas&id_col=id\">Eliminar</a></td>
                    <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=ventas\">Editar</a></td>
                  </tr>
              ";
            }
            echo "
              </tbody>
            </table>
            ";
        }
        
        function showDetalleVentasTable($conn){
          $sql = "SELECT detalle_ventas.id, ventas.codigo_venta, productos.Nombre_Producto, detalle_ventas.cantidad, detalle_ventas.precio_unitario, detalle_ventas.total FROM detalle_ventas JOIN productos ON detalle_ventas.id_producto = productos.id JOIN ventas ON detalle_ventas.id_venta = ventas.ID;";

          $result = mysqli_query($conn, $sql);
          
          echo "
            <table class=\"table table-dark table-striped table-hover w-75\">
              <thead>
                <th>N.</th>
                <th>CODIGO VENTA</th>
                <th>NOMBRE PRODUCTO</th>
                <th>CANTIDAD</th>
                <th>PRECIO UNITARIO</th>
                <th>TOTAL</th>
                <th></th>
                <th></th>
              </thead>
              <tbody>
            ";
            while ($row = mysqli_fetch_assoc($result)){
              $id = $row["id"];
              $code = $row["codigo_venta"];
              $product = $row["Nombre_Producto"];
              $cant = $row["cantidad"];
              $precio_unitario = $row["precio_unitario"];
              $total = $row["total"];
              
            echo"
                  <tr>
                    <td>$id</td>
                    <td>$code</td>
                    <td>$product</td>
                    <td>$cant</td>
                    <td>$precio_unitario</td>
                    <td>$total</td>
                    <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=detalle_ventas&id_col=id\">Eliminar</a></td>
                    <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=detalle_ventas\">Editar</a></td>
                  </tr>
              ";
            }
            echo "
              </tbody>
            </table>
            ";
        }

        function showObservacionesTable($conn){
          $sql = "SELECT observaciones.id, ventas.codigo_venta, observaciones.observacion FROM observaciones JOIN ventas ON observaciones.id_venta = ventas.id";

          $result = mysqli_query($conn, $sql);
          
          echo "
            <table class=\"table table-dark table-striped table-hover w-75\">
              <thead>
                <th>N.</th>
                <th>CODIGO VENTA</th>
                <th>OBSERVACION</th>
                <th></th>
                <th></th>
              </thead>
              <tbody>
            ";
            while ($row = mysqli_fetch_assoc($result)){
              $id = $row["id"];
              $code = $row["codigo_venta"];
              $feed = $row["observacion"];
              
            echo"
                  <tr>
                    <td>$id</td>
                    <td>$code</td>
                    <td>$feed</td>
                    <td><a class=\"btn btn-danger\"  href=\"../CRUD/delete.php?id=$id&table=observaciones&id_col=id\">Eliminar</a></td>
                    <td><a class=\"btn btn-primary\"  href=\"../CRUD/update.php?di=$id&table=observaciones\">Editar</a></td>
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
                case "clientes":
                  showClientesTable($conn);
                  break;
                case "direcciones":
                  showDireccionesTable($conn);
                  break;
                case "articulos_comprados":
                  showArticulosComprado($conn);
                  break;
                case "historial_compras":
                  showHistorialComprasTable($conn);
                  break; 
                case "inventario":
                  showInventarioTable($conn);
                  break;
                case "observaciones":
                  showObservacionesTable($conn);
                  break; 
                case "historial_movimiento":
                  showHistorialMovTable($conn);
                  break; 
                case "ventas":
                  showVentasTable($conn);
                  break; 
                case "detalle_ventas":
                  showDetalleVentasTable($conn);
                  break;
                default:
                  session_destroy();
                  echo "<div class=\"alert alert-danger\">ERROR OCURRIDO: No se econtraron Datos suficientes</div>";
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
