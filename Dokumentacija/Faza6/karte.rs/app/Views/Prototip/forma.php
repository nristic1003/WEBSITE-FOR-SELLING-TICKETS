<html>
<head>
  
</head>


<body>
    <div id="wrapper">

   <div id="main">
   <h1 align="center" id="naslov"><?php echo $naslov?></h1>
   <form action="<?php 
                if($korisnik!=null)echo site_url($korisnik->Opis.'/azurirajProfil'); 
                //else if($korisnik!=null && $korisnik->Opis=="Moderator")echo site_url('Moderator/azurirajProfil');
                //else if($korisnik!=null && $korisnik->Opis=="Admin")echo site_url('Admin/azurirajProfil');
                else echo site_url('Gost/registracija'); ?>" method="post">
	<ul class="form-style-1">
    <li><label>Ime i prezime:<span class="required">*</span></label>
        <input id ="ime" type="text" name="ime" class="field-divided" placeholder="Ime" value="<?php if($korisnik!=null) echo $korisnik->Ime; ?>"/>
        <input id ="prezime" type="text" name="prezime" class="field-divided" placeholder="Prezime" value="<?php if($korisnik!=null) echo $korisnik->Prezime; ?>"/></li>
        <div id="ime_error">Molimo Vas da unesete Ime i Prezime</div>
    <li>
        <label>Email: <span class="required">*</span></label>
        <input id="email" type="email" name="email" class="field-long" value="<?php if($korisnik!=null) echo $korisnik->Email; ?>"/>
        <div id="email_error">Molimo Vas da unesete Email</div>
    </li>
		<li>
        <label>Korisničko ime: <span class="required">*</span></label>
        <input id="korime" type="text" name="korime" class="field-long" value="<?php if($korisnik!=null) echo $korisnik->KorIme; ?>"  <?php if($korisnik!=null)echo 'readonly';?>/>
        <div id="korime_error">Molimo Vas da unesete Korisničko ime</div>
    </li>
	 <li>
        <label><?php  if($korisnik!=null) echo 'Stara šifra:'; else echo 'Šifra:';?><span class="required">*</span></label>
        <input id="sifra" type="password" name="lozinka" class="field-long" />
    </li>
	 <li>
        <label><?php  if($korisnik!=null) echo 'Nova šifra:'; else echo 'Ponovljena šifra:';?><span class="required">*</span></label>
        <input id="ponsifra" type="password" name="ponlozinka" class="field-long" />
        <div id="sifra_error">Molimo Vas da unesete Šifru i Ponovljenu šifru</div>
        <div id="nsifra_error">Šifra i Ponovljenu šifra se ne poklapaju!</div>
    </li>
		 <li>
        <label>Telefon: <span class="required">*</span></label>
        <input id="telefon" type="text" name="telefon" class="field-long" value="<?php if($korisnik!=null) echo $korisnik->Telefon; ?>"/>
        <div id="telefon_error">Molimo Vas da unesete Telefon (Formati: +381xx, +381-xx, 06xx, 011xx)</div>
    </li>
		
		 <li>
        <label>Brlk: <span class="required">*</span></label>
        <input id="brlk" type="text" name="brlk" class="field-long" value="<?php if($korisnik!=null) echo $korisnik->BRLK;?>"/>
         <div id="brlk_error">Molimo Vas da unesete Broj lične karte (dužina mora biti 9 cifara)</div>
    </li>

    <li>
        <label>Država<span class="required">*</span></label>
        <!--input type="text" name="field3" class="field-long" /-->
        <select id="drzava" name="drzava" class="field-long">
            <option value="Srbija" <?php if($korisnik!=null and (string)$korisnik->Drzava=='Srbija')echo 'selected';?>>Srbija</option>
            <option value="Hrvatska" <?php if($korisnik!=null and (string)$korisnik->Drzava=='Hrvatska')echo 'selected';?>>Hrvatska</option>
            <option value="Severna Makedonija" <?php if($korisnik!=null and (string)$korisnik->Drzava=='Severna Makedonija')echo 'selected';?>>Makedonija</option>
            <option value="Bosna i Hercegovina" <?php if($korisnik!=null and (string)$korisnik->Drzava=='Bosna')echo 'selected';?>>Bosna i Hercegovina</option>
            <option value="Slovenija" <?php if($korisnik!=null and (string)$korisnik->Drzava=='Slovenija')echo 'selected';?>>Slovenija</option>
        </select>
    </li>
	


	<li>
        <label>Grad<span class="required">*</span></label>
        <input id="grad" type="text" name="grad" class="field-long" value="<?php if($korisnik!=null) echo $korisnik->Grad; ?>"/>
        <div id="grad_error">Molimo Vas da unesete Grad</div>
    </li>

    <li>
        <label>Adresa<span class="required">*</span></label>
        <input id="adresa" type="text" name="adresa" class="field-long" value="<?php if($korisnik!=null) echo $korisnik->Adresa; ?>"/>
        <div id="adresa_error">Molimo Vas da unesete Grad</div>
    </li>
        <?php if(isset($poruka)) echo $poruka;/*"<font color='green' size='5px'>$poruka</font><br>";*/ ?>
    <li>
        <input id="dugmeForma" type="submit" value="Pošalji" /> 
        <input type="button" id="odustani" value="Odustani" 
               
               <?php if($korisnik==null){ ?>
               href="index.php"
               <?php } else if($korisnik!=null){ ?>
               href="<?php echo site_url($korisnik->Opis.'/userInfo'); ?>"
               <?php } ?>
               
               />
    </li>
</ul>
</form>
      
       
       
       </div>
      
   
        
       
    
    
    
    
    </div><!-- kraj wrap-->

</body>
</html>