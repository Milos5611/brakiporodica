<?php
include("../include/aplikacija.h.php");
dbConnect();

$id=$_REQUEST[id];
$parent=$_REQUEST[parent];
$v=new podgrupa($id);
$v->brisanje();
dbDisconnect();

$link="unos_grupe.php?id=".$parent;
header("Location: ".$link);
?>