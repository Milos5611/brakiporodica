<?php
//*****************************************************************************************
//  Glavni header file 
//  
//  Skara 2009.
//*****************************************************************************************

if (!defined("Aplikacija_H_PHP")):
    define("Aplikacija_H_PHP", true);

    include("config.h.php");

//-----------------------------------------------------------------------------------------
    function dbConnect()
    {
        global $mysql_connection;

        @$mysql_connection = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB, 3306);
        if (!$mysql_connection) {
            echo "Error: Unable to connect to MySQL.<br><b>" . PHP_EOL;
            echo "Debugging errno: <br><b>" . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: <br><b>" . mysqli_connect_error() . PHP_EOL;
            echo "<br><b>Veza sa bazom podataka je u prekidu... Pokusajte malo kasnije...</b>";
            exit;
        }
    }

//-----------------------------------------------------------------------------------------
    function dbDisconnect()
    {
        global $mysql_connection;
        mysqli_close($mysql_connection);
    }

//-----------------------------------------------------------------------------------------
    function prazanRed($br_redova = 1)
    {
        $brojac_redova = 0;
        while ($br_redova > $brojac_redova) {
            echo "<br>";
            $brojac_redova++;
        }
    }

//-----------------------------------------------------------------------------------------
    function shtakor($br = 1)
    {
        $brojac = 0;
        while ($br > $brojac) {
            echo "&nbsp;";
            $brojac++;
        }
    }

//-----------------------------------------------------------------------------------------
    function stamp()
    {
        $stamp = date("YmdHis");
        return $stamp;
    }

//-----------------------------------------------------------------------------------------
    function numUMesec($num)
    {
        if ($num == 1) $mesec = "Januar";
        else if ($num == 2) $mesec = "Februar";
        else if ($num == 3) $mesec = "Mart";
        else if ($num == 4) $mesec = "April";
        else if ($num == 5) $mesec = "Maj";
        else if ($num == 6) $mesec = "Jun";
        else if ($num == 7) $mesec = "Jul";
        else if ($num == 8) $mesec = "Avgust";
        else if ($num == 9) $mesec = "Septembar";
        else if ($num == 10) $mesec = "Oktobar";
        else if ($num == 11) $mesec = "Novembar";
        else $mesec = "Decembar";
        return $mesec;
    }

//-----------------------------------------------------------------------------------------
    function numUDan($num)
    {
        if ($num == 1) $dan = "Ponedeljak";
        else if ($num == 2) $dan = "Utorak";
        else if ($num == 3) $dan = "Sreda";
        else if ($num == 4) $dan = "Cetvrtak";
        else if ($num == 5) $dan = "Petak";
        else if ($num == 6) $dan = "Subota";
        else $dan = "Nedelja";
        return $dan;
    }

//-----------------------------------------------------------------------------------------
    function vreme()
    {
        $stamp = stamp();

        $num_sekunde = $stamp[12] . $stamp[13];
        $num_minuti = $stamp[10] . $stamp[11];
        $num_sati = $stamp[8] . $stamp[9];
        $num_dan_u_nedelji = date("w");
        $num_dan = $stamp[6] . $stamp[7];
        $num_mesec = $stamp[4] . $stamp[5];
        $num_godina = $stamp[0] . $stamp[1] . $stamp[2] . $stamp[3];

        $dan_u_nedelji = numUDan($num_dan_u_nedelji);
        $mesec = numUMesec($num_mesec);

        $vreme = $num_sati . ":" . $num_minuti . "h  " . numUDan($num_dan_u_nedelji) . ", " . $num_dan . ". " . numUMesec($num_mesec) . " " . $num_godina . ".";

        return $vreme;
    }

//-----------------------------------------------------------------------------------------
    function stampUVreme($stamp)
    {
        $num_sekunde = $stamp[12] . $stamp[13];
        $num_minuti = $stamp[10] . $stamp[11];
        $num_sati = $stamp[8] . $stamp[9];
        $num_dan_u_nedelji = date("w");
        $num_dan = $stamp[6] . $stamp[7];
        $num_mesec = $stamp[4] . $stamp[5];
        $num_godina = $stamp[0] . $stamp[1] . $stamp[2] . $stamp[3];

        $dan_u_nedelji = numUDan($num_dan_u_nedelji);
        $mesec = numUMesec($num_mesec);

        $vreme = $num_dan . ". " . numUMesec($num_mesec) . " " . $num_godina . "." . " u " . $num_sati . ":" . $num_minuti . "h  ";

        return $vreme;
    }

//-----------------------------------------------------------------------------------------
    function stampUDatum($stamp)
    {
        $num_sekunde = $stamp[12] . $stamp[13];
        $num_minuti = $stamp[10] . $stamp[11];
        $num_sati = $stamp[8] . $stamp[9];
        $num_dan_u_nedelji = date("w");
        $num_dan = $stamp[6] . $stamp[7];
        $num_mesec = $stamp[4] . $stamp[5];
        $num_godina = $stamp[0] . $stamp[1] . $stamp[2] . $stamp[3];

        $dan_u_nedelji = numUDan($num_dan_u_nedelji);
        $mesec = numUMesec($num_mesec);

        $datum = $num_dan . "-" . $mesec . "-" . $num_godina;

        return $datum;
    }

//-----------------------------------------------------------------------------------------
    function stampUDatum2($stamp)
    {
        $num_sekunde = $stamp[12] . $stamp[13];
        $num_minuti = $stamp[10] . $stamp[11];
        $num_sati = $stamp[8] . $stamp[9];
        $num_dan_u_nedelji = date("w");
        $num_dan = $stamp[6] . $stamp[7];
        $num_mesec = $stamp[4] . $stamp[5];
        $num_godina = $stamp[0] . $stamp[1] . $stamp[2] . $stamp[3];

        $dan_u_nedelji = numUDan($num_dan_u_nedelji);
        $mesec = numUMesec($num_mesec);

        $datum = $num_dan . "." . $num_mesec . "." . $num_godina . ".";

        return $datum;
    }

//-----------------------------------------------------------------------------------------
    function tekucaGodina()
    {
        $s = stamp();
        $tg = $s[0] . $s[1] . $s[2] . $s[3];
        return $tg;
    }

//-----------------------------------------------------------------------------------------
    class query
    {
        var $query;
        var $result;
        var $row;
        var $rows;

        //-------------------------------------------------------------------
        function query($query)
        {
            $this->query = $query;
            $this->result = mysql_query($this->query);
            $this->rows = mysql_num_rows($this->result);
            $this->row = mysql_fetch_row($this->result);
        }

        //-------------------------------------------------------------------
        function fetchRow()
        {
            $this->row = mysql_fetch_row($this->result);
        }
        //-------------------------------------------------------------------
    }

    ;

//-----------------------------------------------------------------------------------------
    class execQuery
    {
        var $query;
        var $result;
        var $rows;

        //-------------------------------------------------------------------
        function execQuery($query)
        {
            $this->query = $query;
            $this->result = mysql_query($this->query);
            $this->rows = mysql_affected_rows();
        }
        //-------------------------------------------------------------------
    }

    ;
//----------------------------------------------------------------------------------------
    function ceoBroj($broj)
    {
        $i = 0;
        while ($i < $broj) {
            $i++;
        }
        return $i;
    }

//----------------------------------------------------------------------------------------
    function trenutnaStrana()
    {
        $niz = explode("/", $_SERVER["PHP_SELF"]);
        $n = sizeof($niz);
        return $niz[$n - 1];
    }

