<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado de Clientes</title>
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
    <link rel="stylesheet" href="../Estilos/style.css" />
</head>
<body>
    <?php 
        if ($_SERVER['REQUEST_METHOD'] == "POST"){

        }else{
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

                    <td><a href=\"../UD/delete.php?id=$id\">Eliminar</a></td>
                    <td><a href=\"update.php?id=$id\">Editar</a></td>
                  </tr>
              ";
            }
            echo "
              </tbody>
            </table>
            ";
        }
    ?>
</body>
</html>