<!-- NAVBAR - BARRE VERTICALE DE NAVIGATION -->
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

<!-- MENU DE NAVIGATION -->
    <ul class="nav menu">

    <?php
    // ======================== RESPONSABLE LEGAL ========================== //
    if (isset($_SESSION['mail_resp_leg'])){
        ?>

    <!-- PROFIL UTILISATEUR DANS NAVNAR -->
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="../img/responsable.ico" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php echo "". $responsable_legal->getPrenom_resp_leg() . " ". $responsable_legal->getNom_resp_leg() . "";?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="divider"></div>
        
        <!-- ESPACE RESPONSABLE LEGAL -->
        <li><a href="../espace_responsable/espace_resp_leg.php"><em class="fas fa-home">&nbsp;</em> My space</a></li>

        <!-- INSCRIPTION D'UN MINEUR -->
        <li><a href="../espace_responsable/register_adh_mineur.php"><em class="fas fa-user-plus">&nbsp;</em> Register</a></li>

        <!-- DECONNEXION -->
        <li><a href="../deconnexion.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    
    <?php
    // ========================== MAJEUR ============================= //   
    }elseif(isset($_SESSION['mail_inscrit'])){
        ?>
        
        <!-- PROFIL UTILISATEUR DANS NAVNAR -->
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="../img/majeur.ico" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"><?php echo $adherent->getPrenom_adh() . ' ' . $adherent->getNom_adh() ;?></div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>

        <!-- ESPACE MAJEUR -->
        <li><a href="../espace_majeur/espace_adh.php"><em class="fas fa-home">&nbsp;</em> My space</a></li>
        
        <!-- BORDEREAU MAJEUR -->
        <li><a href="../espace_majeur/list_borderaux.php"><em class="fas fa-file-alt">&nbsp;</em> My Cars</a></li>

        <!-- DECONNEXION -->
        <li><a href="../deconnexion.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>

        <?php
        // ========================== TRESORIER ============================== //
    }elseif(isset($_SESSION['mail_tresorier'])){
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

                <!-- CONNEXION TRESORIER -->
                <li><a class="" href="login/connexion_tresorier.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Location
                </a></li>

                <!-- CONNEXION RESPONSABLE -->
                <li><a class="" href="login/connexion_resp_leg.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Cars
                </a></li>

                <!-- CONNEXION MAJEUR -->
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

                <!-- INSCRIPTION RESPONSABLE -->
                <li><a class="" href="register/register_resp_leg.php">
                    <span class="fa fa-arrow-right">&nbsp;</span> Professional
                </a></li>

                <!-- INSCRIPTION MAJEUR -->
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