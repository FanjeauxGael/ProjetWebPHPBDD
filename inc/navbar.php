<!-- NAVBAR - BARRE VERTICALE DE NAVIGATION -->
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

<!-- MENU DE NAVIGATION -->
    <ul class="nav menu">

        <?php
        // ========================== TRESORIER ============================== //
    if(isset($_SESSION['mail_tresorier'])){
        ?>

        <!-- PROFIL VISITEUR DANS NAVNAR -->
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="../img/tresorier.ico" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"><?php echo $tresorier->getprenom_tresorier() . ' ' . $tresorier->getnom_tresorier() ;?></div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>
          
        <!-- ESPACE TRESORIER -->
        <li><a href="../espace_tresorier/espace_tresorier.php"><em class="fas fa-home">&nbsp;</em> My space</a></li>

        <!-- DECONNEXION -->
        <li><a href="../deconnexion.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>

        <?php
        // =============================== VISITEUR ============================== //
            }else{
        ?>

        <!-- PROFIL VISITEUR DANS NAVNAR -->
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="img/visiteur.png" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">VISITOR</div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="divider"></div>

        <!-- ACCUEIL -->
        <li class=""><a href="index.php"><em class="fas fa-home">&nbsp;</em> Home</a></li>

        <!-- CONNEXION -->
        <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
            <em class="fas fa-bars">&nbsp;</em> Login <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">

                <!-- CONNEXION ADHERENT -->
                <li><a class="" href="login/connexion_adh.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> My cars
                </a></li>
            </ul>
        </li>

        <!-- INSCRIPTION -->
        <li class="parent "><a data-toggle="collapse" href="#sub-item-2">
            <em class="fas fa-bars">&nbsp;</em> Register <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-2">

                <!-- INSCRIPTION ADHERENT -->
                <li><a class="" href="register/register_adh.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Particular
                </a></li>
            </ul>
        </li>

            <?php 
            }
            ?>
    </ul>
</div><!--/.sidebar-->