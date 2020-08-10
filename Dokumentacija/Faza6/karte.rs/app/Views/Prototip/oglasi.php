
   <div id="main">
       <div id="oglas">
         <h1> Oglasi</h1>
           <?php
           $uri = current_url(true)->getSegment(1);
           $str=null;
           switch ($uri) {
               case "Gost":
               {
                   $str = site_url('Gost/login');
                   $_SESSION["msg"] = "Morate se ulogovati da bi postavljali oglase!";
                   break;
               }
               case "Korisnik":
                   $str = site_url('Korisnik/objaviOglas');
                   break;
               case "Admin":
                   $str = site_url('Admin/objaviOglas');
                   break;
               case "Moderator":
                   $str = site_url('Moderator/objaviOglas');
                   break;
           }
           ?>
          <a href="<?php echo $str?>">
              <button id="block" formaction=""class="button" ><span>Dodaj </span></button>
          </a>
       </div>

       <div id="sadrzajOglasa">
       <?php
       foreach ($data['news'] as $oglas)
       {
          // echo "$str ";
           echo " <div class=\"deo1 oglas\" >";

           echo  " <table class=\"tabelaOglasi\">";
           echo  ' <tr><th><img alt="computer" src="data:image/jpeg;base64,' . base64_encode($oglas->Slika) . '" /></th></tr>';
                   /// <td rowspan='7'> <img alt=\'computer\' src=\'data:image/jpeg;base64,'". base64_encode($oglas->Slika)."></td>
           
           $date = date_create($oglas->Datum);
           $date = date_format($date, 'd.m.Y H:i');
           $arr = explode(' ', $date, 2);
           //echo $arr[0];
           echo "<tr><th>$oglas->Naziv</th></tr>";
           echo "<tr><td> Datum:{$arr[0]}  Vreme:{$arr[1]} Lokacija:$oglas->Lokacija </td></tr>  ";

           echo "   <tr>
                    <td> Prodavac:$oglas->KorIme Broj karata: $oglas->BrojKarata   Kontakt:{$oglas->Telefon}</td>           </tr>";

           echo "
                <tr>
                    <th>Cena: $oglas->Cena din</th>         
                </tr>";
           echo "  </table>";
           echo "</div>";

       }

       ?>
       </div>


        <br>


   </div><!-- kraj za div main-->

   <div class="pagination" >
       <?= $data['pager']->links() ?>
   </div>
   </div>

    
   <!-- kraj wrap-->

