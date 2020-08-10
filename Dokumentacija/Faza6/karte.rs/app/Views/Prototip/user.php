<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="{{asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
<script type="text/javascript">
    
    //onClick=\"javascript: return confirm('Da li zaista želite da uklonite oglas?');\"
    //href='".site_url("Korisnik/ukloniOglas/$vest->IdD")."'
    $(document).ready(function(){
        $(".delete").click(function(e) {
            e.preventDefault();
            var id = $(this).attr('id');
            var href = $(this).attr('href');
            $.ajax({
                success: function(data){
                     

                    Swal.fire({
                        title: 'Brisanje oglasa',
                        text: "Da li zaista želite da obrišete oglas?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#BF0000',
                        closeOnClickOutside: false,
                        cancelButtonText:'Ne',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Da'
                    }).then((result) => {
                        if(result.value)
                            window.location.href = "" + href + "/" + id;
                    })
                },
                error: function(data){
                    Swal.fire({
                        'title': 'Errors',
                        'text': 'There were errors while saving the data.',
                        'type': 'error'
                    })
                }
            });
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $("#izbrisi").click(function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            $.ajax({
                success: function (data) {
                   

                    Swal.fire({
                        title: 'Uklanjanje naloga',
                        text: "Da li zaista želite da obrišete oglas?",           
                        html:
                                '<p>Unesite lozinku kao potvrdu o brisanju naloga</p><input id="swal-input1" class="swal2-input" placeholder="Lozinka">' +
                                '<input id="swal-input2" class="swal2-input" placeholder="Ponovite lozinku">',
                        preConfirm: function () {
                            //alert("SOmething");
                            /*return new Promise(function (resolve) {
                                resolve([
                                    $('#swal-input1').val(),
                                    $('#swal-input2').val()
                                ])
                            })*/
        
                            
                            return window.location.href = ""+ href + "/" + $('#swal-input1').val() + "/" + $('#swal-input2').val();
                       
                            
                        },
                        onOpen: function () {
                            $('#swal-input1').focus()
                        }
                    }).then(function (result) {
                        Swal(JSON.stringify(result))
                    }).catch(swal.noop)
                },
                error: function (data) {
                    Swal.fire({
                        'title': 'Errors',
                        'text': 'There were errors while saving the data.',
                        'type': 'error'
                    })
                }
            });
        });
    });
</script>


<div id = "main" style="margin-top: 50px;" ">
<div class="container">


    <!-- /.row -->

    <div class="row">
<div id="mainUser">
                <img src="/images/avatar.png">
                <br>
                <p  align="center">[<?php  echo $uloga->Opis ?>]<?php  echo $user->KorIme ?></p>

                <ul>
                    <?php
                         if($user->Opis=='Admin')
                             {?>

                                 <a href="<?php echo site_url('Admin/adminMode');?>"> <li>Admin</li></a>
                            <?php }else if($user->Opis=='Moderator'){?>
                                  <a href="<?php echo site_url('Moderator/moderatorMode');?>"> <li>Moderator</li></a>
                            <?php }?>
                                 
                                 
                               
                  <a href="<?php echo site_url($user->Opis.'/urediProfil');?>"> <li>Uredi profil</li></a> 
                  <a id="izbrisi" href="<?php echo site_url($user->Opis.'/izbrisiKorisnika');?>"><li>Uklanjanje naloga</li></a>
                  <a href="<?php echo site_url($user->Opis.'/logout');?>"><li>Izloguj se</li></a>
                </ul>
           
        </div>

        <div id="side">
           <h2>Informacije o korisniku</h2>
           <ul>
               <li>Ime: <label><?php  echo $user->Ime ?></label></li>
               <li>Prezime: <label><?php  echo $user->Prezime ?></label></li>
               <li>Email: <label><?php  echo $user->Email ?></label></li>
               <li>Broj telefona: <label><?php  echo $user->Telefon ?></label></li>
               <li>Država: <label><?php  echo $user->Drzava ?></label></li>
               <li>Grad: <label><?php  echo $user->Grad ?></label></li>
               <li>Adresa: <label><?php  echo $user->Adresa ?></label></li>

           </ul>


        </div>
        <div class="side2">
            <h2> Podaci o oglasima</h2>
                <table>
                    <tr>
                        <th>Redni br</th>
                        <th>Naziv oglasa</th>
                        <th>Uredi</th>
                        <th>Izbrisi</th>
                    </tr>
                 <?php
                 $i = 0;
                foreach ($news as $vest) {
                    $i++;
                    echo "<tr><td>{$i}</td>";
                    echo "<td>{$vest->Naziv}</td>";
                    echo '<td class ="uredi"><a href="'. site_url($user->Opis."/izmeniOglas/$vest->IdD").'"><i class="fa fa-edit" style="font-size:20px"></i></a></td>';
                    echo '<td class ="obrisi">';
                    echo "<a href='". site_url($user->Opis.'/ukloniOglas') ."'";
                    echo "class='delete' id='{$vest->IdD}'>";
                    echo '<i class="fa fa-trash-o" style="font-size:20px"></i></a></td>';
                    
                    
                }
                ?>

                    </table>

        </div>

</div>
</div>
</div>
</div>
    
