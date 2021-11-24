<?php
include("../include/aplikacija.h.php");

dbConnect();
$id=$_REQUEST['id'];
$grupa=$_REQUEST['grupa'];
$podgrupa=$_REQUEST['podgrupa'];
$indeks=$_REQUEST['indeks'];

$v=new clanak($id);
$v->slike[$indeks]->brisanje();
dbDisconnect();
header("Location: unos_clanka.php?id=".$v->id."&grupa=".$grupa."&podgrupa=".$podgrupa);
?>