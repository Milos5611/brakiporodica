<?php
include("../include/aplikacija.h.php");

dbConnect();
$id=$_REQUEST['id'];
$indeks=$_REQUEST['indeks'];

$v=new stranica($id);
$v->slike[$indeks]->brisanje();
dbDisconnect();
header("Location: unos_stranice.php?id=".$v->id);
?>