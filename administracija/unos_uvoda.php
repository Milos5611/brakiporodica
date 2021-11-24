<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();
adminHeader("PODE&#352;AVANJA - Unos uvoda",100);    

prazanRed();

$grupa=$_REQUEST[grupa];
if (!$grupa) $grupa=0;

$v=new uvod($grupa);


$f=new adminForma("Promena uvoda - ".$v->naziv,"forma0","unos_uvoda1.php",500,120);
$f->hidden("grupa",$v->grupa);

$f->pocetakGrupe("OSNOVNI PODACI",1);
$f->textField("Naslov","naslov",$v->naslov,35,50,1);
$f->prazanRed(2);
$f->textArea2("Tekst","tekst",$v->tekst,1,50,10);
$f->prazanRed(2);
$f->krajGrupe();
                                    

$f->kraj();
prazanRed();

adminFooter();
dbDisconnect();
?>