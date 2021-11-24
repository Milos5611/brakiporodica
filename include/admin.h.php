<?php
//*****************************************************************************************
//  Glavni header file za administraciju
//  
//  Skara 2009.
//*****************************************************************************************

if (!defined("Admin_H_PHP")):
define("Admin_H_PHP",true);  

//-----------------------------------------------------------------------------------------
function adminHeader($naslov,$stavka)
{
  echo "
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>".$naslov."</title>
<link href='../include/admin.css' rel='stylesheet' type='text/css' />

<script language='javascript'>
function promenaStavkeLevogMenija(stavka)
{
  var objekat=eval('leviMeniStavka'+stavka);
  var isIE=false;
  if (document.all) isIE=true;

  if (objekat.style.display=='block' || objekat.style.display=='table-cell')
  {
    objekat.style.display='none';
  }
  else
  {
    if (isIE) objekat.style.display='block';
    else objekat.style.display='table-cell';
  }
}

function otvaranjeStavkeLevogMenija(stavka)
{
  var objekat=eval('leviMeniStavka'+stavka);
  var isIE=false;
  if (document.all) isIE=true;

  if (isIE) objekat.style.display='block';
  else objekat.style.display='table-cell';  
}

function zatvaranjeStavkeLevogMenija(stavka)
{
  var objekat=eval('leviMeniStavka'+stavka);
  var isIE=false;
  if (document.all) isIE=true;

  objekat.style.display='none';  
}

function resetLevogMenija(stavka)
{
";

$q_grupe=new query("select id from ".TAB_GRUPE." where id>0 order by prioritet desc, naziv");
for ($i=0; $i<$q_grupe->rows; $i++)
{
  $v=new grupa($q_grupe->row[0]);
  echo "  var leviMeniStavka".$v->id."=document.getElementById('leviMeniStavka".$v->id."');\n";
  $q_grupe->fetchRow();
}
unset($q_grupe);  
  
echo "  
  var leviMeniStavka99=document.getElementById('leviMeniStavka99');
  var leviMeniStavka100=document.getElementById('leviMeniStavka100');
";

$q_grupe=new query("select id from ".TAB_GRUPE." where id>0 order by prioritet desc, naziv");
for ($i=0; $i<$q_grupe->rows; $i++)
{
  $v=new grupa($q_grupe->row[0]);
  echo "  leviMeniStavka".$v->id.".style.display='none';\n";
  $q_grupe->fetchRow();
}
unset($q_grupe);  

echo "
  leviMeniStavka99.style.display='none'; 
  leviMeniStavka100.style.display='none'; 
  
  var objekat=eval('leviMeniStavka'+stavka);  
  var isIE=false;
  if (document.all) isIE=true;
  if (isIE) objekat.style.display='block';
  else objekat.style.display='table-cell';   
 
}

function grupaIcoPreload()
{
  var ico_on=new Image();
  var ico_off=new Image();
  ico_on.src=\"../img/admin/formaGrupaOn.gif\";
  ico_off.src=\"../img/admin/formaGrupaOff.gif\";  
}
grupaIcoPreload();

function postavljanjeGrupeForme(grupa,stanje)
{
  var tdGrupe=document.getElementById(grupa);
  var sid=grupa+'_slika';
  var grupaSlika=document.getElementById(sid);   
  var isIE=false;
  if (document.all) isIE=true;  
  if (stanje)
  {
	  grupaSlika.src=\"../img/admin/formaGrupaOn.gif\";	   
    if (isIE)
	  {
	    tdGrupe.style.display='block';
	  }  
    else
	  {
	    tdGrupe.style.display='table-cell'; 
	  }
  }
  else
  {
	grupaSlika.src=\"../img/admin/formaGrupaOff.gif\";
    tdGrupe.style.display='none'; 
  }
}

function promenaStanjaGrupeForme(grupa)
{
  var tdGrupe=document.getElementById(grupa);
  var sid=grupa+'_slika';
  var grupaSlika=document.getElementById(sid);
  var isIE=false;
  if (document.all) isIE=true; 

  if (tdGrupe.style.display=='block' || tdGrupe.style.display=='table-cell')
  {
	  grupaSlika.src=\"../img/admin/formaGrupaOff.gif\";
    tdGrupe.style.display='none';
  }
  else
  {
	  grupaSlika.src=\"../img/admin/formaGrupaOn.gif\";
    if (isIE) tdGrupe.style.display='block';
    else tdGrupe.style.display='table-cell';
  }
}

function brisanjeStavke(naziv)
{
  if (confirm('Obrisi: '+naziv+'?')) return true;  
  else return false;
}

function brisanjeSlike()
{
  if (confirm('Obrisi sliku?')) return true;  
  else return false;
}

function listaMisOver(lista,red,br_kolona,stil)
{
  var i=0;
  while (i<br_kolona)
  {
    var kolona=document.getElementById('kolona_'+lista+'_'+red+'_'+i);   
    if (i==0) kolona.className='listaKolonaOverLevo';
	  else if (i==(br_kolona-1)) kolona.className='listaKolonaOverDesno';
	  else kolona.className='listaKolonaOver';
    i++;
  }
}

function listaMisOut(lista,red,br_kolona,stil)
{
  var i=0;
  while (i<br_kolona)
  {
    var kolona=document.getElementById('kolona_'+lista+'_'+red+'_'+i);   
    if (stil==0) kolona.className='listaKolona';
  	else kolona.className='listaKolona2';
    i++;
  }
}

</script>

</head>

<body>
<table width='1000' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#fafafa' id='tabVelika'>
  <tr>
    <td width='10' height='12' background='../img/admin/prelazLevo1.gif'></td>
    <td height='12' background='../img/admin/bgHeader1.gif'></td>
    <td width='10' height='12' background='../img/admin/prelazDesno1.gif'></td>
  </tr>
  <tr>
    <td width='10' height='32' background='../img/admin/prelazLevo2.gif'></td>
    <td height='32' background='../img/admin/bgHeader2.gif'><table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='150'>&nbsp;</td>
        <td width='119'><img src='../img/admin/header1.gif' width='119' height='32' /></td>
        <td><div align='center'>&nbsp;</div></td>
        <td width='119'><img src='../img/admin/header2.gif' width='119' height='32' /></td>
        <td width='150'>&nbsp;</td>
      </tr>
    </table></td>
    <td width='10' height='32' background='../img/admin/prelazDesno2.gif'></td>
  </tr>
  <tr>
    <td height='6' background='../img/admin/prelazLevo3.gif'></td>
    <td height='6' background='../img/admin/bgHeader3.gif'></td>
    <td height='6' background='../img/admin/prelazDesno3.gif'></td>
  </tr>
  <tr>
    <td height='26' background='../img/admin/prelazLevo4.gif'></td>
    <td height='26' background='../img/admin/bgHeader4.gif'>&nbsp;</td>
    <td height='26' background='../img/admin/prelazDesno4.gif'></td>
  </tr>
  <tr>
    <td height='27' background='../img/admin/prelazLevo5.gif'></td>
    <td height='27' background='../img/admin/bgHeader5.gif'><table border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='16' height='27' class='gornjiMeni'><img src='../img/admin/gornjiMeniSep.gif' width='16' height='27' /></td>
  ";

  $q_grupe=new query("select id from ".TAB_GRUPE." where id>0 order by prioritet desc, naziv");
  for ($i=0; $i<$q_grupe->rows; $i++)
  {
    $v=new grupa($q_grupe->row[0]);
    echo "<td height='27' class='gornjiMeni'><a href='pregled.php?grupa=".$v->id."'>".$v->naziv."</a></td>";
    echo "<td width='16' height='27' class='gornjiMeni'><img src='../img/admin/gornjiMeniSep.gif' width='16' height='27' /></td>";
    $q_grupe->fetchRow();
  }
  unset($q_grupe);

  echo " 
        <td class='gornjiMeni'><a href='vesti.php'>Vesti</a></td>
        <td width='16' height='27' class='gornjiMeni'><img src='../img/admin/gornjiMeniSep.gif' width='16' height='27' /></td>        
   		<td class='gornjiMeni'><a href='podesavanja.php'>Pode&#353;avanja</a></td>
        <td width='16' height='27' class='gornjiMeni'><img src='../img/admin/gornjiMeniSep.gif' width='16' height='27' /></td>        
        <td class='gornjiMeni'>&nbsp;</td>
      </tr>
    </table></td>
    <td height='27' background='../img/admin/prelazDesno5.gif'></td>
  </tr>
  <tr>
    <td width='10' height='8' background='../img/admin/prelazLevo6.gif'></td>
    <td height='8' background='../img/admin/bgHeader6.gif'></td>
    <td width='10' height='8' background='../img/admin/prelazDesno6.gif'></td>
  </tr>
  
  
  <tr>
    <td width='10' background='../img/admin/prelazLevo.gif'></td>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='160' valign='top' class='leviMeniTd'>
		<table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td height='50'>&nbsp;</td>
          </tr>
  ";
  
  

  // GRUOPE I PODGRUPE
  $q_grupe=new query("select id from ".TAB_GRUPE." where id>0 order by prioritet desc, naziv");
  for ($i=0; $i<$q_grupe->rows; $i++)
  {
    $v=new grupa($q_grupe->row[0]);
  	echo "
          <tr>
            <td height='16' class='leviMeni'><a href='javascript:void(0)' onClick='promenaStavkeLevogMenija(".$v->id.")'>".$v->naziv."</a></td>
          </tr>  
          <tr>
            <td id='leviMeniStavka".$v->id."'>
			  <table width='100%'>
	";

  	$q_podgrupe=new query("select id from ".TAB_PODGRUPE." where parent='".$v->id."' order by prioritet desc, naziv");
  	for ($j=0; $j<$q_podgrupe->rows; $j++)
  	{
  	  $vv=new podgrupa($q_podgrupe->row[0]);  	
  	  echo "<tr><td height='16' class='leviMeni1'><a href='pregled.php?grupa=".$v->id."&podgrupa=".$vv->id."'>".$vv->naziv."</a></td></tr>";
  	  $q_podgrupe->fetchRow();
  	  unset($vv);
  	}                
 							
    echo "         
                <tr><td height='6'></td></tr>						 								
			  </table>
		  	</td>
          </tr>  
  	";  
    
    $q_grupe->fetchRow();
    unset($v);
  }
  unset($q_grupe);  
  
  
  


   // VESTI
   echo "
          <tr>
            <td height='16' class='leviMeni'><a href='javascript:void(0)' onClick='promenaStavkeLevogMenija(99)'>Vesti</a></td>
          </tr>  
          <tr>
            <td id='leviMeniStavka99'>
              <table width='100%'>
                <tr><td height='16' class='leviMeni1'><a href='vesti.php'>Pregled vesti</a></td></tr>
                <tr><td height='16' class='leviMeni1'><a href='unos_vesti.php'>Unos vesti</a></td></tr>
                <tr><td height='6'></td></tr>                                                         
              </table>
              </td>
          </tr>  
   ";  
   
     
  
   // PODESAVANJA
   echo "
          <tr>
            <td height='16' class='leviMeni'><a href='javascript:void(0)' onClick='promenaStavkeLevogMenija(100)'>Pode&#353;avanja</a></td>
          </tr>  
          <tr>
            <td id='leviMeniStavka100'>
              <table width='100%'>
    ";
                  
   // echo "      <tr><td height='16' class='leviMeni1'><a href='grupe.php'>Grupe / Podgrupe</a></td></tr>";
    
    $q_u=new query("select grupa from ".TAB_UVODI." where id>0 order by grupa");
    for ($i_u=0; $i_u<$q_u->rows; $i_u++)
    {
      $v=new uvod($q_u->row[0]);
      echo "<tr><td height='16' class='leviMeni1'><a href='unos_uvoda.php?grupa=".$v->grupa."'>Uvod - ".$v->naziv."</a></td></tr>";
      unset($v);
      $q_u->fetchRow();    
    }
    echo "<tr><td height='6'></td></tr>";
    
    
    $q_s=new query("select id from ".TAB_STRANICE." where id>0 order by id");
    for ($i_s=0; $i_s<$q_s->rows; $i_s++)
    {
      $s=new stranica($q_s->row[0]);      
      echo "<tr><td height='16' class='leviMeni1'><a href='unos_stranice.php?id=".$s->id."'>Stranica - ".$s->naziv."</a></td></tr>";
      $q_s->fetchRow();
      unset($s);
    }
    echo "<tr><td height='6'></td></tr>";      
    
    
    echo "
                <tr><td height='16' class='leviMeni1'><a href='promena_lozinke.php'>Promena lozinke</a></td></tr>
                <tr><td height='6'></td></tr>                                                         
              </table>
              </td>
          </tr>  
  ";                                                  
  
  
  echo "  
  <script language='javascript'>
  resetLevogMenija(".$stavka.");
  </script>
  ";
  
  echo "		  
          <tr>
            <td height='20'>&nbsp;</td>
          </tr>
          <tr>
            <td height='20'>&nbsp;</td>
          </tr>
        </table>
		</td>
  ";

  echo "
        <td width='20'>&nbsp;</td>		
        <td height='400' valign='top'>
  ";
}
//-----------------------------------------------------------------------------------------
function adminFooter($panel=0)
{
  echo "</td>";
  
  if ($panel==0) echo ""; // <td width='200' valign='top'></td>
  
  echo "		
      </tr>
    </table></td>
    <td width='10' background='../img/admin/prelazDesno.gif'></td>
  </tr>
  <tr>
    <td height='25' background='../img/admin/prelazLevo9.gif'></td>
    <td height='25' background='../img/admin/bgFooter5.gif'>&nbsp;</td>
    <td height='25' background='../img/admin/prelazDesno9.gif'></td>
  </tr>
  <tr>
    <td height='25' background='../img/admin/prelazLevo8.gif'></td>
    <td height='25'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td height='25' align='right' valign='top' background='../img/admin/bgFooter4.gif'><img src='../img/admin/footer3.gif' width='470' height='18' /></td>
        <td width='120' height='25' background='../img/admin/bgFooter3.gif'>&nbsp;</td>
        <td width='200' height='25' background='../img/admin/bgFooter2.gif'><div align='right'><img src='../img/admin/footer.gif' width='120' height='25' /></div></td>
      </tr>
    </table></td>
    <td height='25' background='../img/admin/prelazDesno8.gif'></td>
  </tr>
  <tr>
    <td width='10' height='20' background='../img/admin/prelazLevo10.gif'></td>
    <td height='20' background='../img/admin/bgFooter6.gif'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
";

  $q_grupe=new query("select id from ".TAB_GRUPE." where id>0 order by prioritet desc, naziv");
  for ($i=0; $i<$q_grupe->rows; $i++)
  {
    $v=new grupa($q_grupe->row[0]);
    echo "<td width='10' height='20' class='donjiMeni'><div align='center'><a href='pregled.php?grupa=".$v->id."'>".str_replace(" ","&nbsp;",$v->naziv)."</a></div></td>";
    echo "<td width='10' height='20' class='donjiMeni'><div align='center'>|</div></td>";
    $q_grupe->fetchRow();
  }
  unset($q_grupe);
  
echo "      
        <td width='10' height='20' class='donjiMeni'><div align='center'><a href='vesti.php'>Vesti</a></div></td>
        <td width='10' height='20' class='donjiMeni'><div align='center'>|</div></td>
        <td width='10' height='20' class='donjiMeni'><div align='center'><a href='podesavanja.php'>Poda&#353;avanja</a></div></td> 

        
        <td height='20'><div align='right'><img src='../img/admin/footer1.gif' width='120' height='20' /></div></td>
      </tr>
    </table></td>
    <td width='10' height='20' background='../img/admin/prelazDesno10.gif'></td>
  </tr>
  <tr>
    <td width='10' height='24' background='../img/admin/prelazLevo7.gif'></td>
    <td height='24' background='../img/admin/bgFooter1.gif'><div align='right'><img src='../img/admin/footer2.gif' width='62' height='24' /></div></td>
    <td width='10' height='24' background='../img/admin/prelazDesno7.gif'></td>
  </tr>
</table>

</body>
</html>
  
  ";
}
//-----------------------------------------------------------------------------------------
function adminNaslov($naslov)
{
  echo "<table><tr><td class='naslov' height='30'>".$naslov."</td></tr></table>";
}
//-----------------------------------------------------------------------------------------
function adminIspis($sadrzaj)
{
	if (!$sadrzaj) return;
  echo "<table><tr><td class='podatak' height='16'>".$sadrzaj."</td></tr></table>";
}
//-----------------------------------------------------------------------------------------
function adminLink($tekst,$link)
{
  echo "<table><tr><td class='adminLink' height='16'><a href='".$link."'>".$tekst."</a></td></tr></table>";
}
//-----------------------------------------------------------------------------------------
function adminLinkBack($tekst)
{
  echo "<table><tr><td class='adminLink' height='16'><a href='#' onClick=\"history.back()\">".$tekst."</a></td></tr></table>";
} 
//----------------------------------------------------------------------------------------
function adminStatusBar($sadrzaj)
{
  echo "
    <script language='javascript'>
    window.status='$sadrzaj'; 
    </script>
  ";
}
//-----------------------------------------------------------------------------------------
// ****************************************************************************************
//-----------------------------------------------------------------------------------------
class adminForma
{
  var $naslov;
  var $naziv;
  var $sirina;
  var $link;
  var $sirina_levo;
  var $obavezni_nazivi;
  var $obavezni_naslovi;
  var $br_obaveznih_unosa;
  var $br_grupa;
  
    
  //---------------------------------------------------------------------------------------
  function adminForma($naslov,$naziv,$link,$sirina=450,$sirina_levo=120)
  {
    $this->naslov=$naslov;
    $this->naziv=$naziv;
    $this->link=$link;
    $this->sirina=$sirina;
    $this->sirina_levo=$sirina_levo;
  	$this->br_grupa=0;
    $this->obavezni_nazivi=array();
    $this->obavezni_naslovi=array();
	  $this->br_obaveznih_unosa=0;	
	
  
    echo "
    <form action='".$this->link."' method='post' enctype='multipart/form-data'>	
    <table width='".$this->sirina."' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td>
          <table width='100%' border='0' cellpadding='0' cellspacing='0' class='tabFormaHeader'>
            <tr>
              <td height='40' class='formaNaslov'><div align='center'>".$this->naslov."</div></td>
            </tr>
            <tr>
              <td height='16'>&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>	
	  ";

  }
  //---------------------------------------------------------------------------------------
  function pocetakGrupe($naslov="",$otvoreno=1)
  {  
    echo "
	  <tr>
      <td class='tdFormaGrupa'>
        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='10'></td>
            <td width='30'><a href='javascript:void(0)' onClick='promenaStanjaGrupeForme(\"".$this->naziv."_grupa_".$this->br_grupa."\")'><img id='".$this->naziv."_grupa_".$this->br_grupa."_slika' width='20' height='20' border='0'></a></td>
            <td class='formaGrupa'>::: ".$naslov." :::</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td id='".$this->naziv."_grupa_".$this->br_grupa."'>
        <table width='100%' border='0' cellpadding='0' cellspacing='0' class='tabFormaGrupa'>
          <tr>
		        <td height='20' colspan='3'>&nbsp;</td>
		      </tr>
	";

	echo "
    <script language='javascript'>
    postavljanjeGrupeForme(\"".$this->naziv."_grupa_".$this->br_grupa."\",".$otvoreno.");
    </script>	
	";

	$this->br_grupa++;
  } 
  //---------------------------------------------------------------------------------------
  function krajGrupe()
  {
     echo "
        <tr>
	        <td height='20' colspan='3'>&nbsp;</td>	 
	      </tr>
	    </table>
      </td>
    </tr>	 
    "; 
  }
  //---------------------------------------------------------------------------------------
  function prazanRed($br_redova=1)
  {
     $i=0;
	 while ($i<$br_redova)
	 {
	   echo "<tr><td colspan='3' height='10'></tr>"; 
	   $i++;
	 }
  }
  //---------------------------------------------------------------------------------------
  function hidden($naziv,$vrednost)
  {
     echo "<input type='hidden' name='".$naziv."' value='".$vrednost."'>";
  }
  //---------------------------------------------------------------------------------------
  function podnaslov($naslov)
  {
    echo "
        <tr>
          <td height='24' colspan='3' class='formaPodnaslov'><div align='center'>".$naslov."</div></td>
        </tr>
    ";
  }  
  //---------------------------------------------------------------------------------------
  function podatak($naslov,$vrednost)
  {
    echo "
        <tr>
          <td width='".$this->sirina_levo."' class='podatak'><div align='right'>".$naslov.":</div></td>
          <td width='10'>&nbsp;</td>
          <td width='".($this->sirina-$this->sirina_levo)."' class='vrednost'><div align='left'>".$vrednost."</div></td>
        </tr>
    ";
  }  
  //---------------------------------------------------------------------------------------
  function napomena($vrednost,$zvezdica=0)
  {
    echo "<tr><td colspan='3' class='vrednost'><div align='center'>";
    if ($zvezdica) echo "<span class='zvezdica'>*</span>";
    echo $vrednost."</div></td></tr>";
  }    
  //----------------------------------------------------------------------------------   
  function textField($naslov,$naziv,$vrednost,$velicina=20,$max_velicina=30,$obavezno=0,$dodatni_tekst="")
  {
    echo "
    <tr>
      <td height='20' width='".$this->sirina_levo."' class='podatak'><div align='right'>
  	";  
	  if ($obavezno) echo "<span class='zvezdica'>*</span>";
	  echo $naslov.":</div></td>
      <td width='10'>&nbsp;</td>
      <td width='".($this->sirina-$this->sirina_levo)."' class='vrednost'><input id='".$naziv."' name='".$naziv."' type='text' class='textField' size='".$velicina."' maxlength='".$max_velicina."'
	  "; 
	  if ($vrednost) echo " value='".$vrednost."'";
	  echo ">";
	  if ($dodatni_tekst) echo "&nbsp;".$dodatni_tekst;
	  echo "
	    </td>
    </tr>  
    ";
	  if ($obavezno)
  	{
	    $this->br_obaveznih_unosa++;
	    $this->obavezni_nazivi[$this->br_obaveznih_unosa]=$naziv;
	    $this->obavezni_naslovi[$this->br_obaveznih_unosa]=$naslov;
	  }
  }
  //----------------------------------------------------------------------------------   
  function passwordField($naslov,$naziv,$vrednost,$velicina=20,$max_velicina=30,$obavezno=0,$dodatni_tekst="")
  {
    echo "
    <tr>
      <td height='20' width='".$this->sirina_levo."' class='podatak'><div align='right'>
  	";  
	  if ($obavezno) echo "<span class='zvezdica'>*</span>";
	  echo $naslov.":</div></td>
      <td width='10'>&nbsp;</td>
      <td width='".($this->sirina-$this->sirina_levo)."' class='vrednost'><input id='".$naziv."' name='".$naziv."' type='password' class='textField' size='".$velicina."' maxlength='".$max_velicina."'
	  "; 
	  if ($vrednost) echo " value='".$vrednost."'";
	  echo ">";
	  if ($dodatni_tekst) echo "&nbsp;".$dodatni_tekst;
	  echo "
	    </td>
    </tr>  
    ";
	  if ($obavezno)
  	{
	    $this->br_obaveznih_unosa++;
	    $this->obavezni_nazivi[$this->br_obaveznih_unosa]=$naziv;
	    $this->obavezni_naslovi[$this->br_obaveznih_unosa]=$naslov;
	  }
  }  
  //---------------------------------------------------------------------------------------
  function selectPocetak($naslov,$naziv,$obavezno=0)
  {
    echo "<tr><td height='20' width='".$this->sirina_levo."' class='podatak'><div align='right'>";
    if ($obavezno) echo "<span class='zvezdica'>*</span>";
    echo $naslov;
    echo ":</div></td><td width='10'>&nbsp;</td><td width='".($this->sirina-$this->sirina_levo)."' class='podatak'><div align='left'><select name='".$naziv."' class='list'>";
  }
  
  //--------------------------------------------------------------------------------------
  function selectStavka($naziv,$vrednost,$selektovano=0)
  {
    echo "<option value='".$vrednost."'";
    if ($selektovano) echo " selected";
    echo ">".$naziv."</option>";
  }
  //--------------------------------------------------------------------------------------
  function selectGrupaPocetak($naziv)
  {
    echo "<optgroup label='".$naziv."'>";
  }
  //--------------------------------------------------------------------------------------
  function selectGrupaKraj()
  {
    echo "</optgroup>";
  }
  //--------------------------------------------------------------------------------------
  function selectKraj($dodatni_tekst="")
  {
    echo "</select>";
  	if ($dodatni_tekst) echo "&nbsp;".$dodatni_tekst;
	echo "</div></td></tr>";  
  }
  //--------------------------------------------------------------------------------------  
  function checkbox($naslov,$naziv,$vrednost,$chekirano)
  {
    echo "
        <tr>
          <td width='".$this->sirina_levo."' class='podatak'><div align='right'>&nbsp;</div></td>
          <td width='10'>&nbsp;</td>
          <td width='".($this->sirina-$this->sirina_levo)."' class='podatak'><div align='left'>
            <input type='checkbox' name='".$naziv."' value='".$vrednost."'";
			if ($chekirano) echo " checked";
			echo ">".$naslov." 
          </div></td>
        </tr>
    ";
  } 
  //---------------------------------------------------------------------------------------
  function checkBoxX2($naslov1,$naziv1,$vrednost1,$chekirano1,$naslov2,$naziv2,$vrednost2,$chekirano2,$sirina=150)
  {
    echo "    
  	<tr><td colspan=3'>
	  <table align='center' border='0'>    
		  <tr>
        <td width='10%'>&nbsp;</td>
 	  ";
	  if ($naslov1)
	  {
	    echo "<td width='20'><input name='".$naziv1."' type='checkbox' value='".$vrednost1."' class='checkbox' ";
      if ($chekirano1) echo " checked";
	    echo "></td><td width='".$sirina."' class='podatak'><div align='left'>".$naslov1."</div></td>";
	  } 
	  else
	  {
	    echo "<td width='20'>&nbsp;</td><td width='".$sirina."'>&nbsp;</td>";
	  }
	
	  if ($naslov2)
	  {
	    echo "<td width='20'><input type='checkbox' name='".$naziv2."' value='".$vrednost2."' class='checkbox' ";
      if ($chekirano2) echo " checked";
      echo "></td><td width='".$sirina."' class='podatak'><div align='left'>".$naslov2."</div></td>";
	  }
	  else
	  {
	    echo "<td width='20'>&nbsp;</td><td width='".$sirina."'>&nbsp;</td>";
	  }
	  echo "<td width='20'>&nbsp;</td>
        </tr>
	  </table>
	</td></tr>
    ";
  }
  //---------------------------------------------------------------------------------------  
  function radiobutton($naslov,$naziv,$vrednost,$chekirano)
  {
    echo "
        <tr>
          <td width='".$this->sirina_levo."' class='podatak'><div align='right'>
    ";
    
    echo "<input type='radio' name='".$naziv."' value='".$vrednost."'";
      if ($chekirano) echo " checked";
        echo ">";
    
    echo "         
          </div></td>
          <td width='10'>&nbsp;</td>
          <td width='".($this->sirina-$this->sirina_levo)."' class='podatak'><div align='left'>
    ";  
            
        echo $naslov; 

    echo "</div></td>
        </tr>
    ";
    
  }    
  //---------------------------------------------------------------------------------------
  function textArea($naslov,$naziv,$vrednost,$obavezno=0,$kolona=30,$redova=8)
  {
    echo "
        <tr>
          <td colspan='3'class='podatak'><div align='center'>";
    if ($obavezno) echo "<span class='zvezdica'>*</span>";    
    echo $naslov.":</div></td>
        </tr>
		    <tr>
          <td colspan='3'><div align='center'><textarea name='".$naziv."' id='".$naziv."' cols='".$kolona."' rows='".$redova."' class='textArea'>";

    echo $vrednost;
  	echo "</textarea></div></td>
        </tr>  
    ";
    if ($obavezno)
    {
      $this->br_obaveznih_unosa++;
      $this->obavezni_nazivi[$this->br_obaveznih_unosa]=$naziv;
      $this->obavezni_celi_nazivi[$this->br_obaveznih_unosa]=$naslov;
    }  
  }     
  //---------------------------------------------------------------------------------------
  function textArea2($naslov,$naziv,$vrednost,$obavezno=0,$kolona=30,$redova=4)
  {
    echo "
    <tr>
      <td height='20' width='".$this->sirina_levo."' class='podatak'><div align='right'>
  	";  
	  if ($obavezno) echo "<span class='zvezdica'>*</span>";
	  echo $naslov.":</div></td>
      <td width='10'>&nbsp;</td>
      <td width='".($this->sirina-$this->sirina_levo)."' class='vrednost'>
      <textarea name='".$naziv."' id='".$naziv."' cols='".$kolona."' rows='".$redova."' class='textArea'>"; 

    echo $vrednost;

    echo "</textarea>
	    </td>
    </tr>  
    ";
	  if ($obavezno)
  	{
	    $this->br_obaveznih_unosa++;
	    $this->obavezni_nazivi[$this->br_obaveznih_unosa]=$naziv;
	    $this->obavezni_naslovi[$this->br_obaveznih_unosa]=$naslov;
	  }    
 
  }     
  //---------------------------------------------------------------------------------------
  function slika($naslov,$naziv,$vrsta,$id_objekta,$indeks,$link,$komentar_da=0)
  {
  	if (!$id_objekta) $id_objekta=0;
  	if (!$indeks) $indeks=0;
  	
  	$sl=new slika($vrsta,$id_objekta,$indeks);
  	
  	if ($sl->tip==SLIKA_NARMAL) $dodatak=" ( min: ".$sl->min_sirina."x".$sl->min_visina.", max: ".$sl->max_sirina."x".$sl->max_visina." )";
  	else if ($sl->tip==SLIKA_FIX) $dodatak=" ( ".$sl->max_sirina."x".$sl->max_visina." )";
  	
  	echo "<tr><td height='30' colspan='3' class='formaPodnaslov2'><div align='center'>".$naslov.$dodatak."</div></td></tr>";

  	if ($sl->naziv)
  	{
  	  echo "<tr><td colspan='3'><div align='center'>";
  	  echo "<img src='../".$sl->path.$sl->naziv."' width='".$sl->sirina."' height='".$sl->visina."' border='0' class='formaSlika'>";
  	  echo "</div></td></tr>";
      echo "<tr><td colspan='3' height='24' class='adminLink'><div align='center'><a href='".$link."' onClick='return brisanjeSlike()'>Obri&#353;i sliku</a></div></td></tr>";

      echo "<tr><td colspan='3'>&nbsp;</td></tr>";
      
      echo "
        <tr>
  	      <td height='20' width='".$this->sirina_levo."' class='podatak'><div align='right'>Rezolucija slike:</div></td>
  	      <td width='10'>&nbsp;</td>
          <td class='vrednost'>".$sl->sirina."x".$sl->visina." piksela</td>
	      </tr>
      ";      
      
      echo "
        <tr>
  	      <td height='20' width='".$this->sirina_levo."' class='podatak'><div align='right'>Tip:</div></td>
  	      <td width='10'>&nbsp;</td>
          <td class='vrednost'>".$sl->ext."</td>
	      </tr>
      ";

      echo "
        <tr>
  	      <td height='20' width='".$this->sirina_levo."' class='podatak'><div align='right'>Veli&#269;ina:</div></td>
  	      <td width='10'>&nbsp;</td>
          <td class='vrednost'>".$sl->velicina." kb</td>
	      </tr>
      ";
            
      echo "<tr><td colspan='3'>&nbsp;</td></tr>";     
      
  	}

  	echo "
  	<tr>
  	  <td height='20' width='".$this->sirina_levo."' class='podatak'><div align='right'>Fajl:</div></td>
  	  <td width='10'>&nbsp;</td>
      <td class='vrednost'><input name='".$naziv."' type='file' class='textField' size='30' maxlength='100'></td>
	  </tr>
	  "; 
	
  	if ($komentar_da)
  	{
  	  echo "
      <tr>
        <td height='20' width='".$this->sirina_levo."' class='podatak'><div align='right'>Komentar:</div></td><td width='10'>&nbsp;</td>
        <td class='vrednost'><input name='slika_komentar".$indeks."' type='text' class='textField' size='30' maxlength='255'
	    "; 
	    if ($sl->komentar) echo " value='".$sl->komentar."'";
	    echo "></td></tr>";
	  }
  	
  	unset($sl);
  }
  //-----------------------------------------------------------------------------    

  function kraj()
  {
    echo "
    <script language='javascript'>
    function resetovanje()
    {
      if (confirm('Svi podaci ce biti vraceni u prvobitno stanje! Resetuj formu?')) return true;  
      else return false;
    }

    function submitovanje()
    {
    ";

    $i=1;
	while ($i<=$this->br_obaveznih_unosa)
	{
	  echo "
      var ".$this->obavezni_nazivi[$i]."=document.getElementById(\"".$this->obavezni_nazivi[$i]."\");
      if (!".$this->obavezni_nazivi[$i].".value)
      {
        alert('Nije unet podatak: ".$this->obavezni_naslovi[$i]."!');
        window.status='Nije unet podatak: ".$this->obavezni_naslovi[$i]."!';
		".$this->obavezni_nazivi[$i].".focus();
	    return false;
      }
      ";
	  $i++;
	}
    
	echo "
    return true;
    }
	</script>
    ";
  
    echo "
      <tr>
        <td>
          <table width='100%' border='0' cellpadding='0' cellspacing='0' class='tabFormaFooter'>
            <tr>
              <td height='40'>&nbsp;</td>
            </tr>
            <tr>
              <td>
		        <table width='90%' border='0' align='center' cellpadding='0' cellspacing='0'>
				  <tr>
                    <td width='50%'><div align='left'><input name='reset' type='reset' class='formaButton' value='Reset' onClick='return resetovanje()'></div></td>
                    <td width='50%'><div align='right'><input name='submit' type='submit' class='formaButton' value='Unesi' onClick='return submitovanje()'></div></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
	</form>
	";  
  }
  //---------------------------------------------------------------------------------------
  function kraj2()
  {
    echo "
      <tr>
        <td>
          <table width='100%' border='0' cellpadding='0' cellspacing='0' class='tabFormaFooter'>
            <tr>
              <td height='20'>&nbsp;</td>
            </tr>
            <tr>
              <td>
                <div align='center'><input name='submit' type='submit' class='formaButton' value='Pronadji'></div>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
	</form>
	";   	
  	
  }
  //---------------------------------------------------------------------------------------
};




//-----------------------------------------------------------------------------------------
//*****************************************************************************************
//-----------------------------------------------------------------------------------------


class adminLista
{
  var $id;                   // id liste (redni broj liste na stranici, koristi se za js)
  var $br_kolona;            // broj kolona podataka
  var $ceo_br_kolona;        // broj kolona ukljucujuci i ico,brisanje...
  var $nazivi;               // nazivi kolona
  var $sirine;               // sirine kolona u pixelima
  var $centriranja;          // alajniranje pojedinih polja
  
  var $br_stavki;            // broj stavki u listi
  var $i_stil;               // brojac za stilove stavki

  var $ico;                  // da li lista koristi ikone za stavke
  var $brisanje;             // da li lista koristi ikone za brisanje stavke
  var $selektor;             // da li lista koristi selektor stranica

  var $br_rezultata;         // ukupan broj rezultata u listi
  var $max_rezultata;        // maksimalan broj rezultata po stranici
  var $strana;               // trenutna strana selektora
  var $promenjive;           // niz promenjivih koje se postuju u formi
  var $vrednosti;            // vrednosti tih promenjivih
  var $br_promenjivih;       // brojac tih promenjivih

  //---------------------------------------------------------------------------------------
  function adminLista($id,$naslov,$nazivi,$sirine,$centriranja=null,$ico=0,$brisanje=0,$selektor=0)
  {
    $this->id=$id;
    $this->ico=$ico;
	  $this->brisanje=$brisanje;
	  $this->selektor=$selektor;
	  $this->br_stavki=0;
  	$this->i_stil=0;

	  $this->br_promenjivih=0;
	  $this->promenjive=array();
	  $this->vrednosti=array();
	  
	  $this->nazivi=array();
    $this->sirine=array();
  	$this->centriranja=array();	
  	$this->br_kolona=0;
   	while ($this->br_kolona<sizeof($nazivi))
  	{
	    $this->nazivi[$this->br_kolona]=$nazivi[$this->br_kolona];
	    $this->sirine[$this->br_kolona]=$sirine[$this->br_kolona];
	    $this->centriranja[$this->br_kolona]=$centriranja[$this->br_kolona];
	    $this->br_kolona++;
	  }	  

	  $this->ceo_br_kolona=$this->br_kolona;

	  if ($this->ico) $this->ceo_br_kolona++;
	  if ($this->brisanje) $this->ceo_br_kolona++;
  
    echo "
      <table border='0' cellpadding='0' cellspacing='0' class='tabLista'>
        <tr>
          <td height='30' colspan='".$this->ceo_br_kolona."' class='listaNaslov'><div align='center'>".$naslov."</div></td>
        </tr>
        <tr>
          <td height='16' colspan='".$this->ceo_br_kolona."'></td>
        </tr>	
	  ";
	
	  echo "<tr>";
	  if ($this->ico) echo "<td width='20' height='20' class='listaHeader'>&nbsp;</td>";

    $i=0;
	  while ($i<$this->br_kolona)
	  {
	    echo "<td width='".$this->sirine[$i]."' height='20' class='listaHeader'>".$this->nazivi[$i].":</td>";
	    $i++;
	  }

	  if ($this->brisanje) echo "<td width='20' height='20' class='listaHeader'>&nbsp;</td>";
	  echo "</tr>";
	
  }  
  //---------------------------------------------------------------------------------------
  function stavka($podatak,$link,$link2="",$ico="",$otklon=0)
  {
    if ($this->i_stil>1) $this->i_stil=0;
    if ($this->i_stil) $stil="listaKolona2";
  	else $stil="listaKolona";
	
    $n=$this->br_kolona;

    $ii=0;
	  $tekst_otklona="";
 	  while ($ii<$otklon)
	  {
	    $tekst_otklona.="&nbsp;";
	    $ii++;
	  }
	
	  echo "<tr>\n";
	  $i=0;
	  if ($this->ico)
	  {
	    echo "<td height='20' id='kolona_".$this->id."_".$this->br_stavki."_".$i."' class='".$stil."' onmouseover=\"listaMisOver(".$this->id.",".$this->br_stavki.",".$this->ceo_br_kolona.",".$this->i_stil.")\" onmouseout=\"listaMisOut(".$this->id.",".$this->br_stavki.",".$this->ceo_br_kolona.",".$this->i_stil.")\"><img src='../img/admin/".$ico."' border='0'></td>\n";
	    $n=$this->br_kolona+1;
	    $i++;
	  }
	
  	$j=0;
	  while ($i<$n)
	  {
	    if ($j==0) $t_o=$tekst_otklona; else $t_o="";
	    //echo "<td height='20' id='kolona_".$this->id."_".$this->br_stavki."_".$i."' class='".$stil."' onmouseover=\"listaMisOver(".$this->id.",".$this->br_stavki.",".$this->ceo_br_kolona.",".$this->i_stil.")\" onmouseout=\"listaMisOut(".$this->id.",".$this->br_stavki.",".$this->ceo_br_kolona.",".$this->i_stil.")\" onmousedown=\"location.href='".$link."'\"><a href='".$link."'><div align='".$this->centriranja[$j]."'>".$t_o.$podatak[$j]."</div></a></td>\n";
	    echo "<td height='20' id='kolona_".$this->id."_".$this->br_stavki."_".$i."' class='".$stil."' onmouseover=\"listaMisOver(".$this->id.",".$this->br_stavki.",".$this->ceo_br_kolona.",".$this->i_stil.")\" onmouseout=\"listaMisOut(".$this->id.",".$this->br_stavki.",".$this->ceo_br_kolona.",".$this->i_stil.")\"><a href='".$link."'><div align='".$this->centriranja[$j]."'>".$t_o.$podatak[$j]."&nbsp;</div></a></td>\n";
	    $i++;
	    $j++;
	  }

	  if ($this->brisanje)
	  {
	    echo "<td height='20' id='kolona_".$this->id."_".$this->br_stavki."_".$i."' class='".$stil."'><a href='".$link2."' onClick='return brisanjeStavke(\"".$podatak[0]."\")'  onmouseover=\"listaMisOver(".$this->id.",".$this->br_stavki.",".$this->ceo_br_kolona.",".$this->i_stil.")\" onmouseout=\"listaMisOut(".$this->id.",".$this->br_stavki.",".$this->ceo_br_kolona.",".$this->i_stil.")\"><img src='../img/admin/icoListaBrisanje.gif' border='0'></a></td>\n";
	  }

	  echo "</tr>\n\n";
  
    $this->i_stil++;
    $this->br_stavki++;	
  }  
  //---------------------------------------------------------------------------------------  
  function dodajPromenjivu($promenjiva,$vrednost)
  {
    $this->promenjive[$this->br_promenjivih]=$promenjiva;
    $this->vrednosti[$this->br_promenjivih]=$vrednost;	
    $this->br_promenjivih++;
  }    
  //---------------------------------------------------------------------------------------  
  function ispisiSubmit($naziv)
  {
    echo "
    <tr>
      <td colspan='".$this->ceo_br_kolona."'>&nbsp;</td>
    </tr>
    <tr>
      <td colspan='".$this->ceo_br_kolona."'><div align='right'><input type='submit' value='".$naziv."' class='listaButton'>&nbsp;&nbsp;</div></td>
    </tr>
    ";  
  }
  //---------------------------------------------------------------------------------------  
  function kraj()
  {
    if ($this->br_rezultata) echo "<tr><td height='50' class='listaFooter' colspan='".$this->ceo_br_kolona."'><div align='center'>Ukupno rezultata: ".$this->br_rezultata."</div></td></tr>";

  	if ($this->selektor)
  	{
      if (!$this->strana) $this->strana=1;
    
      $br_strana=ceoBroj($this->br_rezultata/$this->max_rezultata);
      if ($br_strana==1)
      {
      	$i=1;
      	$n=0;
      }
      else if ($br_strana<=ADMIN_MAX_STRANA)
      {
        $i=1;
        $n=$br_strana;
      }
      else
      {
        if ($this->strana<=ADMIN_MAX_STRANA/2)
        {
          $i=1;
		      $n=ADMIN_MAX_STRANA;
        }
        else if ($this->strana>=$br_strana-ADMIN_MAX_STRANA/2)
        {
          $i=$br_strana-ADMIN_MAX_STRANA;
          $n=$br_strana;
        }
        else
        {
          $i=$this->strana-ADMIN_MAX_STRANA/2;
          $n=$this->strana+ADMIN_MAX_STRANA/2;
        }
      }


  	  $str=trenutnaStrana();
      echo "<tr><td colspan='".$this->ceo_br_kolona."'>";
    
      echo "<table align='center'><tr>";
      if ($this->strana==1)
      {
        echo "<td><img src='../img/admin/prva_off.gif' width='24' height='24' ></td>";
    	  echo "<td><img src='../img/admin/prethodna_off.gif' width='24' height='24' ></td>";
      }
      else
      {
        echo "<form action='".$str."' method='post'>";	
        $j=0;
        while ($j<$this->br_promenjivih)
        {
    	    echo "<input type='hidden' name='".$this->promenjive[$j]."' value='".$this->vrednosti[$j]."'>";
    	    $j++;
        }
    	  $tmp_strana=$this->strana-1;
    	  echo "<input type='hidden' name='strana' value='1'>";
    	  echo "<td><input type='image' src='../img/admin/prva_on.gif'></td>";
    	  echo "</form>";
        echo "<form action='".$str."' method='post'>";	
        $j=0;
        while ($j<$this->br_promenjivih)
        {
    	    echo "<input type='hidden' name='".$this->promenjive[$j]."' value='".$this->vrednosti[$j]."'>";
    	    $j++;
        }
    	  $tmp_strana=$this->strana-1;
    	  echo "<input type='hidden' name='strana' value='".$tmp_strana."'>";
    	  echo "<td><input type='image' src='../img/admin/prethodna_on.gif'></td>";
    	  echo "</form>";
 	
      }
      if ($this->strana<$br_strana)
      {
        echo "<form action='".$str."' method='post'>";	
        $j=0;
        while ($j<$this->br_promenjivih)
        {
    	    echo "<input type='hidden' name='".$this->promenjive[$j]."' value='".$this->vrednosti[$j]."'>";
    	    $j++;
        }
    	  $tmp_strana=$this->strana+1;
    	  echo "<input type='hidden' name='strana' value='".$tmp_strana."'>";
    	  echo "<td><input type='image' src='../img/admin/sledeca_on.gif'></td>";
    	  echo "</form>";
        echo "<form action='".$str."' method='post'>";	
        $j=0;
        while ($j<$this->br_promenjivih)
        {
    	    echo "<input type='hidden' name='".$this->promenjive[$j]."' value='".$this->vrednosti[$j]."'>";
    	    $j++;
        }
    	  $tmp_strana=$br_strana;
    	  echo "<input type='hidden' name='strana' value='".$tmp_strana."'>";
    	  echo "<td><input type='image' src='../img/admin/poslednja_on.gif'></td>";
    	  echo "</form>";
      }
      else
      {
        echo "<td><img src='../img/admin/sledeca_off.gif' width='24' height='24'></td>";
        echo "<td><img src='../img/admin/poslednja_off.gif' width='24' height='24'></td>";		
      }
      echo "</tr></table>";
    
      echo "</td></tr>";
      echo "<tr><td height='20' colspan='".$this->ceo_br_kolona."'>&nbsp;</td></tr>";
      echo "<tr><td colspan='".$this->ceo_br_kolona."'>";   
      
      
      echo "<table align='center'><tr>";   
      while ($i<=$n)
      {
      	echo "<form action='".$str."' method='post'>";
        $j=0;
        while ($j<$this->br_promenjivih)
        {
    	    echo "<input type='hidden' name='".$this->promenjive[$j]."' value='".$this->vrednosti[$j]."'>";
    	    $j++;
        }
    	  echo "<input type='hidden' name='strana' value='".$i."'>";              	
      	echo "<td><input type='image' src='../img/admin/stranica.php?broj=".$i;
        if ($i==$this->strana) echo "&aktivna=1";
        echo "'></td>";
      	echo "</form>";
      	$i++;
      }
      echo "</tr></table>";
    
      echo "</td></tr>";    
    
      echo "<tr><td height='16' colspan='".$this->ceo_br_kolona."'>&nbsp;</td></tr>";
    }
    
    echo "</table>";  
 
  }
  //---------------------------------------------------------------------------------------
};


//-----------------------------------------------------------------------------------------
//*****************************************************************************************
//-----------------------------------------------------------------------------------------


class adminLista2
{
  var $sirina_podataka;
  var $sirina_slike;
  
  var $br_stavki;            // broj stavki u listi

  var $brisanje;             // da li lista koristi ikone za brisanje stavke
  var $selektor;             // da li lista koristi selektor stranica

  var $br_rezultata;         // ukupan broj rezultata u listi
  var $max_rezultata;        // maksimalan broj rezultata po stranici
  var $strana;               // trenutna strana selektora
  var $promenjive;           // niz promenjivih koje se postuju u formi
  var $vrednosti;            // vrednosti tih promenjivih
  var $br_promenjivih;       // brojac tih promenjivih

  //---------------------------------------------------------------------------------------
  function adminLista2($sirina_slike=130,$sirina_podataka=200,$brisanje=1,$selektor=1)
  {
  	$this->sirina_podataka=$sirina_podataka;
  	$this->sirina_slike=$sirina_slike;
	  $this->brisanje=$brisanje;
	  $this->selektor=$selektor;

	  $this->br_promenjivih=0;
	  $this->promenjive=array();
	  $this->vrednosti=array();
	  
	  $sirina_spoljne=$this->sirina_slike+$this->sirina_podataka+24+10+30;
	  echo "<table border='0' cellspacing='0' cellpadding='0' width='".$sirina_spoljne."'>";
	  
  }  
  //---------------------------------------------------------------------------------------
  function stavka($slika,$podatak1,$podatak2,$podatak3,$link,$link2="")
  {
    if (!$slika) $slika="&nbsp;";
    if (!$podatak1) $podatak1="&nbsp;";
    if (!$podatak2) $podatak2="&nbsp;";
    if (!$podatak3) $podatak3="&nbsp;";
    
    $sirina_velike=$this->sirina_slike+$this->sirina_podataka+24+10;
    
    echo "<tr><td>
      <table border='0' cellspacing='0' cellpadding='0' width='".$sirina_velike."'>
        <tr>
          <td width='2' height='2' background='../img/admin/lista2BoxLevoGore.gif'></td>
          <td height='2' background='../img/admin/lista2BoxSredinaGore.gif'></td>
          <td width='2' height='2' background='../img/admin/lista2BoxDesnoGore.gif'></td>
        </tr>
        <tr>
          <td width='2' background='../img/admin/lista2BoxLevoSredina.gif'></td>
          <td class='lista2BoxSredina'>
    ";
    

    echo "
      <table border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='".$this->sirina_slike."' rowspan='3' align='left' valign='top'><a href='".$link."'>".$slika."</a></td>
          <td width='".$this->sirina_podataka."' height='20' class='lista2Naslov'><a href='".$link."'>".$podatak1."</a></td>
    ";
    if ($this->brisanje) echo "<td width='24' height='20'><div align='center'><a href='".$link2."'><img src='../img/admin/icoLista2Brisanje.gif' width='20' height='20' border='0' onClick='return brisanjeStavke(\"".$podatak1."\")' /></a></div></td>";
    
    echo "              
       </tr>
        <tr>
          <td width='".$this->sirina_podataka."' valign='top' class='lista2Tekst'><a href='".$link."'>".$podatak2."</a></td>
    ";
    if ($this->brisanje) echo "<td width='24'>&nbsp;</td>";
    echo "          
        </tr>
          <tr>
            <td width='".$this->sirina_podataka."' height='21' valign='top' class='lista2Datum'><a href='".$link."'>".$podatak3."</a></td>
    ";
    if ($this->brisanje) echo "<td width='24'>&nbsp;</td>";
    echo "          
          </tr>
        </table>
    ";

    echo "          
          </td>
          <td width='2' background='../img/admin/lista2BoxDesnoSredina.gif'></td>
        </tr>
        <tr>
          <td width='2' height='2' background='../img/admin/lista2BoxLevoDole.gif'></td>
          <td height='2' background='../img/admin/lista2BoxSredinaDole.gif'></td>
          <td width='2' height='2' background='../img/admin/lista2BoxDesnoDole.gif'></td>
        </tr>
      </table>  <br> </td></tr> 
    ";

    $this->br_stavki++;	
  }  
  //---------------------------------------------------------------------------------------  
  function dodajPromenjivu($promenjiva,$vrednost)
  {
    $this->promenjive[$this->br_promenjivih]=$promenjiva;
    $this->vrednosti[$this->br_promenjivih]=$vrednost;	
    $this->br_promenjivih++;
  }    
  //---------------------------------------------------------------------------------------  
  function kraj()
  {
  	echo "<tr><td>";
    if ($this->br_rezultata) echo "<table align='center'><tr><td height='50' class='listaFooter'><div align='center'>Ukupno rezultata: ".$this->br_rezultata."</div></td></tr></table><br>";

  	if ($this->selektor)
  	{
  		
      if (!$this->strana) $this->strana=1;
    
      $br_strana=ceoBroj($this->br_rezultata/$this->max_rezultata);
      if ($br_strana==1)
      {
      	$i=1;
      	$n=0;
      }
      else if ($br_strana<=ADMIN_MAX_STRANA)
      {
        $i=1;
        $n=$br_strana;
      }
      else
      {
        if ($this->strana<=ADMIN_MAX_STRANA/2)
        {
          $i=1;
		      $n=ADMIN_MAX_STRANA;
        }
        else if ($this->strana>=$br_strana-ADMIN_MAX_STRANA/2)
        {
          $i=$br_strana-ADMIN_MAX_STRANA;
          $n=$br_strana;
        }
        else
        {
          $i=$this->strana-ADMIN_MAX_STRANA/2;
          $n=$this->strana+ADMIN_MAX_STRANA/2;
        }
      }


  	  $str=trenutnaStrana();
    
      echo "<tr><td>";
    
      echo "<table align='center'><tr>";
      if ($this->strana==1)
      {
        echo "<td><img src='../img/admin/prva_off.gif' width='24' height='24' ></td>";
    	  echo "<td><img src='../img/admin/prethodna_off.gif' width='24' height='24' ></td>";
      }
      else
      {
        echo "<form action='".$str."' method='post'>";	
        $j=0;
        while ($j<$this->br_promenjivih)
        {
    	    echo "<input type='hidden' name='".$this->promenjive[$j]."' value='".$this->vrednosti[$j]."'>";
    	    $j++;
        }
    	  $tmp_strana=$this->strana-1;
    	  echo "<input type='hidden' name='strana' value='1'>";
    	  echo "<td><input type='image' src='../img/admin/prva_on.gif'></td>";
    	  echo "</form>";
        echo "<form action='".$str."' method='post'>";	
        $j=0;
        while ($j<$this->br_promenjivih)
        {
    	    echo "<input type='hidden' name='".$this->promenjive[$j]."' value='".$this->vrednosti[$j]."'>";
    	    $j++;
        }
    	  $tmp_strana=$this->strana-1;
    	  echo "<input type='hidden' name='strana' value='".$tmp_strana."'>";
    	  echo "<td><input type='image' src='../img/admin/prethodna_on.gif'></td>";
    	  echo "</form>";
 	
      }
      if ($this->strana<$br_strana)
      {
        echo "<form action='".$str."' method='post'>";	
        $j=0;
        while ($j<$this->br_promenjivih)
        {
    	    echo "<input type='hidden' name='".$this->promenjive[$j]."' value='".$this->vrednosti[$j]."'>";
    	    $j++;
        }
    	  $tmp_strana=$this->strana+1;
    	  echo "<input type='hidden' name='strana' value='".$tmp_strana."'>";
    	  echo "<td><input type='image' src='../img/admin/sledeca_on.gif'></td>";
    	  echo "</form>";
        echo "<form action='".$str."' method='post'>";	
        $j=0;
        while ($j<$this->br_promenjivih)
        {
    	    echo "<input type='hidden' name='".$this->promenjive[$j]."' value='".$this->vrednosti[$j]."'>";
    	    $j++;
        }
    	  $tmp_strana=$br_strana;
    	  echo "<input type='hidden' name='strana' value='".$tmp_strana."'>";
    	  echo "<td><input type='image' src='../img/admin/poslednja_on.gif'></td>";
    	  echo "</form>";
      }
      else
      {
        echo "<td><img src='../img/admin/sledeca_off.gif' width='24' height='24'></td>";
        echo "<td><img src='../img/admin/poslednja_off.gif' width='24' height='24'></td>";		
      }
      echo "</tr></table><br>";
    
      echo "<table align='center'><tr>";   
      while ($i<=$n)
      {
      	echo "<form action='".$str."' method='post'>";
        $j=0;
        while ($j<$this->br_promenjivih)
        {
    	    echo "<input type='hidden' name='".$this->promenjive[$j]."' value='".$this->vrednosti[$j]."'>";
    	    $j++;
        }
    	  echo "<input type='hidden' name='strana' value='".$i."'>";              	
      	echo "<td><input type='image' src='../img/admin/stranica.php?broj=".$i;
        if ($i==$this->strana) echo "&aktivna=1";
        echo "'></td>";
      	echo "</form>";
      	$i++;
      }
      echo "</tr></table>";
      
       
    }
    
    echo "</td></tr></table><br><br>";  
 
  }
  //---------------------------------------------------------------------------------------
};




//-----------------------------------------------------------------------------------------
//*****************************************************************************************
//-----------------------------------------------------------------------------------------



endif;

?>