<?php
include("include/aplikacija.h.php");
dbConnect();

$grupa=101;
$podgrupa=0;

appHeader($grupa,$podgrupa);


echo "
          <table width='100%' border='0' cellpadding='0' cellspacing='0' id='tabLista'>

";



$strana=$_REQUEST[strana];
if (!$strana) $strana=1;
$lim=($strana-1)*MAX_VESTI;


$query="select id from ".TAB_VESTI." where aktivno=1";
if ($podgrupa) $query.=" and parent='".$podgrupa."'";


$order=" order by stamp_unosa desc";
$limit=" limit ".$lim.",".MAX_VESTI;


$qb=new query($query);
$q=new query($query.$order.$limit);

$i=0;
while ($i<$q->rows)
{
  $v=new vest($q->row[0]);
  echo "
            <tr>
              <td> 
              <table width='100%' border='0' cellpadding='0' cellspacing='0' class='tabListaPre'>
                <tr>
  ";
  
      
  if ($v->slike[1]->naziv) echo "<td align='left' valign='top' class='tabListaPreTdSlika'><div class='divListaPreSlika'><img src='".$v->slike[1]->path.$v->slike[1]->naziv_mala."' width='".$v->slike[1]->mala_sirina."' height='".$v->slike[1]->mala_visina."' class='preSlika' border='0' /></div></td>";
  
  echo "                
                  <td valign='top' class='tabListaPreTdTekst'>
                  <span class='naslov'>".$v->naslov."</span><br />
                  <span class='tekst'>".$v->tekst_kratki."</span><br />
                  <div class='divListaProcitaj'><table border='0' cellpadding='0' cellspacing='0'><tr><td><a href='vest.php?id=".$v->id."'><img src='img/lista_ico.gif' border='0' /></a></td>
                  <td class='procitaj'><a href='vest.php?id=".$v->id."'>Pro&#269;itaj vest</a></td></tr></table></div>
                  </td>
                </tr>
              </table>   
              
              </td>
            </tr>
            <tr>
              <td class='tabListaSep2'></td>
            </tr>
  ";

  if ($i<(MAX_VESTI-1))
  {
    echo "
            <tr>
              <td class='tabListaSep'></td>
            </tr>
            <tr>
              <td class='tabListaSep3'></td>
            </tr>
    ";   
  }

  unset($v);
  $q->fetchRow();
  $i++;
}

$sel=new selektor();
$sel->br_rezultata=$qb->rows;
$sel->max_rezultata=MAX_VESTI;
$sel->strana=$strana;
$sel->dodajPromenjivu("podgrupa",$podgrupa);




echo "
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
";

$sel->ispis();

echo "              
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
"; 


appFooter($grupa);
dbDisconnect();
?>