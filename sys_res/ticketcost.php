<?php
if(!empty($_GET['id'])){
include("../lib/conn.php");
$sql="SELECT ticket_cost FROM doctor WHERE id='$_GET[id]'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
echo $row["ticket_cost"];	
}

?>