
   <div id="main">
       <div class="deo1">
           <h1 align="center"> <?php   echo "Admin $admin"; ?> </h1>

       </div><!-- kraj deo 1 -->

       <div class="clearfix">
       <div class="dugmici">
           <a href="<?php echo site_url("Admin/adminMode");?>">
               <button id="dugmeZaKorisnike" formaction=""class="button" style="background-color:#4CAF50;"><span>Korisnici </span></button>
           </a>
           <a href="<?php echo site_url('Admin/adminOglasi');?>">
               <button id="dugmeZaOglase" formaction=""class="button" style="background-color:#4CAF50;"><span>Oglasi </span></button>
           </a>
       </div>

       <div class ="pretrazi">
           <form method="post" id="formItem">
               <label>Pretrazi korisnike:</label><br>
               <tr>
                   <td>  <input type="text" name="pretraziKorisnike" class = "searchText"placeholder="Unesite tekst za pretragu"></td>
                   <td>  <button type="submit"class= "stupidButton" formaction="<?php echo site_url('Admin/pretragaKorisnika');?>"> <i class="fa fa-search" aria-hidden="true"></i></button></td>
               </tr>

           </form>
       </div>
       </div>

<div id="adminMain">
        <table id="adminTabela">
            <tr>
                <th><span><b>Korisničko ime</b></span></th>
                <th><span><b>Uloga</b></span></th>
                <th><span><b>Selektovan</b></span></th>
            </tr>

            <?php
            foreach ($data['news'] as $user)
            {?>
                 <tr><td><?php echo $user->KorIme ?> </td>
                 <td><?php echo $user->Opis ?> </td>
                 <td><input type="checkbox" value="<?php echo $user->KorIme;?>" name="user"></td></tr>
            <?php   }?>

            <tr>
                <td>
                    <button id="add" class="dugme">Dodaj moderatora</button>
                </td>
                <td>
                    <button id="delete" class="dugme" style="background-color:#31708f;">Oduzmi moderatora</button>
                </td>
                <td>
                    <button id="block" class="dugme" style="background-color:#BF0000;">Ukloni</button>
                </td>
            </tr>

        </table>


       <?= $data['pager']->links() ?>
   </div>
</div></div>
    
    <!-- kraj wrap-->


   <script type="text/javascript">
       $(document).ready(function() {

           $('#add').click(function(event){
               event.preventDefault();
               
               var favorite = [];
               $.each($("input[name='user']:checked"), function(){
                   favorite.push($(this).val());
               });
               $.ajax({
                   url:'<?php echo site_url("Admin/dodajModeratora"); ?>',
                   type:"POST",
                   data: {favorite: favorite},
                   async: false,
                   dataType: 'json',
                   success: function(msg){
                       $("#proba").html(msg.favorite)
                   }
               });
                window.location = "http://localhost:8080/Admin/adminMode";
           });
           $('#block').click(function(event){
                event.preventDefault();
               
               var favorite = [];
               $.each($("input[name='user']:checked"), function(){
                   favorite.push($(this).val());
               });
               $.ajax({
                   url:'<?php echo site_url("Admin/ukloni"); ?>',
                   type:"POST",
                   data: {favorite: favorite},
                   async: false,
                   dataType: 'json',
                   success: function(msg){
                       $("#proba").html(msg.favorite)
                   }
               });
               window.location = "http://localhost:8080/Admin/adminMode";
           });
           $('#delete').click(function(event){
               event.preventDefault();
               
               var favorite = [];
               $.each($("input[name='user']:checked"), function(){
                   favorite.push($(this).val());
               });
               $.ajax({
                   url:'<?php echo site_url("Admin/oduzmiModeratora"); ?>',
                   type:"POST",
                   data: {favorite: favorite},
                   async: false,
                   dataType: 'json',
                   success: function(msg){
                       $("#proba").html(msg.favorite)
                   }
               });
                window.location = "http://localhost:8080/Admin/adminMode";
           });

       });
   </script>
