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

$v=new stranica($id);
$grupa=200+$v->id;

//$podgrupa=$v->parent;
//$q_g=new query("select parent from ".TAB_PODGRUPE." where id='".$podgrupa."'");
//$grupa=$q_g->row[0];

appHeader($grupa,$podgrupa);

echo "
<table border='0' cellpadding='0' cellspacing='0' class='tabStranica'>
  <tr>
    <td class='tabStranicaNaslov'>".$v->naslov."</td>
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


echo "  
</table>
";


appFooter($grupa);
dbDisconnect();
?>