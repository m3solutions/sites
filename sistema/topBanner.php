<div class="topBanner">
    <div class="logo">
        <img class="logo" src="img/lcm.png" alt="LCM - Leads and Contacts Manager"/>
    </div>
    <div class="topMenu">
    <?php
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'yes') {
    ?>
      <div class="hello">
        <u>Ola,  <?php echo $_SESSION['firstName']; ?></u>
      </div>
    <?php } ?>
      <ul>
        <?php
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'yes') {
        ?>
        <li>
          <a href="logout.php"><img src='img/power.png' alt="Logout" /> Logout</a>
        </li>
        <?php
            if (isset($access) && $access == 1) {  //Admin
        ?>
        <li class="<?php echo ($currPage == 'config.php') ? 'active' : ''; ?>"><a href="config.php" >
          <img src='img/gear.png' alt="Settings" /> Configurações</a>
          <ul>
              <li><a href="config.php?page=relat"><span>Relatórios</span></a></li>
            <li><a href="config.php?page=import"><span>Importar/Exportar</span></a></li>
            <li><a href="config.php?page=users"><span>Usuários </span></a></li>
            <li><a href="config.php?page=siteSettings"><span>Configs Site </span></a></li>
            <li><a href="config.php?page=logging"><span>Log</span></a></li>
          </ul>
        </li>
        <?php   } ?>
        <li class="<?php echo ($currPage == 'stats.php') ? 'active' : ''; ?>"><a href="stats.php" >
          <img src='img/ekg.png' alt="Statistics" /> Estatisticas </a>
        </li>
        <li class="<?php echo ($currPage == 'index.php') ? 'active' : ''; ?>"><a href="index.php">
          <img src='img/group.png' alt="Leads & Contacts" /> Leads & Contatos</a>
        </li>
        
        
        <?php } elseif ($currPage == 'login.php') { ?>
          <li class="active"><a href="#">Faça seu Login </a></li>
        <?php } elseif ($currPage == 'install.php') {?>
          <li class="active"><a href="#">Instalar </a></li>
        <?php } ?>      
      </ul>
    </div>
</div>
