<?php 
include('../Datos/conn.php');
function deleteData($table, $id, $id_col, $conn){
    $sql = "DELETE FROM $table WHERE $id_col=$id";
    $result = mysqli_query($conn, $sql);
    echo "Dato Eliminado";
    header("Location: ../Principal/home.html");
}

isset($_GET["id"]) && isset($_GET["table"]) && isset($_GET["id_col"]) ? deleteData($_GET["table"], $_GET["id"], $_GET["id_col"], $conn) : header("location: home.html");

?>
