<?php
include("../include/aplikacija.h.php");

dbConnect();
$id=$_REQUEST['id'];
$indeks=$_REQUEST['indeks'];
$v=new vest($id);
$v->slike[$indeks]->brisanje();
dbDisconnect();
header("Location: unos_vesti.php?id=".$v->id);
?>