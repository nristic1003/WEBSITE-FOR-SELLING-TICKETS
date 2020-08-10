

   <div id="main">
   <h1 align="center"> Logovanje</h1>
   <form  method="post"name="loginform" action="<?= site_url("Gost/loginSubmit") ?>" >
       <?php if(isset($poruka)) echo "<div id='loginPoruka'><span>$poruka</span></div>"; ?>
	<ul id = "verticalMain" class="form-style-1 loginForm">

		<li>
        <label>Korisničko ime: <span class="required">*</span></label>
        <input id ="korime" type="text" name="korime" class="field-long" value ="<?php set_value('korime') ?>"/>
            <div id="email_error">Molimo Vas da unesete Email</div>

        </li>
	 <li>
        <label>Šifra: <span class="required">*</span></label>
        <input id= "lozinka"type="password" name="lozinka" class="field-long" />
         <div id="pass_error">Molimo Vas da unesete lozinku</div>
    </li>
	
    <li>
        <input id="dugme"type="submit" value="Prijavi se" />
    </li>

</ul>
</form>
       </div>
        
    
    
    
    
    </div><!-- kraj wrap-->




