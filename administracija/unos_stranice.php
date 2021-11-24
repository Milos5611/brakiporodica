<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();
adminHeader("PODE&#352;AVANJA - Unos stranice",100);    

prazanRed();

$id=$_REQUEST[id];
$v=new stranica($id);


$f=new adminForma("Promena stranice - ".$v->naziv,"forma0","unos_stranice1.php",700,120);
$f->hidden("id",$id);

$f->pocetakGrupe("OSNOVNI PODACI",1);
$f->textField("Naslov","naslov",$v->naslov,40,100,1);
$f->prazanRed(2);
$f->textArea("Tekst","tekst",$v->tekst,0,70,35);
$f->prazanRed(2);
$f->krajGrupe();

$i=1;
while ($i<=MAX_SLIKA_PO_STRANICI)
{
  if ($v->slike[$i]->naziv) $otvoreno=1;
  else $otvoreno=0;
  $f->pocetakGrupe("SLIKA ".$i,$otvoreno);
  $f->slika("Slika ".$i,"slika".$i,SL_STRANICA,$v->id,$i,"brisanje_slike_stranice.php?id=".$v->id."&indeks=".$i,0);
  unset($otvoreno);
  $f->krajGrupe();
  $i++;
}                                    

$f->kraj();
prazanRed();

adminFooter();
dbDisconnect();
?>