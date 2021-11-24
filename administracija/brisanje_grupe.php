<?php
include("../include/aplikacija.h.php");
dbConnect();

$id=$_REQUEST[id];
$v=new grupa($id);
$v->brisanje();
dbDisconnect();

$link="grupe.php";
header("Location: ".$link);
?>