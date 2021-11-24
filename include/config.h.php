<?php
//**********************************************************************************************
//  Header sa glavnim parametrima
//  
//  Skara 2009.
//**********************************************************************************************

if (!defined("Config_H_PHP")):
define("Config_H_PHP",true);

// Osnovni DB parametri ------------------------------------------------------------------------
$app_server=1; 

if ($app_server==1)
{ // net server
  define("MYSQL_HOST","localhost");
  define("MYSQL_USER","brakipor");
  define("MYSQL_PASS","brakipor");
  define("MYSQL_DB","brakipor");
}
else if ($app_server==2)
{ // lcp-labs.com
  define("MYSQL_HOST","localhost");
  define("MYSQL_USER","brakipor");
  define("MYSQL_PASS","brakipor");
  define("MYSQL_DB","brakipor");
}
else
{ // lokalni linux server
  define("MYSQL_HOST","localhost");
  define("MYSQL_USER","brakipor");
  define("MYSQL_PASS","brakipor");
  define("MYSQL_DB","brakipor");
}

$mysql_connection=0;     

// Path-ovi -----------------------------------------------------------------------------------
if ($app_server==1)
{ // net server 
  define("PATH_ROOT","/home/brakiporodica/public_html/"); //   /var/www/html/
}
else if ($app_server==2)
{ // lcp-labs.com   
  define("PATH_ROOT","/home/lcplabsc/public_html/porodica/");
}
else
{ // lokalni linux server
    define("PATH_ROOT","/var/www/html/porodica/");
}
   
define("PATH_TMP","tmp/");


// DB tabele ----------------------------------------------------------------------------------
define("TAB_SLIKE","slike");
define("TAB_GRUPE","grupe");
define("TAB_PODGRUPE","podgrupe");
define("TAB_CLANCI","clanci");
define("TAB_VESTI","vesti");
define("TAB_UVODI","uvodi"); 
define("TAB_STRANICE","stranice");


// Simboli ------------------------------------------------------------------------------------
define("LISTA_ICO_DA",1);
define("LISTA_ICO_NE",0);
define("LISTA_BRISANJE_DA",1);
define("LISTA_BRISANJE_NE",0);
define("LISTA_SELEKTOR_DA",1);
define("LISTA_SELEKTOR_NE",0);

define("ZELENA","#00cc00");
define("CRVENA","#ff0000");
define("ZUTA","#FF9900");

define("SLIKA_NORMAL",0);
define("SLIKA_FIX",1);

// Konstante ----------------------------------------------------------------------------------
define("JPG_KVALITET",75);
define("MAX_STRANA",6);
define("MAX_SLIKA_PO_CLANKU",1);
define("MAX_SLIKA_PO_VESTI",1);
define("MAX_SLIKA_PO_STRANICI",1);
define("ADMIN_MAX_STRANA",10);
define("ADMIN_MAX_VESTI",10);
define("ADMIN_MAX_CLANAKA",10);

define("MAX_CLANAKA",4);
define("MAX_VESTI",4);



// Slike -------------------------------------------------------------------------------------
define("SL_CLANAK",1);
define("SL_CLANAK_TIP",SLIKA_NORMAL);
define("SL_CLANAK_MAX_SIRINA",640);
define("SL_CLANAK_MAX_VISINA",480);
define("SL_CLANAK_MIN_SIRINA",250);
define("SL_CLANAK_MIN_VISINA",170);
define("SL_CLANAK_PATH","img/clanci/");
define("SL_CLANAK_DEFAULT_NAZIV","clanak");
define("SL_CLANAK_MALA",1);
define("SL_CLANAK_MALA_SIRINA",150);
define("SL_CLANAK_MALA_VISINA",100);
define("SL_CLANAK_SREDNJA",1);
define("SL_CLANAK_SREDNJA_SIRINA",250);
define("SL_CLANAK_SREDNJA_VISINA",170);

define("SL_VEST",2);
define("SL_VEST_TIP",SLIKA_NORMAL);
define("SL_VEST_MAX_SIRINA",640);
define("SL_VEST_MAX_VISINA",480);
define("SL_VEST_MIN_SIRINA",250);
define("SL_VEST_MIN_VISINA",170);
define("SL_VEST_PATH","img/vesti/");
define("SL_VEST_DEFAULT_NAZIV","vest");
define("SL_VEST_MALA",1);
define("SL_VEST_MALA_SIRINA",150);
define("SL_VEST_MALA_VISINA",100);
define("SL_VEST_SREDNJA",1);
define("SL_VEST_SREDNJA_SIRINA",250);
define("SL_VEST_SREDNJA_VISINA",170);

define("SL_STRANICA",3);
define("SL_STRANICA_TIP",SLIKA_NORMAL);
define("SL_STRANICA_MAX_SIRINA",640);
define("SL_STRANICA_MAX_VISINA",480);
define("SL_STRANICA_MIN_SIRINA",250);
define("SL_STRANICA_MIN_VISINA",170);
define("SL_STRANICA_PATH","img/stranice/");
define("SL_STRANICA_DEFAULT_NAZIV","stranica");
define("SL_STRANICA_MALA",1);
define("SL_STRANICA_MALA_SIRINA",150);
define("SL_STRANICA_MALA_VISINA",100);
define("SL_STRANICA_SREDNJA",1);
define("SL_STRANICA_SREDNJA_SIRINA",250);
define("SL_STRANICA_SREDNJA_VISINA",170);
//--------------------------------------------------------------------------------------------
endif;

?>