//-----------------------------------------------------------------------------------------
// ****************************************************************************************
//-----------------------------------------------------------------------------------------
    class slika
    {
        var $id;
        var $id_objekta;
        var $vrsta;
        var $indeks;
        var $naziv;
        var $naziv_mala;
        var $naziv_srednja;
        var $ext;
        var $sirina;
        var $visina;
        var $komentar;
        var $velicina;

        var $stamp_unosa;

        var $tip;
        var $niz;
        var $max_sirina;
        var $max_visina;
        var $min_sirina;
        var $min_visina;
        var $mala;
        var $mala_sirina;
        var $mala_visina;
        var $srednja;
        var $srednja_sirina;
        var $srednja_visina;
        var $default_naziv;
        var $path;

        var $tabela;
        var $rezultat_unosa;

        //---------------------------------------------------------------------------------------
        function slika($vrsta, $id_objekta, $indeks)
        {
            $this->tabela = TAB_SLIKE;
            $this->vrsta = $vrsta;
            $this->id_objekta = $id_objekta;
            $this->indeks = $indeks;

            $this->mala = 0;
            $this->srednja = 0;

            if ($this->vrsta == SL_CLANAK) {
                $this->tip = SL_CLANAK_TIP;
                $this->max_sirina = SL_CLANAK_MAX_SIRINA;
                $this->max_visina = SL_CLANAK_MAX_VISINA;
                $this->min_sirina = SL_CLANAK_MIN_SIRINA;
                $this->min_visina = SL_CLANAK_MIN_VISINA;
                $this->default_naziv = SL_CLANAK_DEFAULT_NAZIV;
                $this->path = SL_CLANAK_PATH;
                $this->mala = SL_CLANAK_MALA;
                $this->mala_sirina = SL_CLANAK_MALA_SIRINA;
                $this->mala_visina = SL_CLANAK_MALA_VISINA;
                $this->srednja = SL_CLANAK_SREDNJA;
                $this->srednja_sirina = SL_CLANAK_SREDNJA_SIRINA;
                $this->srednja_visina = SL_CLANAK_SREDNJA_VISINA;
            } else if ($this->vrsta == SL_VEST) {
                $this->tip = SL_VEST_TIP;
                $this->max_sirina = SL_VEST_MAX_SIRINA;
                $this->max_visina = SL_VEST_MAX_VISINA;
                $this->min_sirina = SL_VEST_MIN_SIRINA;
                $this->min_visina = SL_VEST_MIN_VISINA;
                $this->default_naziv = SL_VEST_DEFAULT_NAZIV;
                $this->path = SL_VEST_PATH;
                $this->mala = SL_VEST_MALA;
                $this->mala_sirina = SL_VEST_MALA_SIRINA;
                $this->mala_visina = SL_VEST_MALA_VISINA;
                $this->srednja = SL_VEST_SREDNJA;
                $this->srednja_sirina = SL_VEST_SREDNJA_SIRINA;
                $this->srednja_visina = SL_VEST_SREDNJA_VISINA;
            } else if ($this->vrsta == SL_STRANICA) {
                $this->tip = SL_STRANICA_TIP;
                $this->max_sirina = SL_STRANICA_MAX_SIRINA;
                $this->max_visina = SL_STRANICA_MAX_VISINA;
                $this->min_sirina = SL_STRANICA_MIN_SIRINA;
                $this->min_visina = SL_STRANICA_MIN_VISINA;
                $this->default_naziv = SL_STRANICA_DEFAULT_NAZIV;
                $this->path = SL_STRANICA_PATH;
                $this->mala = SL_STRANICA_MALA;
                $this->mala_sirina = SL_STRANICA_MALA_SIRINA;
                $this->mala_visina = SL_STRANICA_MALA_VISINA;
                $this->srednja = SL_STRANICA_SREDNJA;
                $this->srednja_sirina = SL_STRANICA_SREDNJA_SIRINA;
                $this->srednja_visina = SL_STRANICA_SREDNJA_VISINA;
            }

            $query = "select * from " . TAB_SLIKE . " where vrsta='" . $vrsta . "' and id_objekta='" . $id_objekta . "' and indeks='" . $indeks . "'";
            $result = mysql_query($query);
            $rows = mysql_num_rows($result);
            if ($rows) {
                $row = mysql_fetch_array($result);
                $this->dodelaVrednosti($row);
            }
        }

        //---------------------------------------------------------------------------------------
        function dodelaVrednosti($row)
        {
            $this->id = $row['id'];
            $this->id_objekta = $row['id_objekta'];
            $this->vrsta = $row['vrsta'];
            $this->indeks = $row['indeks'];
            $this->naziv = $row['naziv'];
            $this->naziv_mala = $row['naziv_mala'];
            $this->naziv_srednja = $row['naziv_srednja'];
            $this->ext = $row['ext'];
            $this->sirina = $row['sirina'];
            $this->visina = $row['visina'];
            $this->komentar = stripslashes($row['komentar']);
            if (file_exists(PATH_ROOT . $this->path . $this->naziv)) {
                $vl = filesize(PATH_ROOT . $this->path . $this->naziv) / 1024;
                $this->velicina = round($vl, 2);
            } else $this->velicina = 0;

            $this->stamp_unosa = $row['stamp_unosa'];
        }

        //---------------------------------------------------------------------------------------
        function upload()
        {

            //die(var_dump($this->niz['name']));
            $povratni_string = "";
            if (!$this->niz['name']) return $povratni_string;

            if ($this->niz['type'] == "image/jpeg" || $this->niz['type'] == "image/pjpeg") $this->ext = ".jpg";
            else if ($this->niz['type'] == "image/gif") $this->ext = ".gif";
            else if ($this->niz['type'] == "image/png" || $this->niz['type'] == "image/x-png") $this->ext = ".png";
            else {
                $povratni_string = "Slika: " . $this->niz['name'] . " - <font color='" . CRVENA . "'>Gre&#353;ka:</font> slike moraju biti .jpg ili .png formatu!";
                return $povratni_string;
            }

            $tmp_fajl = PATH_ROOT . PATH_TMP . $this->default_naziv . "_" . $this->id_objekta . "_" . $this->indeks . $this->ext;
            $fajl = $_SERVER["DOCUMENT_ROOT"] . "/" . $this->path . $this->default_naziv . "_" . $this->id_objekta . "_" . $this->indeks . $this->ext;
            $this->naziv = $this->default_naziv . "_" . $this->id_objekta . "_" . $this->indeks . $this->ext;
            //$tmp_fajl = $_SERVER["DOCUMENT_ROOT"]."/".$this->path.$this->default_naziv."_".$this->id_objekta."_".$this->indeks.$this->ext;
            copy($this->niz['tmp_name'], $tmp_fajl);

            //die(var_dump($this->niz['tmp_name']));
//          if(is_uploaded_file($this->niz['tmp_name'])){
//              //
//                if(move_uploaded_file($this->niz['tmp_name'], $tmp_fajl)){
//                    echo 'slika je uplodovana';
//                }
//
//          }


            //copy($this->niz['tmp_name'],$tmp_fajl);

            $tmp_slika = getimagesize($tmp_fajl);
            $sirina = $tmp_slika[0];
            $visina = $tmp_slika[1];

            if ($sirina < $this->min_sirina || $visina < $this->min_visina) {
                $povratni_string = "Slika: " . $this->niz['name'] . " - <font color='" . CRVENA . "'>Gre&#353;ka:</font> slike moraju biti minimalno " . $this->min_sirina . "x" . $this->min_visina . " piksela!<br>";
                unlink($tmp_fajl);
                return $povratni_string;
            }

            if ($this->ext == ".jpg") $src_slika = imagecreatefromjpeg($tmp_fajl);
            else if ($this->ext == ".gif") $src_slika = imagecreatefromgif($tmp_fajl);
            else if ($this->ext == ".png") $src_slika = imagecreatefrompng($tmp_fajl);

            $k = $sirina / $visina;
            $k1 = $this->max_sirina / $this->max_visina;

            $ks = $sirina / $this->max_sirina;
            $kv = $visina / $this->max_visina;

            $src_x = 0;
            $src_y = 0;
            $dst_x = 0;
            $dst_y = 0;
            $src_sirina = 0;
            $src_visina = 0;
            $dst_sirina = 0;
            $dst_visina = 0;

            if ($this->tip == SLIKA_NORMAL) // Tip slike koja se ne resize-uje !!!
            {
                if ($ks <= 1 && $kv <= 1) {
                    $src_sirina = $sirina;
                    $src_visina = $visina;
                    $dst_sirina = $sirina;
                    $dst_visina = $visina;
                    $dst_slika = imagecreatetruecolor($sirina, $visina);
                } else if ($ks > 1 && $kv <= 1) {
                    $src_sirina = $sirina;
                    $src_visina = $visina;
                    $dst_sirina = $this->max_sirina;
                    $dst_visina = $visina / $ks;
                    $dst_slika = imagecreatetruecolor($dst_sirina, $dst_visina);
                } else if ($ks <= 1 && $kv > 1) {
                    $src_sirina = $sirina;
                    $src_visina = $visina;
                    $dst_visina = $this->max_visina;
                    $dst_sirina = $sirina / $kv;
                    $dst_slika = imagecreatetruecolor($dst_sirina, $dst_visina);
                } else if ($ks > 1 && $kv > 1 && $ks >= $kv) {
                    $src_sirina = $sirina;
                    $src_visina = $visina;
                    $dst_sirina = $this->max_sirina;
                    $dst_visina = $visina / $ks;
                    $dst_slika = imagecreatetruecolor($dst_sirina, $dst_visina);
                } else if ($ks > 1 && $kv > 1 && $ks < $kv) {
                    $src_sirina = $sirina;
                    $src_visina = $visina;
                    $dst_visina = $this->max_visina;
                    $dst_sirina = $sirina / $kv;
                    $dst_slika = imagecreatetruecolor($dst_sirina, $dst_visina);
                }
            } else if ($this->tip == SLIKA_FIX) // Tip slike koji se resize-uje (nalik staroj funkciji)
            {
                $dst_slika = imagecreatetruecolor($this->max_sirina, $this->max_visina);
                if ($ks >= $kv) {
                    $src_visina = $visina;
                    $src_sirina = $visina * $k1;
                    $src_x = ($sirina - $src_sirina) / 2;
                } else if ($ks < $kv) {
                    $src_sirina = $sirina;
                    $src_visina = $sirina / $k1;
                    $src_y = ($visina - $src_visina) / 2;
                }

                $dst_sirina = $this->max_sirina;
                $dst_visina = $this->max_visina;
            }

            imagecopyresampled($dst_slika, $src_slika, $dst_x, $dst_y, $src_x, $src_y, $dst_sirina, $dst_visina, $src_sirina, $src_visina);

            if ($this->ext == ".jpg") imagejpeg($dst_slika, $fajl, JPG_KVALITET);
            else if ($this->ext == ".gif") imagegif($dst_slika, $fajl);
            else if ($this->ext == ".png") imagepng($dst_slika, $fajl);

            imagedestroy($src_slika);
            unlink($tmp_fajl);


            // MALA SLIKA -----------------------------------------------------------
            if ($this->mala) {
                if ($this->ext == ".jpg") $mala_src_slika = imagecreatefromjpeg($fajl);
                else if ($this->ext == ".gif") $mala_src_slika = imagecreatefromgif($fajl);
                else if ($this->ext == ".png") $mala_src_slika = imagecreatefrompng($fajl);

                $mala_fajl = PATH_ROOT . $this->path . $this->default_naziv . "_" . $this->id_objekta . "_" . $this->indeks . "_m" . $this->ext;
                $mala_dst_slika = imagecreatetruecolor($this->mala_sirina, $this->mala_visina);

                $mala_sl = getimagesize($fajl);
                $mala_sirina = $mala_sl[0];
                $mala_visina = $mala_sl[1];

                $mala_src_x = 0;
                $mala_src_y = 0;
                $mala_src_sirina = 0;
                $mala_src_visina = 0;

                $mala_k1 = $mala_sirina / $mala_visina;
                $mala_k2 = $this->mala_sirina / $this->mala_visina;

                if ($mala_k1 >= $mala_k2) {
                    $mala_src_visina = $mala_visina;
                    $mala_src_y = 0;
                    $mala_src_sirina = $mala_src_visina * $mala_k2;
                    $mala_src_x = ($mala_sirina - $mala_src_sirina) / 2;
                } else if ($mala_k1 < $mala_k2) {
                    $mala_src_sirina = $mala_sirina;
                    $mala_src_x = 0;
                    $mala_src_visina = $mala_src_sirina / $mala_k2;
                    $mala_src_y = ($mala_visina - $mala_src_visina) / 2;
                }

                imagecopyresampled($mala_dst_slika, $mala_src_slika, 0, 0, $mala_src_x, $mala_src_y, $this->mala_sirina, $this->mala_visina, $mala_src_sirina, $mala_src_visina);
                if ($this->ext == ".jpg") imagejpeg($mala_dst_slika, $mala_fajl, JPG_KVALITET);
                else if ($this->ext == ".gif") imagegif($mala_dst_slika, $mala_fajl);
                else if ($this->ext == ".png") imagepng($mala_dst_slika, $mala_fajl);
                imagedestroy($mala_src_slika);
                $this->naziv_mala = $this->default_naziv . "_" . $this->id_objekta . "_" . $this->indeks . "_m" . $this->ext;
            }

            // SREDNJA SLIKA -----------------------------------------------------------
            if ($this->srednja) {
                if ($this->ext == ".jpg") $srednja_src_slika = imagecreatefromjpeg($fajl);
                else if ($this->ext == ".gif") $srednja_src_slika = imagecreatefromgif($fajl);
                else if ($this->ext == ".png") $srednja_src_slika = imagecreatefrompng($fajl);

                $srednja_fajl = PATH_ROOT . $this->path . $this->default_naziv . "_" . $this->id_objekta . "_" . $this->indeks . "_s" . $this->ext;
                $srednja_dst_slika = imagecreatetruecolor($this->srednja_sirina, $this->srednja_visina);

                $srednja_sl = getimagesize($fajl);
                $srednja_sirina = $mala_sl[0];
                $srednja_visina = $mala_sl[1];

                $srednja_src_x = 0;
                $srednja_src_y = 0;
                $srednja_src_sirina = 0;
                $srednja_src_visina = 0;

                $srednja_k1 = $srednja_sirina / $srednja_visina;
                $srednja_k2 = $this->srednja_sirina / $this->srednja_visina;

                if ($srednja_k1 >= $srednja_k2) {
                    $srednja_src_visina = $srednja_visina;
                    $srednja_src_y = 0;
                    $srednja_src_sirina = $srednja_src_visina * $srednja_k2;
                    $srednja_src_x = ($srednja_sirina - $srednja_src_sirina) / 2;
                } else if ($srednja_k1 < $srednja_k2) {
                    $srednja_src_sirina = $srednja_sirina;
                    $srednja_src_x = 0;
                    $srednja_src_visina = $srednja_src_sirina / $srednja_k2;
                    $srednja_src_y = ($srednja_visina - $srednja_src_visina) / 2;
                }

                imagecopyresampled($srednja_dst_slika, $srednja_src_slika, 0, 0, $srednja_src_x, $srednja_src_y, $this->srednja_sirina, $this->srednja_visina, $srednja_src_sirina, $srednja_src_visina);
                if ($this->ext == ".jpg") imagejpeg($srednja_dst_slika, $srednja_fajl, JPG_KVALITET);
                else if ($this->ext == ".gif") imagegif($srednja_dst_slika, $srednja_fajl);
                else if ($this->ext == ".png") imagepng($srednja_dst_slika, $srednja_fajl);
                imagedestroy($srednja_src_slika);
                $this->naziv_srednja = $this->default_naziv . "_" . $this->id_objekta . "_" . $this->indeks . "_s" . $this->ext;
            }

            $this->stamp_unosa = stamp();
            if (!$this->id) {
                mysql_query("insert into " . $this->tabela . " (stamp_unosa) values ('$this->stamp_unosa')");
                $this->id = mysql_insert_id();
            }

            $sl = getimagesize($fajl);
            $sirina = $sl[0];
            $visina = $sl[1];

            $this->komentar = addslashes($this->komentar);

            $query = "update " . $this->tabela . " set ";
            $query .= "id_objekta='" . $this->id_objekta . "', ";
            $query .= "vrsta='" . $this->vrsta . "', ";
            $query .= "indeks='" . $this->indeks . "', ";
            $query .= "naziv='" . $this->naziv . "', ";
            $query .= "naziv_mala='" . $this->naziv_mala . "', ";
            $query .= "naziv_srednja='" . $this->naziv_srednja . "', ";
            $query .= "ext='" . $this->ext . "', ";
            $query .= "sirina='" . $sirina . "', ";
            $query .= "visina='" . $visina . "', ";
            $query .= "komentar='" . $this->komentar . "', ";

            $query .= " stamp_unosa='" . $this->stamp_unosa . "' where id=" . $this->id;
            $q = new execQuery($query);
            $this->rezultat_unosa = $q->result;

            if ($this->rezultat_unosa) $povratni_string = "Slika: " . $this->niz['name'] . " - <font color='" . ZELENA . "'>OK</font>";
            else $povratni_string = "Slika: " . $this->niz['name'] . " - Nije uneta !!!";
            return $povratni_string;
        }

        //---------------------------------------------------------------------------------------
        function brisanje()
        {

            if (file_exists(PATH_ROOT . $this->path . $this->naziv)) unlink(PATH_ROOT . $this->path . $this->naziv);
            if ($this->naziv_mala) {
                if (file_exists(PATH_ROOT . $this->path . $this->naziv_mala)) unlink(PATH_ROOT . $this->path . $this->naziv_mala);
            }
            if ($this->naziv_srednja) {
                if (file_exists(PATH_ROOT . $this->path . $this->naziv_srednja)) unlink(PATH_ROOT . $this->path . $this->naziv_srednja);
            }
            mysql_query("delete from " . TAB_SLIKE . " where id='" . $this->id . "' limit 1");
        }

        //---------------------------------------------------------------------------------------
        function postaviKomentar($komentar)
        {
            if ($this->id) mysql_query("update " . TAB_SLIKE . " set komentar='" . $komentar . "' where id=" . $this->id);
        }
        //---------------------------------------------------------------------------------------
    }

    ;


