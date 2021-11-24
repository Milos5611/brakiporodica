<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();

$grupa=$_REQUEST['grupa'];
$podgrupa=$_REQUEST['podgrupa'];

if (!$grupa) $grupa=defaultGrupa();
if (!$podgrupa) $podgrupa=defaultPodgrupa($grupa);

$g=new grupa($grupa);
$p=new podgrupa($podgrupa);

adminHeader("&#268;LANCI - ".$g->naziv." - ".$p->naziv,$grupa);
prazanRed();

adminNaslov("&#268;LANCI");
adminLink("- Unos novog clanka","unos_clanka.php?grupa=".$g->id."&podgrupa=".$p->id);
prazanRed(2);



 
$query="select * from ".TAB_CLANCI." where parent=".$p->id;

$strana=$_REQUEST[strana];
if (!$strana) $strana=1;
$lim=($strana-1)*ADMIN_MAX_CLANAKA;

$order=" order by stamp_unosa desc";
$limit=" limit ".$lim.",".ADMIN_MAX_CLANAKA;

$qb=new query($query);
$q=new query($query.$order.$limit);

$l=new adminLista(0,"&#268;LANCI: ".$g->naziv." / ".$p->naziv,array("Naslov","Grupa / Podgrupa","Datum"),array(350,200,120),array("left","left","right"),LISTA_ICO_DA,LISTA_BRISANJE_DA,LISTA_SELEKTOR_DA);

$l->br_rezultata=$qb->rows;
$l->max_rezultata=ADMIN_MAX_CLANAKA;
$l->strana=$strana;

$i=0;
while ($i<$q->rows)
{
  $v=new clanak($q->row[0]);
  if ($v->aktivno) $ico="icoListaDoc.gif";
  else $ico="icoListaDocBlok.gif";

  $link="brisanje_clanka.php?id=".$v->id;
  if ($strana) $link.="&strana=".$strana;
  $link.="&grupa=".$grupa."&podgrupa=".$podgrupa;
  
  $l->stavka(array($v->naslov,$g->naziv." / ".$p->naziv,stampUDatum($v->stamp_unosa)),"unos_clanka.php?id=".$v->id."&grupa=".$grupa."&podgrupa=".$podgrupa,$link,$ico);
  unset($ico,$v,$link);
  $q->fetchRow();
  $i++;
}
$l->kraj();
unset($q,$qb,$i); 
 
 
 


adminFooter();
dbDisconnect();
?>