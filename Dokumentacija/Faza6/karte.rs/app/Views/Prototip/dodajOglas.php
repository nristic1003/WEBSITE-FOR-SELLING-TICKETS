
<div id="main">
   <h1 align="center"><?php echo $naslov?></h1>

   <form class="formaKarte" action="<?php if($news!=null)echo site_url($opis.'/azurirajOglas/'.$news[0]->IdD); else echo site_url($opis.'/ubaciOglas');?>" enctype="multipart/form-data" method="post">
	<ul class="form-style-1 prodajaKarata">
    <li><label>Naziv:<span class="required">*</span></label>
        <input id="naziv" type="text" name="naziv" class="field-long" placeholder="Naziv dogadjaja" value="<?php if($news!=null)echo $news[0]->Naziv;?>"/> </li>
        <div id="naziv_error">Molimo Vas da unesete Naziv</div>

        <li>
            <label>Broj Karata: <span class="required">*</span></label>
            <input id="brojkarata" type="number" name="brojkarata" class="field-long" value="<?php if($news!=null)echo $news[0]->BrojKarata;?>"/>
            <div id="brojkarata_error">Molimo Vas da unesete Broj Karata</div>
        </li>
        <li>
            <label>Cena: <span class="required">*</span></label>
            <input id="cena" type="number" name="cena" class="field-long" value="<?php if($news!=null)echo $news[0]->Cena;?>"/>
            <div id="cena_error">Molimo Vas da unesete Cenu</div>
        </li>
    <li>
        <label>Datum: <span class="required">*</span></label>
        <input id="datum" type="date" name="datum" class="field-long" placeholder="Datum dogadjaja" 
            value="<?php if($news!=null){ 
                $arr = explode(' ', $news[0]->Datum, 2);
                echo $arr[0];
            }
            ?>"/>
        <div id="datum_error">Molimo Vas da unesete Datum</div>
    </li>
    <li>
        <label>Vreme: <span class="required">*</span></label>
        <input id="vreme" type="time" name="vreme" class="field-long"" placeholder="Vreme dogadjaja" 
               value="<?php if($news!=null){ 
                //$arr = explode(' ', $news[0]->Datum, 2);
                echo $arr[1];
            }
            ?>"/>
        <div id="vreme_error">Molimo Vas da unesete Vreme</div>
    </li>
	 <li>
        <label>Lokacija <span class="required">*</span></label>
        <input id="lokacija" type="text" name="lokacija" class="field-long" placeholder="Lokacija odrzavanja" value="<?php if($news!=null)echo $news[0]->Lokacija;?>"/>
        <div id="lokacija_error">Molimo Vas da unesete Lokaciju</div>
    </li>
 

		 <li>
        <label>Kontakt telefon <span class="required">*</span></label>
        <input id="telefon" type="text" name="telefon" class="field-long" placeholder="Kontakt telefon" value="<?php if($news!=null)echo $news[0]->Telefon;?>"/>
        <div id="telefon_error">Molimo Vas da unesete Kontakt</div>
    </li>
    <li>
        <label>Dodajte sliku:<span class="required">*</span></label>
        <input  <?php if($news==null){?>id ="slikaa" <?php }?> type="file" name="slika" accept="image/png, image/jpeg"/>
        <?php if($news==null){?>
            <div id="slika_error">Molimo Vas da izaberete Sliku</div>
        <?php }?>
    </li>
    
    <li>
    <input type="submit" id="dugmeValid" value="<?php if($news!=null)echo 'Izmeni olgas'; else echo 'Dodaj oglas';?>" /> 
    
    <input type="button" id="odustani" value="Odustani" href="<?php echo site_url($opis.'/userInfo');?>"/>



 
    </li>
    </ul>
    </form>
</div></div>