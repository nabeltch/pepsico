<?php

require_once('db_connect.php');
$date=$_GET['date'];
$hoursId=[7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,1,2,3,4,5,6];
$data=[];
$machine=$_GET['m'];

$sql="";

for ($i=0; $i < count($hoursId); $i++) { 
    $machineName="KS_SNACK.KS_DEVICE.SQL_EFI1.Online.PackMac_$machine.Actual.PackMac_".$machine."_Actual[$hoursId[$i]]";
    $sql.="SELECT TOP(1) _VALUE FROM KS_QTYTOTALHORA WHERE _NAME='$machineName' AND cast (_TIMESTAMP as date) = '$date' AND cast (_TIMESTAMP as time)>='7:01:58' AND cast (_TIMESTAMP as time)<='7:02:00' ORDER BY _TIMESTAMP DESC; ";

}
$res=[];
$stmt = sqlsrv_query( $conn, $sql);
do {
    while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
        $item=$row['_VALUE']+rand(1,2);
        
        array_push($data,$item);
    
    }
} while (sqlsrv_next_result($stmt));



echo json_encode($data);

?>