//-----------------------------------------------------------------------------------------
// ****************************************************************************************
//-----------------------------------------------------------------------------------------

    class selektor
    {
        var $sirina;
        var $pozicija;

        var $br_rezultata;         // ukupan broj rezultata u listi
        var $max_rezultata;        // maksimalan broj rezultata po stranici
        var $strana;               // trenutna strana selektora
        var $promenjive;           // niz promenjivih koje se postuju u formi
        var $vrednosti;            // vrednosti tih promenjivih
        var $br_promenjivih;       // brojac tih promenjivih

        //---------------------------------------------------------------------------------------
        function selektor($pozicija = "left")
        {
            $this->pozicija = $pozicija;

            $this->br_promenjivih = 0;
            $this->promenjive = array();
            $this->vrednosti = array();


        }

        //---------------------------------------------------------------------------------------
        function dodajPromenjivu($promenjiva, $vrednost)
        {
            if ($vrednost) {
                $this->promenjive[$this->br_promenjivih] = $promenjiva;
                $this->vrednosti[$this->br_promenjivih] = $vrednost;
                $this->br_promenjivih++;
            }
        }

        //---------------------------------------------------------------------------------------
        function ispis()
        {
            $link_promenjivih = "";

            for ($j = 0; $j < $this->br_promenjivih; $j++) {
                $link_promenjivih .= "&" . $this->promenjive[$j] . "=" . $this->vrednosti[$j];
            }

            if (!$this->strana) $this->strana = 1;

            $br_strana = ceoBroj($this->br_rezultata / $this->max_rezultata);
            if ($br_strana == 1) {
                $i = 1;
                $n = 0;
            } else if ($br_strana <= MAX_STRANA) {
                $i = 1;
                $n = $br_strana;
            } else {
                if ($this->strana <= MAX_STRANA / 2) {
                    $i = 1;
                    $n = MAX_STRANA;
                } else if ($this->strana >= $br_strana - MAX_STRANA / 2) {
                    $i = $br_strana - MAX_STRANA;
                    $n = $br_strana;
                } else {
                    $i = $this->strana - MAX_STRANA / 2;
                    $n = $this->strana + MAX_STRANA / 2;
                }
            }


            $str = trenutnaStrana();


            //if ($this->br_rezultata)
            if ($br_strana > 1) {
                echo "<table align='center'  border='0' cellspacing='0' cellpadding='0' align='" . $this->pozicija . "'><tr>";
                if ($this->strana == 1) {
                    echo "<td class='pagging'>&nbsp;&nbsp;Prethodna&nbsp;&nbsp;<&nbsp;</td>";
                } else {
                    $tmp_strana = $this->strana - 1;
                    echo "<td class='pagging'>&nbsp;&nbsp;Prethodna&nbsp;&nbsp;<a href='" . $str . "?strana=" . $tmp_strana . $link_promenjivih . "'><</a>&nbsp;</td>";
                }


                while ($i <= $n) {
                    if ($i == $this->strana) echo "<td class='paggingActive'>&nbsp;&nbsp;" . $i . "&nbsp;&nbsp;</td>";
                    else echo "<td class='pagging'>&nbsp;&nbsp;<a href='" . $str . "?strana=" . $i . $link_promenjivih . "'>" . $i . "</a>&nbsp;&nbsp;</td>";
                    $i++;
                }


                if ($this->strana < $br_strana) {
                    $tmp_strana = $this->strana + 1;
                    echo "<td class='pagging'>&nbsp;<a href='" . $str . "?strana=" . $tmp_strana . $link_promenjivih . "'>></a>&nbsp;&nbsp;Slede&#263;a&nbsp;&nbsp;</td>";
                } else {
                    echo "<td class='pagging'>&nbsp;>&nbsp;&nbsp;Slede&#263;a&nbsp;&nbsp;</td>";
                }
                echo "</tr></table><br>";
            }

        }
        //---------------------------------------------------------------------------------------
    }

    ;

