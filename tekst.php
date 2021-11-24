<?php
include("include/aplikacija.h.php");
dbConnect();

$id=$_REQUEST['id'];
if (!$id)
{
  dbDisconnect();  
  header("Location: index.php");  
  exit;
}

$v=new clanak($id);
$podgrupa=$v->parent;
$q_g=new query("select parent from ".TAB_PODGRUPE." where id='".$podgrupa."'");
$grupa=$q_g->row[0];

appHeader($grupa,$podgrupa);

echo "
<table border='0' cellpadding='0' cellspacing='0' id='tabDetalji'>
  <tr>
    <td>
      <table width='100%' border='0' cellpadding='0' cellspacing='0' id='tabDetaljiNaslov'>
        <tr>
          <td class='tabDetaljiNaslovTdNaslov'>".$v->naslov."</td>
          <td class='tabDetaljiNaslovTdDatum'>".stampUDatum2($v->stamp_unosa)."</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class='tabListaSep'></td>
  </tr>
  <tr>
    <td class='tabDetaljiSep2'>&nbsp;</td>
  </tr>
  <tr>
    <td class='tekst'>
"; 
    
if ($v->slike[1]->naziv) echo "<a href='".$v->slike[1]->path.$v->slike[1]->naziv."' class='galerija'><img src='".$v->slike[1]->path.$v->slike[1]->naziv_srednja."' width='".$v->slike[1]->srednja_sirina."' height='".$v->slike[1]->srednja_visina."' class='detaljiSlika' border='0' align='right' /></a>";    
    
echo nl2br($v->tekst); 
    

    
echo "</td>
  </tr>
  <tr>
    <td class='tabDetaljiSep2'>&nbsp;</td>
  </tr>
";

if ($v->povezani1)
{
  echo "
  <tr>
    <td>
      <table width='100%' border='0' cellpadding='0' cellspacing='0' class='tabSlicanClanak' id='tabSlicanClanak'>
        <tr>
          <td class='tabSlicanClanakTdSep'>&nbsp;</td>
          <td class='tabSlicanClanakTdStrelica'><img src='img/detalji_ico.gif' /></td>
          <td class='tabSlicanClanakTdTekst'><a href='tekst.php?id=".$v->povezani1."'>Slican clanak</a></td>
        </tr>
      </table>
    </td>
  </tr>
  ";
}

echo "  
</table>
";


appFooter($grupa);
dbDisconnect();
?>