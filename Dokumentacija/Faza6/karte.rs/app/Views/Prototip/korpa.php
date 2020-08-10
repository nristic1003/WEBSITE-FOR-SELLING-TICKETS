<!-- Page Content -->
<script type=text/javascript src="/script/kartica.js"></script>



<div id="main">

    <div class="container">


        <!-- /.row -->

        <div class="row">
            <h1 align="center">Plaćanje</h1>
            <form action="  <?php  if(isset($_SESSION['user']))
                echo site_url($opis."/kupi");
            else  echo site_url("Gost/login/Molimo vas da se ulogijete kako bi nastavili kupovinu");
            ?>" method="post">

                <ul class="form-style-2 table-responsive">
                    <li>
                        <table id="tableKorpa">
                            <thead>
                            <tr>
                                <th>Slika</th>
                                <th>Naziv</th>
                                <th>Kolicina</th>
                                <th>Ukupno</th>
                                <th>Opcije</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($news as $vest)
                            {
                                $kolicina = $_SESSION['korpa'][$vest->IdD];
                                $cena  = $kolicina * $vest->Cena;

                                $cont = current_url(true)->getSegment(1);
                                if($cont == "") $cont = "Gost";

                                $linkinc = site_url("$cont/inccart/{$vest->IdD}");
                                $linkdec = site_url("$cont/deccart/{$vest->IdD}");
                                $linkdel = site_url("$cont/delcart/{$vest->IdD}");
                                $slika = base64_encode($vest->Slika);
                                $product = <<<DEL

                        <tr id="$vest->IdD">
                          <td> <img class= "slikaKorpa"alt="computer" src='data:image/jpeg;base64,$slika' width="160em" height="90em"/></td>
                          <td class="nazivKorpa">{$vest->Naziv}</td>
                          <td class="ko" id = "kol$vest->IdD">{$kolicina} </td>
                          <td id = "cena$vest->IdD">{$cena}</td>
                          <td>
                              <button type="button" class="dugmecart" link = '$linkinc' kol = '$kolicina' cena = '$vest->Cena' iddog = '$vest->IdD' opt = '0'>+</button>
                              <button type="button" class="dugmecart" link = '$linkdec' kol = '$kolicina' cena = '$vest->Cena' iddog = '$vest->IdD' opt = '1'>-</button> 
                              <button type="button" class="dugmecartdel" link = '$linkdel' iddog = '$vest->IdD'>delete</button></td>
                          </tr>
DEL;
                                echo $product;

                            }


                            ?>
                            <tr>
                                <td colspan="5">
                                    <div class="col-xs-4">


                                        <?php
                                        $suma = 0;
                                        foreach ($news as $vest) {
                                            $kolicina = $_SESSION['korpa'][$vest->IdD];
                                            $cena = $kolicina * $vest->Cena;
                                            $suma += $cena;
                                        }
                                        echo "<h2>Ukupan iznos: <span id = 'suma'>$suma</span> dinara</h2>";

                                        ?>






                                    </div>


                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </li>
                </ul>
                <ul class="form-style-1">

                    <li>
                        <label>Broj kartice<span class="required">*</span></label>
                        <input type="text" id="brkartice" name="brkartice" class="field-long" />
                    </li>
                    <li>
                        <label>Broj isteka važenja kartice (mesec/godina)<span class="required">*</span></label>
                        <input type="text" id="kartmesec" name="mesec" class="field-divided" placeholder="Mesec" />
                        <input type="text" id="kartgod" name="god" class="field-divided" placeholder="Godina" />
                    </li>
                    <li>
                        <label>CVC/CVV2 kod<span class="required">*</span></label>
                        <input type="text" id="kartcvc" name="cvc" class="field-long" />
                    </li>

                    <li>
                        <div id="kart_error">GREŠKA PRI UNOSU PODATAKA</div>
                        <input id = "<?php  if(isset($_SESSION['user']))  echo"kupi";  else  echo ""?>"  type="submit" name="submit" value="Kupi" style="width:100%; font-size: 20px; font-weight: 600;">
                    </li>

                </ul>
            </form>


            <!--  ***********CART TOTALS*************-->

            <!-- CART TOTALS-->


        </div><!--Main Content-->


    </div>
</div>
</div>

<!-- /.container -->