//-----------------------------------------------------------------------------------------
// ****************************************************************************************
//-----------------------------------------------------------------------------------------
    class grupa
    {
        var $id;
        var $naziv;
        var $aktivno;
        var $prioritet;

        var $stamp_unosa;
        var $stamp_izmene;
        var $tabela;
        var $rezultat_unosa;
        var $rezultat_brisanja;

        //---------------------------------------------------------------------------------------
        function grupa($id = 0)
        {
            $this->tabela = TAB_GRUPE;

            if ($id) {
                $query = "select * from " . $this->tabela . " where id='" . $id . "'";
                $result = mysql_query($query);
                $row = mysql_fetch_array($result);
                $this->dodelaVrednosti($row);
            }
        }

        //---------------------------------------------------------------------------------------
        function dodelaVrednosti($row)
        {
            $this->id = $row['id'];
            $this->naziv = stripslashes($row['naziv']);
            $this->aktivno = $row['aktivno'];
            $this->prioritet = $row['prioritet'];

            $this->stamp_unosa = $row['stamp_unosa'];
            $this->stamp_izmene = $row['stamp_izmene'];
        }

        //---------------------------------------------------------------------------------------
        function unos()
        {
            $this->stamp_unosa = stamp();
            if (!$this->id) {
                mysql_query("insert into " . $this->tabela . " (stamp_unosa) values ('" . $this->stamp_unosa . "')");
                $this->id = mysql_insert_id();
            }

            $this->naziv = addslashes($this->naziv);
            $this->stamp_izmene = stamp();

            $query = "update " . $this->tabela . " set ";
            $query .= "naziv='" . $this->naziv . "', ";
            $query .= "aktivno='" . $this->aktivno . "', ";
            $query .= "prioritet='" . $this->prioritet . "', ";

            $query .= " stamp_izmene='" . $this->stamp_izmene . "' where id=" . $this->id;
            $q = new ExecQuery($query);
            $this->rezultat_unosa = $q->result;

        }

        //---------------------------------------------------------------------------------------
        function brisanje()
        {
            if ($this->id) $this->rezultat_brisanja = mysql_query("delete from " . $this->tabela . " where id='" . $this->id . "' limit 1");
        }
        //---------------------------------------------------------------------------------------
    }

    ;
//-----------------------------------------------------------------------------------------
// ****************************************************************************************
//-----------------------------------------------------------------------------------------
    class podgrupa
    {
        var $id;
        var $parent;
        var $naziv;
        var $aktivno;
        var $prioritet;

        var $stamp_unosa;
        var $stamp_izmene;
        var $tabela;
        var $rezultat_unosa;
        var $rezultat_brisanja;

        //---------------------------------------------------------------------------------------
        function podgrupa($id = 0)
        {
            $this->tabela = TAB_PODGRUPE;

            if ($id) {
                $query = "select * from " . $this->tabela . " where id='" . $id . "'";
                $result = mysql_query($query);
                $row = mysql_fetch_array($result);
                $this->dodelaVrednosti($row);
            }
        }

        //---------------------------------------------------------------------------------------
        function dodelaVrednosti($row)
        {
            $this->id = $row['id'];
            $this->parent = $row['parent'];
            $this->naziv = stripslashes($row['naziv']);
            $this->aktivno = $row['aktivno'];
            $this->prioritet = $row['prioritet'];

            $this->stamp_unosa = $row['stamp_unosa'];
            $this->stamp_izmene = $row['stamp_izmene'];
        }

        //---------------------------------------------------------------------------------------
        function unos()
        {
            $this->stamp_unosa = stamp();
            if (!$this->id) {
                mysql_query("insert into " . $this->tabela . " (stamp_unosa) values ('" . $this->stamp_unosa . "')");
                $this->id = mysql_insert_id();
            }

            $this->naziv = addslashes($this->naziv);
            $this->stamp_izmene = stamp();

            $query = "update " . $this->tabela . " set ";
            $query .= "parent='" . $this->parent . "', ";
            $query .= "naziv='" . $this->naziv . "', ";
            $query .= "aktivno='" . $this->aktivno . "', ";
            $query .= "prioritet='" . $this->prioritet . "', ";

            $query .= " stamp_izmene='" . $this->stamp_izmene . "' where id=" . $this->id;
            $q = new ExecQuery($query);
            $this->rezultat_unosa = $q->result;

        }

        //---------------------------------------------------------------------------------------
        function brisanje()
        {
            if ($this->id) $this->rezultat_brisanja = mysql_query("delete from " . $this->tabela . " where id='" . $this->id . "' limit 1");
        }
        //---------------------------------------------------------------------------------------
    }

    ;


//-----------------------------------------------------------------------------------------
// ****************************************************************************************
//-----------------------------------------------------------------------------------------

    class clanak
    {
        var $id;
        var $parent;
        var $naslov;
        var $tekst_kratki;
        var $tekst;
        var $povezani1;
        var $povezani2;
        var $povezani3;
        var $povezani4;

        var $aktivno;
        var $prioritet;

        var $slike;

        var $stamp_unosa;
        var $stamp_izmene;
        var $tabela;
        var $rezultat_unosa;
        var $rezultat_brisanja;

        //---------------------------------------------------------------------------------------
        function clanak($id = 0)
        {
            $this->tabela = TAB_CLANCI;

            if ($id) {
                $query = "select * from " . $this->tabela . " where id='" . $id . "'";
                $result = mysql_query($query);
                $row = mysql_fetch_array($result);
                $this->dodelaVrednosti($row);
            }

            $this->slike = array();
            $i = 1;
            while ($i <= MAX_SLIKA_PO_CLANKU) {
                $this->slike[$i] = new slika(SL_CLANAK, $this->id, $i);
                $i++;
            }

        }

        //---------------------------------------------------------------------------------------
        function dodelaVrednosti($row)
        {
            $this->id = $row['id'];
            $this->parent = $row['parent'];
            $this->naslov = stripslashes($row['naslov']);
            $this->tekst_kratki = stripslashes($row['tekst_kratki']);
            $this->tekst = stripslashes($row['tekst']);
            $this->povezani1 = $row['povezani1'];
            $this->povezani2 = $row['povezani2'];
            $this->povezani3 = $row['povezani3'];
            $this->povezani4 = $row['povezani4'];

            $this->aktivno = $row['aktivno'];
            $this->prioritet = $row['prioritet'];

            $this->stamp_unosa = $row['stamp_unosa'];
            $this->stamp_izmene = $row['stamp_izmene'];
        }

        //---------------------------------------------------------------------------------------
        function unos()
        {
            global $app;
            $this->stamp_unosa = stamp();
            if (!$this->id) {
                mysql_query("insert into " . $this->tabela . " (stamp_unosa) values ('" . $this->stamp_unosa . "')");
                $this->id = mysql_insert_id();
                $i = 1;
                while ($i <= MAX_SLIKA_PO_CLANKU) {
                    $this->slike[$i]->id_objekta = $this->id;
                    $i++;
                }
            }

            $this->stamp_izmene = stamp();

            $query = "update " . $this->tabela . " set ";

            $query .= "parent='" . $this->parent . "', ";
            $query .= "naslov='" . addslashes($this->naslov) . "', ";
            $query .= "tekst_kratki='" . addslashes($this->tekst_kratki) . "', ";
            $query .= "tekst='" . addslashes($this->tekst) . "', ";
            $query .= "povezani1='" . $this->povezani1 . "', ";
            $query .= "povezani2='" . $this->povezani2 . "', ";
            $query .= "povezani3='" . $this->povezani3 . "', ";
            $query .= "povezani4='" . $this->povezani4 . "', ";

            $query .= "aktivno='" . $this->aktivno . "', ";
            $query .= "prioritet='" . $this->prioritet . "', ";

            $query .= " stamp_izmene='" . $this->stamp_izmene . "' where id=" . $this->id;
            $q = new ExecQuery($query);
            $this->rezultat_unosa = $q->result;

        }

        //---------------------------------------------------------------------------------------
        function brisanje()
        {
            $i = 1;
            while ($i <= MAX_SLIKA_PO_CLANKU) {
                if ($this->slike[$i]->naziv) $this->slike[$i]->brisanje();
                $i++;
            }
            if ($this->id) $this->rezultat_brisanja = mysql_query("delete from " . $this->tabela . " where id='" . $this->id . "' limit 1");
        }
        //---------------------------------------------------------------------------------------
    }

    ;
