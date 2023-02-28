<?php
date_default_timezone_set("America/Lima");
require_once('db_connect.php');

$action=$_GET['action'];

function selectAll($conn){
$sql = "SELECT * FROM dbo.RECIPES";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt == false) {
   die(print_r(sqlsrv_errors(), true));
 }
$data = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
 $item = ['id' => $row['ID'], 'name' => $row['NAME']];
array_push($data, $item); 
}
        
echo json_encode($data);
}

function add($conn){
$sql = "INSERT INTO recipes (name) VALUES (?)";
$params = array($_POST['name']);
$stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}
echo json_encode('se agregó correctamente');
}

function set1($conn){
$sql = "INSERT INTO recipes_machines1 (id_recipe,ppm,id_machine,date_add) VALUES (?,?,?,?)";
$params = array($_POST['name'],$_POST['ppm'],$_GET['m'],date("Y-m-d H:i:s"));
$stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}
echo json_encode('se agregó correctamente');
}

function selectRecipe($conn){
        $sql="SELECT RM.ID,R.NAME,RM.PPM,RM.ID_MACHINE FROM RECIPES R 
        INNER JOIN RECIPES_MACHINES1 RM ON R.ID=RM.ID_RECIPE WHERE RM.ID_MACHINE='3'";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt == false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $item="";
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $item=$row;
        }
        echo json_encode($item);
}


function selectRecipe1($conn){
        $sql="SELECT ID_RECIPE,PPM FROM RECIPES_MACHINES1 WHERE ID=(?)";
        $params=array($_GET['id']);
        $stmt = sqlsrv_query($conn, $sql,$params);
        if ($stmt == false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $item="";
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $item=$row;
        }
        echo json_encode($item);
} 

function update($conn){

        $sql="UPDATE RECIPES_MACHINES1 SET ID_RECIPE=(?),PPM=(?) WHERE ID=(?)";
        $params = array($_POST['name'],$_POST['ppm'],$_POST['id']);
        $stmt = sqlsrv_query( $conn, $sql, $params);

        if( $stmt === false ) {

            die( print_r( sqlsrv_errors(), true));
        }

        echo json_encode('se cambió correctamente');

}
    
$action($conn);
