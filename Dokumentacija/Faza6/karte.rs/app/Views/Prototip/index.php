
<div id="main">
       <div class="searchBar">
        <table>
            <form class="example" >
            <tr>
                <td>  <input type="text" name="search" class = "searchText"placeholder="Unesite tekst za pretragu"></td>
                <td>    <button type="submit"class= "stupidButton" formaction="<?php echo site_url($opis.'/pretraga');?>"> <i class="fa fa-search" aria-hidden="true"></i></button></td>
            </tr>
        </form>
        </table>
    </div>
       <?php
       
          if(!empty($trazeno))
       {
           echo "<h5> Rezultati pretrage za {$trazeno} su: </h5>";
       }

        foreach ($data['news'] as $vest)
        {
                echo "<div class='deo1'>";
                echo "<h2> {$vest->Naziv} </h2>";

                echo " <div id='slikaIndex'>";
                echo '<img alt="computer" src="data:image/jpeg;base64,' . base64_encode($vest->Slika) . '" />';
                echo "</div>";
                echo "<div id ='happyDiv'><p> $vest->Opis</p></div> ";
                   //$link = site_url("Korisnik/addtocart/{$vest->IdD}");
                    $cont = current_url(true)->getSegment(1);
                    if($cont == "") $cont = "Gost";
                    $link = site_url("$cont/addtocart/{$vest->IdD}");
            $klasa = "";
            if(isset($_SESSION['korpa'][$vest->IdD]))
                $klasa = "ukorpi";

            //

                echo "<div id='buttonDiv'>";
                echo "<button class='btn button $klasa' link='$link'/> <span>U korpu </span></button>";

                echo "</div></div>";


        }
   
         
      


       ?>
    <div class="pagination" >
        <?= $data['pager']->links() ?>
    </div>
</div>
</div>



  