//-----------------------------------------------------------------------------------------
// ****************************************************************************************
//-----------------------------------------------------------------------------------------
    class vest
    {
        var $id;
        var $naslov;
        var $tekst_kratki;
        var $tekst;

        var $aktivno;
        var $prioritet;

        var $slike;

        var $stamp_unosa;
        var $stamp_izmene;
        var $tabela;
        var $rezultat_unosa;
        var $rezultat_brisanja;

        //---------------------------------------------------------------------------------------
        function vest($id = 0)
        {
            $this->tabela = TAB_VESTI;

            if ($id) {
                $query = "select * from " . $this->tabela . " where id='" . $id . "'";
                $result = mysql_query($query);
                $row = mysql_fetch_array($result);
                $this->dodelaVrednosti($row);
            }

            $this->slike = array();
            $i = 1;
            while ($i <= MAX_SLIKA_PO_VESTI) {
                $this->slike[$i] = new slika(SL_VEST, $this->id, $i);
                $i++;
            }

        }

        //---------------------------------------------------------------------------------------
        function dodelaVrednosti($row)
        {
            $this->id = $row['id'];
            $this->naslov = stripslashes($row['naslov']);
            $this->tekst_kratki = stripslashes($row['tekst_kratki']);
            $this->tekst = stripslashes($row['tekst']);

            $this->aktivno = $row['aktivno'];
            $this->prioritet = $row['prioritet'];

            $this->stamp_unosa = $row['stamp_unosa'];
            $this->stamp_izmene = $row['stamp_izmene'];
        }

        //---------------------------------------------------------------------------------------
        function unos()
        {
            global $app;
            $this->stamp_unosa = stamp();
            if (!$this->id) {
                mysql_query("insert into " . $this->tabela . " (stamp_unosa) values ('" . $this->stamp_unosa . "')");
                $this->id = mysql_insert_id();
                $i = 1;
                while ($i <= MAX_SLIKA_PO_CLANKU) {
                    $this->slike[$i]->id_objekta = $this->id;
                    $i++;
                }
            }

            $this->stamp_izmene = stamp();

            $query = "update " . $this->tabela . " set ";

            $query .= "naslov='" . addslashes($this->naslov) . "', ";
            $query .= "tekst_kratki='" . addslashes($this->tekst_kratki) . "', ";
            $query .= "tekst='" . addslashes($this->tekst) . "', ";

            $query .= "aktivno='" . $this->aktivno . "', ";
            $query .= "prioritet='" . $this->prioritet . "', ";

            $query .= " stamp_izmene='" . $this->stamp_izmene . "' where id=" . $this->id;
            $q = new ExecQuery($query);
            $this->rezultat_unosa = $q->result;

        }

        //---------------------------------------------------------------------------------------
        function brisanje()
        {
            $i = 1;
            while ($i <= MAX_SLIKA_PO_VESTI) {
                if ($this->slike[$i]->naziv) $this->slike[$i]->brisanje();
                $i++;
            }
            if ($this->id) $this->rezultat_brisanja = mysql_query("delete from " . $this->tabela . " where id='" . $this->id . "' limit 1");
        }
        //---------------------------------------------------------------------------------------
    }

    ;
//-----------------------------------------------------------------------------------------
// ****************************************************************************************
//-----------------------------------------------------------------------------------------
    class uvod
    {
        var $id;
        var $grupa;
        var $naziv;
        var $naslov;
        var $tekst;

        var $stamp_unosa;
        var $stamp_izmene;
        var $tabela;
        var $rezultat_unosa;
        var $rezultat_brisanja;

        //---------------------------------------------------------------------------------------
        function uvod($grupa = 0)
        {
            $this->tabela = TAB_UVODI;

            $query = "select * from " . $this->tabela . " where grupa='" . $grupa . "'";
            $result = mysql_query($query);
            $row = mysql_fetch_array($result);
            $this->dodelaVrednosti($row);

        }

        //---------------------------------------------------------------------------------------
        function dodelaVrednosti($row)
        {
            $this->id = $row['id'];
            $this->grupa = $row['grupa'];
            $this->naziv = $row['naziv'];
            $this->naslov = stripslashes($row['naslov']);
            $this->tekst = stripslashes($row['tekst']);

            $this->stamp_unosa = $row['stamp_unosa'];
            $this->stamp_izmene = $row['stamp_izmene'];
        }

        //---------------------------------------------------------------------------------------
        function unos()
        {
            global $app;
            $this->stamp_unosa = stamp();
            if (!$this->id) {
                mysql_query("insert into " . $this->tabela . " (stamp_unosa) values ('" . $this->stamp_unosa . "')");
                $this->id = mysql_insert_id();
            }

            $this->stamp_izmene = stamp();

            $query = "update " . $this->tabela . " set ";
            $query .= "grupa='" . $this->grupa . "', ";
            $query .= "naziv='" . $this->naziv . "', ";
            $query .= "naslov='" . addslashes($this->naslov) . "', ";
            $query .= "tekst='" . addslashes($this->tekst) . "', ";


            $query .= " stamp_izmene='" . $this->stamp_izmene . "' where id=" . $this->id;
            $q = new ExecQuery($query);
            $this->rezultat_unosa = $q->result;

        }

        //---------------------------------------------------------------------------------------
        function brisanje()
        {
            if ($this->id) $this->rezultat_brisanja = mysql_query("delete from " . $this->tabela . " where id='" . $this->id . "' limit 1");
        }
        //---------------------------------------------------------------------------------------
    }

    ;
//-----------------------------------------------------------------------------------------
// ****************************************************************************************
//-----------------------------------------------------------------------------------------
    class stranica
    {
        var $id;
        var $naziv;
        var $naslov;
        var $tekst;

        var $stamp_unosa;
        var $stamp_izmene;
        var $tabela;
        var $rezultat_unosa;
        var $rezultat_brisanja;

        //---------------------------------------------------------------------------------------
        function stranica($id = 0)
        {
            $this->tabela = TAB_STRANICE;

            if ($id) {
                $query = "select * from " . $this->tabela . " where id='" . $id . "'";
                $result = mysql_query($query);
                $row = mysql_fetch_array($result);
                $this->dodelaVrednosti($row);
            }

            $this->slike = array();
            $i = 1;
            while ($i <= MAX_SLIKA_PO_STRANICI) {
                $this->slike[$i] = new slika(SL_STRANICA, $this->id, $i);
                $i++;
            }

        }

        //---------------------------------------------------------------------------------------
        function dodelaVrednosti($row)
        {
            $this->id = $row['id'];
            $this->naziv = $row['naziv'];
            $this->naslov = stripslashes($row['naslov']);
            $this->tekst = stripslashes($row['tekst']);

            $this->stamp_unosa = $row['stamp_unosa'];
            $this->stamp_izmene = $row['stamp_izmene'];
        }

        //---------------------------------------------------------------------------------------
        function unos()
        {
            global $app;
            $this->stamp_unosa = stamp();
            if (!$this->id) {
                mysql_query("insert into " . $this->tabela . " (stamp_unosa) values ('" . $this->stamp_unosa . "')");
                $this->id = mysql_insert_id();

                $i = 1;
                while ($i <= MAX_SLIKA_PO_STRANICI) {
                    $this->slike[$i]->id_objekta = $this->id;
                    $i++;
                }
            }

            $this->stamp_izmene = stamp();

            $query = "update " . $this->tabela . " set ";
            $query .= "naziv='" . $this->naziv . "', ";
            $query .= "naslov='" . addslashes($this->naslov) . "', ";
            $query .= "tekst='" . addslashes($this->tekst) . "', ";


            $query .= " stamp_izmene='" . $this->stamp_izmene . "' where id=" . $this->id;
            $q = new ExecQuery($query);
            $this->rezultat_unosa = $q->result;

        }

        //---------------------------------------------------------------------------------------
        function brisanje()
        {
            $i = 1;
            while ($i <= MAX_SLIKA_PO_STRANICI) {
                if ($this->slike[$i]->naziv) $this->slike[$i]->brisanje();
                $i++;
            }

            if ($this->id) $this->rezultat_brisanja = mysql_query("delete from " . $this->tabela . " where id='" . $this->id . "' limit 1");
        }
        //---------------------------------------------------------------------------------------
    }

    ;
//-----------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------
    function defaultGrupa()
    {
        $q = new query("select id from " . TAB_GRUPE . " where id>0 order by prioritet desc, naziv limit 1");
        return $q->row[0];
    }

//-----------------------------------------------------------------------------------------
    function defaultPodgrupa($grupa)
    {
        $q = new query("select id from " . TAB_PODGRUPE . " where parent='" . $grupa . "' order by prioritet desc, naziv limit 1");
        return $q->row[0];
    }

