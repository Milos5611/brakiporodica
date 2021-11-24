<?php
include("../include/aplikacija.h.php");
dbConnect();

$id=$_REQUEST['id'];
$strana=$_REQUEST['strana'];
$grupa=$_REQUEST['grupa'];
$podgrupa=$_REQUEST['podgrupa'];

$v=new clanak($id);
$v->brisanje();
dbDisconnect();

$link="pregled.php?strana=".$strana."&grupa=".$grupa."&podgrupa=".$podgrupa;
header("Location: ".$link);
?>