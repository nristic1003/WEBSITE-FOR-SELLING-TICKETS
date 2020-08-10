
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
                       <td>  <button type="submit"class= "stupidButton" formaction="<?php echo site_url('Admin/pretragaOglasa');?>"> <i class="fa fa-search" aria-hidden="true"></i></button></td>
                   </tr>

               </form>
           </div>
       </div>
       <div id="adminMain">
           <table id="adminTabela">
               <tr>
                   <th><span><b>Oglas</b></span></th>
                   <th><span><b>Status</b></span></th>
                   <th><span><b>Selektovan</b></span></th>
               </tr>

               <?php
            foreach ($data['news'] as $news)
            {?>
                <tr><td><?php echo $news->Naziv?> </td>
                    <td><?php echo $news->Status?> </td>
                    <td><input type="checkbox" value="<?php echo $news->IdD;?>" name="oglas"></td></tr>

         <?php   }?>
               <tr>
                   <td>
                       <button id="statusOglasa" class="dugme">Status</button>
                   </td>
                   <td>

                   </td>
                   <td>
                       <button id="obrisiOglas" class="dugme" style="background-color:#BF0000;">Ukloni</button>
                   </td>
               </tr>

           </table>


           <?= $data['pager']->links() ?>

   </div></div></div></div>

   <script type="text/javascript">
       $(document).ready(function() {      
           $('#obrisiOglas').click(function(event){
               event.preventDefault();
               var favorite = [];
               $.each($("input[name='oglas']:checked"), function(){
                   favorite.push($(this).val());
               });
               $.ajax({
                   
                   url:'<?php echo site_url("Admin/obrisiOglas"); ?>',
                   type:"POST",
                   data: {favorite: favorite},
                   async: false,
                   dataType: 'json',
                   success: function(msg){
                       $("#proba").html(msg.favorite)
                   }
               });
                window.location = "http://localhost:8080/Admin/adminOglasi";
           });
           $('#statusOglasa').click(function(event){
               event.preventDefault();
               var favorite = [];
               $.each($("input[name='oglas']:checked"), function(){
                   favorite.push($(this).val());
               });

               $.ajax({
                   url:'<?php echo site_url("Admin/promeniStatus"); ?>',
                   type:"POST",
                   data: {favorite: favorite},
                   async: false,
                   dataType: 'json',
                   success: function(msg){
                       $("#proba").html(msg.favorite)
                   }
               });
               window.location = "http://localhost:8080/Admin/adminOglasi";
           });
       });
   </script>