//-----------------------------------------------------------------------------------------
// ****************************************************************************************
//-----------------------------------------------------------------------------------------
    function appHeader($grupa = 0, $podgrupa = 0, $naslov = "", $meta_description = "", $meta_keywords = "")
    {
        // $grupa==0    -     Home
        // $grupa==1    -     Brak
        // $grupa==2    -     Muskarci
        // $grupa==3    -     Zene
        // $grupa==4    -     Deca
        // $grupa==5    -     Duh i telo


        // $grupa==100    -   Kontakt
        // $grupa==101    -   Vesti

        // $grupa==201    -   O nama
        // $grupa==202    -   Mediji

        // $grupa==204    -   Vikend za secanje
        // $grupa==205    -   Kamp ocevi i sinovi
        // $grupa==206    -   Upomoc ja se zenim
        // $grupa==207    -   Bracno savetovanje


        if (!$grupa) $grupa = 0;

        $uvod = new uvod($grupa);
        if (!$uvod->naziv) $uvod = new uvod(0);

        ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
                "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <title>Brak i Porodica</title>
            <link href="include/style.css" rel="stylesheet" type="text/css"/>
            <link href="include/lightbox.css" rel="stylesheet" type="text/css"/>
            <script type="text/javascript" src="include/jquery.js"></script>
            <script type="text/javascript" src="include/jquery.lightbox.js"></script>

            <script language="JavaScript">
                function preloader() {
                    var gornji_meni_home = new Image();
                    gornji_meni_home.src = "img/gornji_meni_home.jpg";
                    var gornji_meni_brak = new Image();
                    gornji_meni_brak.src = "img/gornji_meni_brak.jpg";
                    var gornji_meni_muskarci = new Image();
                    gornji_meni_muskarci.src = "img/gornji_meni_muskarci.jpg";
                    var gornji_meni_zene = new Image();
                    gornji_meni_zene.src = "img/gornji_meni_zene.jpg";
                    var gornji_meni_deca = new Image();
                    gornji_meni_deca.src = "img/gornji_meni_deca.jpg";
                    var gornji_meni_duhutelo = new Image();
                    gornji_meni_duhutelo.src = "img/gornji_meni_duhutelo.jpg";

                    var gornji_meni_home_over = new Image();
                    gornji_meni_home_over.src = "img/gornji_meni_home_over.jpg";
                    var gornji_meni_brak_over = new Image();
                    gornji_meni_brak_over.src = "img/gornji_meni_brak_over.jpg";
                    var gornji_meni_muskarci_over = new Image();
                    gornji_meni_muskarci_over.src = "img/gornji_meni_muskarci_over.jpg";
                    var gornji_meni_zene_over = new Image();
                    gornji_meni_zene_over.src = "img/gornji_meni_zene_over.jpg";
                    var gornji_meni_deca_over = new Image();
                    gornji_meni_deca_over.src = "img/gornji_meni_deca_over.jpg";
                    var gornji_meni_duhutelo_over = new Image();
                    gornji_meni_duhutelo_over.src = "img/gornji_meni_duhutelo_over.jpg";

                    var gornji_meni_home_active = new Image();
                    gornji_meni_home_active.src = "img/gornji_meni_home_active.jpg";
                    var gornji_meni_brak_active = new Image();
                    gornji_meni_brak_active.src = "img/gornji_meni_brak_active.jpg";
                    var gornji_meni_muskarci_active = new Image();
                    gornji_meni_muskarci_active.src = "img/gornji_meni_muskarci_active.jpg";
                    var gornji_meni_zene_active = new Image();
                    gornji_meni_zene_active.src = "img/gornji_meni_zene_active.jpg";
                    var gornji_meni_deca_active = new Image();
                    gornji_meni_deca_active.src = "img/gornji_meni_deca_active.jpg";
                    var gornji_meni_duhutelo_active = new Image();
                    gornji_meni_duhutelo_active.src = "img/gornji_meni_duhutelo_active.jpg";

                    var levi_meni = new Image();
                    levi_meni.src = "img/levi_meni.gif";
                    var levi_meni_over = new Image();
                    levi_meni_over.src = "img/levi_meni_over.gif";
                    var levi_meni_active = new Image();
                    levi_meni_active.src = "img/levi_meni_active.gif";

                    var postavite_pitanje = new Image();
                    postavite_pitanje.src = "img/postavite_pitanje.jpg";
                    var postavite_pitanje_over = new Image();
                    postavite_pitanje_over.src = "img/postavite_pitanje_over.jpg";

                    var cetiri_kategorije_vikend = new Image();
                    cetiri_kategorije_vikend.src = "img/cetiri_kategorije_vikend.jpg";
                    var cetiri_kategorije_vikend_over = new Image();
                    cetiri_kategorije_vikend_over.src = "img/cetiri_kategorije_vikend_over.jpg";
                    var cetiri_kategorije_vikend_active = new Image();
                    cetiri_kategorije_vikend_active.src = "img/cetiri_kategorije_vikend_active.jpg";

                    var cetiri_kategorije_kamp = new Image();
                    cetiri_kategorije_kamp.src = "img/cetiri_kategorije_kamp.jpg";
                    var cetiri_kategorije_kamp_over = new Image();
                    cetiri_kategorije_kamp_over.src = "img/cetiri_kategorije_kamp_over.jpg";
                    var cetiri_kategorije_kamp_active = new Image();
                    cetiri_kategorije_kamp_active.src = "img/cetiri_kategorije_kamp_active.jpg";

                    var cetiri_kategorije_upomoc = new Image();
                    cetiri_kategorije_upomoc.src = "img/cetiri_kategorije_upomoc.jpg";
                    var cetiri_kategorije_upomoc_over = new Image();
                    cetiri_kategorije_upomoc_over.src = "img/cetiri_kategorije_upomoc_over.jpg";
                    var cetiri_kategorije_upomoc_active = new Image();
                    cetiri_kategorije_upomoc_active.src = "img/cetiri_kategorije_upomoc_active.jpg";

                    var cetiri_kategorije_savetovanje = new Image();
                    cetiri_kategorije_savetovanje.src = "img/cetiri_kategorije_savetovanje.jpg";
                    var cetiri_kategorije_savetovanje_over = new Image();
                    cetiri_kategorije_savetovanje_over.src = "img/cetiri_kategorije_savetovanje_over.jpg";
                    var cetiri_kategorije_savetovanje_active = new Image();
                    cetiri_kategorije_savetovanje_active.src = "img/cetiri_kategorije_savetovanje_active.jpg";

                }

            </script>


        </head>

        <body>
        <script language="JavaScript">
            preloader();
        </script>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" id="tabGlavna">
        <tr>
            <td id="bg_levo_2_1"></td>
            <td id="bg_levo_1_1"></td>
            <td id="bg_sredina_1_1"></td>
            <td id="bg_desno_1_1"></td>
            <td id="bg_desno_2_1"></td>
        </tr>
        <tr>
            <td id="bg_levo_2_2"></td>
            <td id="bg_levo_1_2"></td>
            <td id="bg_sredina_1_2">
                <table border="0" cellpadding="0" cellspacing="0" id="tabGornjiMeni">
                    <tr>
                        <td width="16">&nbsp;</td>
                        <?php
                        if ($grupa == 0) echo "<td><img src=\"img/gornji_meni_home_active.jpg\" alt=\"home\" border=\"0\" /></td>";
                        else echo "<td><a href=\"index.php\"><img src=\"img/gornji_meni_home.jpg\" alt=\"home\" border=\"0\" id=\"gornji_meni_home\" onmouseover=\"gornjiMeniHomeOver()\" onmouseout=\"gornjiMeniHomeOut()\" /></a></td>";

                        if ($grupa == 1) echo "<td><img src=\"img/gornji_meni_brak_active.jpg\" alt=\"brak\" border=\"0\" /></td>";
                        else echo "<td><a href=\"tekstovi.php?grupa=1\"><img src=\"img/gornji_meni_brak.jpg\" alt=\"brak\" border=\"0\" id=\"gornji_meni_brak\" onmouseover=\"gornjiMeniBrakOver()\" onmouseout=\"gornjiMeniBrakOut()\" /></a></td>";

                        if ($grupa == 2) echo "<td><img src=\"img/gornji_meni_muskarci_active.jpg\" alt=\"muskarci\" border=\"0\" /></td>";
                        else echo "<td><a href=\"tekstovi.php?grupa=2\"><img src=\"img/gornji_meni_muskarci.jpg\" alt=\"muskarac\" border=\"0\" id=\"gornji_meni_muskarci\" onmouseover=\"gornjiMeniMuskarciOver()\" onmouseout=\"gornjiMeniMuskarciOut()\" /></a></td>";

                        if ($grupa == 3) echo "<td><img src=\"img/gornji_meni_zene_active.jpg\" alt=\"zene\" border=\"0\" /></td>";
                        else echo "<td><a href=\"tekstovi.php?grupa=3\"><img src=\"img/gornji_meni_zene.jpg\" alt=\"zene\" border=\"0\" id=\"gornji_meni_zene\" onmouseover=\"gornjiMeniZeneOver()\" onmouseout=\"gornjiMeniZeneOut()\" /></a></td>";

                        if ($grupa == 4) echo "<td><img src=\"img/gornji_meni_deca_active.jpg\" alt=\"deca\" border=\"0\" /></td>";
                        else echo "<td><a href=\"tekstovi.php?grupa=4\"><img src=\"img/gornji_meni_deca.jpg\" alt=\"deca\" border=\"0\" id=\"gornji_meni_deca\" onmouseover=\"gornjiMeniDecaOver()\" onmouseout=\"gornjiMeniDecaOut()\" /></a></td>";

                        if ($grupa == 5) echo "<td><img src=\"img/gornji_meni_duhitelo_active.jpg\" alt=\"duhitelo\" border=\"0\" /></td>";
                        else echo "<td><a href=\"tekstovi.php?grupa=5\"><img src=\"img/gornji_meni_duhitelo.jpg\" alt=\"duh i telo\" border=\"0\" id=\"gornji_meni_duhitelo\" onmouseover=\"gornjiMeniDuhiteloOver()\" onmouseout=\"gornjiMeniDuhiteloOut()\" /></a></td>";


                        if ($grupa == 1 || $grupa == 2 || $grupa == 3 || $grupa == 4 || $grupa == 5 || $grupa == 100) echo "<td></td>";
                        else echo "<td><img src=\"img/gornji_meni_glava.jpg\" /></td>";  // Na indexu (i na nedefinisanim stranama) ide glava onog majmuna

                        ?>
                    </tr>
                </table>
            </td>
            <td id="bg_desno_1_2"></td>
            <td id="bg_desno_2_2"></td>
        </tr>

    <?php
    if ($grupa == 1 || $grupa == 2 || $grupa == 3 || $grupa == 4 || $grupa == 5 || $grupa == 100)
    {
    ?>
        <tr>
            <td id="bg_levo_2_3"></td>
            <td id="bg_levo_1_3"></td>
            <td id="bg_sredina_1_3"></td>
            <td id="bg_desno_1_3"></td>
            <td id="bg_desno_2_3"></td>
        </tr>
        <?php
    }
    else
    {
        ?>
        <tr>
            <td id="bg_levo_2_3_a"></td>
            <td id="bg_levo_1_3_a"></td>
            <td id="bg_sredina_1_3_a"></td>
            <td id="bg_desno_1_3_a"></td>
            <td id="bg_desno_2_3_a"></td>
        </tr>
    <?php
    }
    ?>
        <tr>
            <td id="bg_levo_2_4"></td>
            <td id="bg_levo_1_4"></td>
            <td id="bg_sredina_1_4">

                <table border="0" cellpadding="0" cellspacing="0" id="tabHeader">
                    <tr>
                        <td width="260" height="334">
                            <div id="divUvod"><?php echo nl2br($uvod->tekst); ?></div>
                        </td>
                        <td valign="top">
                            <?php


                            if ($grupa == 1) echo "<img src=\"img/glavna_slika_brak.jpg\" width=\"575\" height=\"334\" />";
                            else if ($grupa == 2) echo "<img src=\"img/glavna_slika_muskarac.jpg\" width=\"575\" height=\"334\" />";
                            else if ($grupa == 3) echo "<img src=\"img/glavna_slika_zena.jpg\" width=\"575\" height=\"334\" />";
                            else if ($grupa == 4) echo "<img src=\"img/glavna_slika_deca.jpg\" width=\"575\" height=\"334\" />";
                            else if ($grupa == 5) echo "<img src=\"img/glavna_slika_duhitelo.jpg\" width=\"575\" height=\"334\" />";
                            else if ($grupa == 100) echo "<img src=\"img/glavna_slika_kontakt.jpg\" width=\"575\" height=\"334\" />";
                            else echo "<img src=\"img/glavna_slika_home.jpg\" width=\"575\" height=\"334\" />";


                            /*
if ($grupa==1) echo "<img src='img/glavna_slika_brak.jpg' />";
else if ($grupa==2) echo "<img src='img/glavna_slika_muskarac.jpg' />";
else if ($grupa==3) echo "<img src='img/glavna_slika_zena.jpg' />";
else if ($grupa==4) echo "<img src='img/glavna_slika_deca.jpg' />";
else if ($grupa==5) echo "<img src='img/glavna_slika_duhitelo.jpg' />";
else if ($grupa==100) echo "<img src='img/glavna_slika_kontakt.jpg' />";
else echo "<img src='img/glavna_slika_home.jpg' />";
    */


                            ?></td>
                    </tr>
                </table>

            </td>
            <td id="bg_desno_1_4"></td>
            <td id="bg_desno_2_4"></td>
        </tr>
        <tr>
        <td id="bg_levo_2_5"></td>
        <td id="bg_levo_1_5"></td>
        <td id="bg_sredina_1_5"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="tabCentralna">
        <tr>
        <td width="260" height="730" valign="top">

            <?php
            $q_p = new query("select id from " . TAB_PODGRUPE . " where parent='" . $grupa . "' and aktivno=1 order by prioritet desc, naziv");

            //if ($q_p->rows)
            if (1)
            {
            ?>
            <table border="0" align="right" cellpadding="0" cellspacing="0" id="tabLeviMeni">
                <tr>
                    <td width="200">&nbsp;</td>
                    <td width="50" height="25">&nbsp;</td>
                </tr>

                <?php
                }

                if ($grupa != 6) {
                    for ($i_p = 0; $i_p < $q_p->rows; $i_p++) {
                        $p = new podgrupa($q_p->row[0]);
                        if ($p->id == $podgrupa) {
                            echo "
          <tr>
            <td id=\"leviMeniTd_" . $p->id . "\" class=\"leviMeniActive\"><a href=\"tekstovi.php?grupa=" . $grupa . "&podgrupa=" . $p->id . "\">" . $p->naziv . "</a></td>
            <td><div align=\"center\"><a href=\"tekstovi.php?grupa=" . $grupa . "&podgrupa=" . $p->id . "\"><img src=\"img/levi_meni_active.gif\" border=\"0\" /></a></div></td>
          </tr>    
    ";
                        } else {
                            echo "
          <tr>
            <td id=\"leviMeniTd_" . $p->id . "\" class=\"leviMeni\" onmouseover=\"leviMeniOver(" . $p->id . ")\" onmouseout=\"leviMeniOut(" . $p->id . ")\"><a href=\"tekstovi.php?grupa=" . $grupa . "&podgrupa=" . $p->id . "\">" . $p->naziv . "</a></td>
            <td><div align=\"center\"><a href=\"tekstovi.php?grupa=" . $grupa . "&podgrupa=" . $p->id . "\"><img src=\"img/levi_meni.gif\" border=\"0\" id=\"leviMeniIco_" . $p->id . "\" onmouseover=\"leviMeniOver(" . $p->id . ")\" onmouseout=\"leviMeniOut(" . $p->id . ")\" /></a></div></td>
          </tr> 
     ";
                        }
                        unset($p);
                        $q_p->fetchRow();
                    }
                }

                if ($q_p->rows) {
                    ?>


                    <tr>
                        <td colspan="2" height="30">&nbsp;</td>
                    </tr>
                    <?php
                }


                if ($grupa == 203) echo "<tr><td colspan=\"2\"><img src=\"img/cetiri_kategorije_vikend_active.jpg\" width=\"260\" height=\"117\" border=\"0\" alt=\"vikend za secanje\" id=\"cetiri_kategorije_vikend\" /></td></tr>";
                else echo "<tr><td colspan=\"2\"><a href=\"stranica.php?id=3\"><img src=\"img/cetiri_kategorije_vikend.jpg\" width=\"260\" height=\"117\" border=\"0\" alt=\"vikend za secanje\" id=\"cetiri_kategorije_vikend\" onmouseover=\"cetiriKategorijeVikendOver()\" onmouseout=\"cetiriKategorijeVikendOut()\" /></a></td></tr>";

                if ($grupa == 204) echo "<tr><td colspan=\"2\"><img src=\"img/cetiri_kategorije_kamp_active.jpg\" width=\"260\" height=\"116\" border=\"0\" alt=\"kamp ocevi i sinovi\" id=\"cetiri_kategorije_kamp\" /></td></tr>";
                else echo "<tr><td colspan=\"2\"><a href=\"stranica.php?id=4\"><img src=\"img/cetiri_kategorije_kamp.jpg\" width=\"260\" height=\"116\" border=\"0\" alt=\"kamp ocevi i sinovi\" id=\"cetiri_kategorije_kamp\" onmouseover=\"cetiriKategorijeKampOver()\" onmouseout=\"cetiriKategorijeKampOut()\" /></a></td></tr>";

                if ($grupa == 205) echo "<tr><td colspan=\"2\"><img src=\"img/cetiri_kategorije_upomoc_active.jpg\" width=\"260\" height=\"116\" border=\"0\" alt=\"upomoc ja se zenim\" id=\"cetiri_kategorije_upomoc\" /></td></tr>";
                else echo "<tr><td colspan=\"2\"><a href=\"stranica.php?id=5\"><img src=\"img/cetiri_kategorije_upomoc.jpg\" width=\"260\" height=\"116\" border=\"0\" alt=\"upomoc ja se zenim\" id=\"cetiri_kategorije_upomoc\" onmouseover=\"cetiriKategorijeUpomocOver()\" onmouseout=\"cetiriKategorijeUpomocOut()\" /></a></td></tr>";

                if ($grupa == 206) echo "<tr><td colspan=\"2\"><img src=\"img/cetiri_kategorije_savetovanje_active.jpg\" width=\"260\" height=\"116\" border=\"0\" alt=\"bracno savetovanje\" id=\"cetiri_kategorije_savetovanje\" /></td></tr>";
                else echo "<tr><td colspan=\"2\"><a href=\"stranica.php?id=6\"><img src=\"img/cetiri_kategorije_savetovanje.jpg\" width=\"260\" height=\"116\" border=\"0\" alt=\"bracno savetovanje\" id=\"cetiri_kategorije_savetovanje\" onmouseover=\"cetiriKategorijeSavetovanjeOver()\" onmouseout=\"cetiriKategorijeSavetovanjeOut()\" /></a></td></tr>";


                /*
          <tr>
            <td colspan="2"><a href="index.html"><img src="img/cetiri_kategorije_vikend.jpg" width="260" height="117" border="0" alt="vikend za secanje" id="cetiri_kategorije_vikend" onmouseover="cetiriKategorijeVikendOver()" onmouseout="cetiriKategorijeVikendOut()" /></a></td>
            </tr>
          <tr>
            <td colspan="2"><a href="index.html"><img src="img/cetiri_kategorije_kamp.jpg" width="260" height="116" border="0" alt="kamp ocevi i sinovi" id="cetiri_kategorije_kamp" onmouseover="cetiriKategorijeKampOver()" onmouseout="cetiriKategorijeKampOut()" /></a></td>
            </tr>
          <tr>
            <td colspan="2"><img src="img/cetiri_kategorije_upomoc_active.jpg" width="260" height="116" border="0" alt="upomoc ja se zenim" id="cetiri_kategorije_upomoc" /></td>
            </tr>
          <tr>
            <td colspan="2"><a href="index.html"><img src="img/cetiri_kategorije_savetovanje.jpg" width="260" height="116" border="0" alt="bracno savetovanje" id="cetiri_kategorije_savetovanje" onmouseover="cetiriKategorijeSavetovanjeOver()" onmouseout="cetiriKategorijeSavetovanjeOut()" /></a></td>
          </tr>
";
*/


                //if ($q_p->rows)
                if (1)
                {
                ?>
            </table>
        <?php
        }


        ?>


        </td>
        <td valign="top">
        <div id="divSadrzaj">


        <?php
    }

