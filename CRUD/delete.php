<?php 
include('conn.php');

function deleteData($table, $id, $id_col, $conn){
    $sql = "DELETE FROM $table WHERE $id_col=$id";
    $result = mysqli_query($conn, $sql);
}

isset($_GET["id"]) && isset($_GET["table"]) && isset($_GET["idCol"]) ? deleteData($_GET["table"], $_GET["id"], $_GET["idCol"], $conn) : header("location: home.html");

header("Location: listados.php")
?>
