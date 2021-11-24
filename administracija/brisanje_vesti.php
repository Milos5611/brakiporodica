<?php
include("../include/aplikacija.h.php");
dbConnect();

$id=$_REQUEST['id'];
$strana=$_REQUEST['strana'];
if (!$strana) $strana=1;


$v=new vest($id);
$v->brisanje();
dbDisconnect();

$link="vesti.php";
$link.="?strana=".$strana;

header("Location: ".$link);
?>