//-----------------------------------------------------------------------------------------
    function appFooter($grupa = 0)
    {

        if (!$grupa) $grupa = 0;

        ?>

        </div>
        </td>
        </tr>
        </table></td>
        <td id="bg_desno_1_5"></td>
        <td id="bg_desno_2_5">&nbsp;</td>
        </tr>
        <tr>
            <td id="bg_levo_2_6">&nbsp;</td>
            <td id="bg_levo_1_6"></td>
            <td id="bg_sredina_1_6">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" id="tabFooter">
                    <tr>
                        <td width="260" height="88"><a href="kontakt.php"><img src="img/postavite_pitanje.jpg"
                                                                               alt="postavite pitanje" width="260"
                                                                               height="88" border="0"
                                                                               id="postavitePitanje"
                                                                               onmouseover="postavitePitanjeOver()"
                                                                               onmouseout="postavitePitanjeOut()"/></a>
                        </td>
                        <td>
                            <div id="divDonjiMeni">
                                <table border="0" cellpadding="0" cellspacing="0" id="tabDonjiMeni">
                                    <tr>
                                        <?php

                                        if ($grupa == 0) echo "<td width=\"50\" class=\"donjiMeniActive\">Home</td>";
                                        else echo "<td width=\"50\" class=\"donjiMeni\"><a href=\"index.php\">Home</a></td>";

                                        echo "<td><img src=\"img/donji_meni_sep.gif\" /></td>";

                                        if ($grupa == 201) echo "<td width=\"70\" class=\"donjiMeniActive\">O&nbsp;nama</td>";
                                        else echo "<td width=\"70\" class=\"donjiMeni\"><a href=\"stranica.php?id=1\">O&nbsp;nama</a></td>";

                                        echo "<td><img src=\"img/donji_meni_sep.gif\" /></td>";

                                        if ($grupa == 202) echo "<td width=\"60\" class=\"donjiMeniActive\">Mediji</td>";
                                        else echo "<td width=\"60\" class=\"donjiMeni\"><a href=\"mediji.php\">Mediji</a></td>";

                                        echo "<td><img src=\"img/donji_meni_sep.gif\" /></td>";

                                        if ($grupa == 101) echo "<td width=\"55\" class=\"donjiMeniActive\">Vesti</td>";
                                        else echo "<td width=\"55\" class=\"donjiMeni\"><a href=\"vesti.php\">Vesti</a></td>";

                                        echo "<td><img src=\"img/donji_meni_sep.gif\" /></td>";

                                        if ($grupa == 100) echo "<td width=\"55\" class=\"donjiMeniActive\">Kontakt</td>";
                                        else echo "<td width=\"55\" class=\"donjiMeni\"><a href=\"kontakt.php\">Kontakt</a></td>";


                                        ?>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td width="150">
                            <div id="divWebDesignBy"><img src="img/webdesingby.jpg" border="0"
                                                          alt="web design by Zokara"/></div>
                        </td>
                    </tr>
                </table>
            </td>
            <td id="bg_desno_1_6"></td>
            <td id="bg_desno_2_6">&nbsp;</td>
        </tr>
        <tr>
            <td id="bg_levo_2_7">&nbsp;</td>
            <td id="bg_levo_1_7"></td>
            <td id="bg_sredina_1_7">&nbsp;</td>
            <td id="bg_desno_1_7"></td>
            <td id="bg_desno_2_7">&nbsp;</td>
        </tr>
        </table>


        <script language="JavaScript">

            function gornjiMeniHomeOver() {
                $("#gornji_meni_home").attr("src", "img/gornji_meni_home_over.jpg");
            }

            function gornjiMeniHomeOut() {
                $("#gornji_meni_home").attr("src", "img/gornji_meni_home.jpg");
            }

            function gornjiMeniBrakOver() {
                $("#gornji_meni_brak").attr("src", "img/gornji_meni_brak_over.jpg");
            }

            function gornjiMeniBrakOut() {
                $("#gornji_meni_brak").attr("src", "img/gornji_meni_brak.jpg");
            }

            function gornjiMeniMuskarciOver() {
                $("#gornji_meni_muskarci").attr("src", "img/gornji_meni_muskarci_over.jpg");
            }

            function gornjiMeniMuskarciOut() {
                $("#gornji_meni_muskarci").attr("src", "img/gornji_meni_muskarci.jpg");
            }

            function gornjiMeniZeneOver() {
                $("#gornji_meni_zene").attr("src", "img/gornji_meni_zene_over.jpg");
            }

            function gornjiMeniZeneOut() {
                $("#gornji_meni_zene").attr("src", "img/gornji_meni_zene.jpg");
            }

            function gornjiMeniDecaOver() {
                $("#gornji_meni_deca").attr("src", "img/gornji_meni_deca_over.jpg");
            }

            function gornjiMeniDecaOut() {
                $("#gornji_meni_deca").attr("src", "img/gornji_meni_deca.jpg");
            }

            function gornjiMeniDuhiteloOver() {
                $("#gornji_meni_duhitelo").attr("src", "img/gornji_meni_duhitelo_over.jpg");
            }

            function gornjiMeniDuhiteloOut() {
                $("#gornji_meni_duhitelo").attr("src", "img/gornji_meni_duhitelo.jpg");
            }


            function leviMeniOver(id) {
                $("#leviMeniIco_" + id).attr("src", "img/levi_meni_over.gif");
                $("#leviMeniTd_" + id).attr("class", "leviMeniHover");
            }

            function leviMeniOut(id) {
                $("#leviMeniIco_" + id).attr("src", "img/levi_meni.gif");
                $("#leviMeniTd_" + id).attr("class", "leviMeni");
            }


            function postavitePitanjeOver() {
                $("#postavitePitanje").attr("src", "img/postavite_pitanje_over.jpg");
            }

            function postavitePitanjeOut() {
                $("#postavitePitanje").attr("src", "img/postavite_pitanje.jpg");
            }


            function cetiriKategorijeVikendOver() {
                $("#cetiri_kategorije_vikend").attr("src", "img/cetiri_kategorije_vikend_over.jpg");
            }

            function cetiriKategorijeVikendOut() {
                $("#cetiri_kategorije_vikend").attr("src", "img/cetiri_kategorije_vikend.jpg");
            }

            function cetiriKategorijeKampOver() {
                $("#cetiri_kategorije_kamp").attr("src", "img/cetiri_kategorije_kamp_over.jpg");
            }

            function cetiriKategorijeKampOut() {
                $("#cetiri_kategorije_kamp").attr("src", "img/cetiri_kategorije_kamp.jpg");
            }

            function cetiriKategorijeUpomocOver() {
                $("#cetiri_kategorije_upomoc").attr("src", "img/cetiri_kategorije_upomoc_over.jpg");
            }

            function cetiriKategorijeUpomocOut() {
                $("#cetiri_kategorije_upomoc").attr("src", "img/cetiri_kategorije_upomoc.jpg");
            }

            function cetiriKategorijeSavetovanjeOver() {
                $("#cetiri_kategorije_savetovanje").attr("src", "img/cetiri_kategorije_savetovanje_over.jpg");
            }

            function cetiriKategorijeSavetovanjeOut() {
                $("#cetiri_kategorije_savetovanje").attr("src", "img/cetiri_kategorije_savetovanje.jpg");
            }


            $(function () {

                $(".galerija").lightBox();


            });

        </script>


        </body>
        </html>


        <?php
    }
//-----------------------------------------------------------------------------------------
// ****************************************************************************************
//-----------------------------------------------------------------------------------------

endif;

?>
