<?php

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>karte.rs</title>
    
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <link href="/fa/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    
    
    <script src="/script/cart.js"></script>
    <script type=text/javascript src="/script/proba.js"></script>
    <script type=text/javascript src="/script/odustani.js"></script>
    <script type=text/javascript src="/script/formaValidation.js"></script>
    <script type=text/javascript src="/script/oglasValidation.js"></script>
</head>

<body>

    <div id="wrapper">

    <div id="head">

    	<div id="logo">
        <a href = "<?php echo site_url("Admin/index"); ?>"><img src="/images/logo3.png" alt="logo" width="200" height="70"></a>


        </div><!-- kraj logo-->

            <div id="nav" class="myTopNav">
                <ul>
                    <li><a class="<?php if($method=='index') echo 'current';?>" href="<?php echo site_url("Admin/index"); ?>" >Početna</a></li>
                    <li><div id="shopping-cart"><a class="<?php if($method=='korpa') echo 'current';?>"  href="<?php echo site_url("Admin/korpa"); ?>" >Korpa
                            <?php
                            if(isset($_SESSION['korpa']) && count($_SESSION['korpa'])>0) {
                                $num = count($_SESSION['korpa']);
                                echo "<span id='korpaUkupno'>($num)</span>";
                            }
                            else
                                echo "<span id='korpaUkupno'></span>";
                            ?>
                        </a></div></li>
                    <li><a class="<?php if($method=='userInfo') echo 'current';?>" href="<?php echo site_url("Admin/userInfo"); ?>">Korisnički profil</a></li>
                     <li><a class="<?php if($method=='oglasi') echo 'current';?>" href="<?php echo site_url("Admin/oglasi"); ?>" >Prodaja Karata</a></li>
                     <li><a  href="<?php echo site_url("Admin/logout"); ?>" >Izloguj se</a></li>
                 </ul>
        </div><!-- kraj nav-->



    <div class="icon">
        <a href="javascript:void(0);"  ><i class="fa fa-bars"></i></a>
    </div>

    </div><!-- kraj head-->
