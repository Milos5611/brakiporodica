<?php
include("../include/aplikacija.h.php");  
include("../include/admin.h.php");
dbConnect();
adminHeader("PODE&#352;AVANJA - Promena lozinke",100);

prazanRed();

$f=new adminForma("PROMENA LOZINKE","forma0","promena_lozinke1.php",400,150);
$f->pocetakGrupe("OSNOVNI PODACI",1);
$f->passwordField("Nova lozinka","pass","",20,20,1);
$f->passwordField("Ponovo nova lozinka","pass2","",20,20,1);
$f->krajGrupe();
$f->kraj();


adminFooter();
dbDisconnect();
?>