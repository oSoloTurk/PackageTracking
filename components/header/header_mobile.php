<?php

if ($GLOBALS['login']) {

  $username = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_USER_WITH_ID'], "i", $_SESSION['id'])->fetch_array()['username'];

  $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

  if (hasRole("VEHICLE_SEE_ALL")) {
    $button_1 = '<li class="nav-item">
      <a class="nav-link btn ' . ($curPageName == 'vehicles.php' ? 'currentpage' : '') . '" aria-current="page" href="vehicles.php">' . $GLOBALS['messages_header']['NAVBAR_VEHICLES'] . '</a>
      </li>';
  } else $button_1 = '';
  if (hasRole("ITEM_SEE_ALL")) {
    $button_2 = '<li class="nav-item">
      <a class="nav-link btn ' . ($curPageName == 'products.php' ? 'currentpage' : '') . '" aria-current="page" href="products.php">' . $GLOBALS['messages_header']['NAVBAR_PRODUCTS'] . '</a>
      </li>';
  } else $button_2 = '';
  if (hasRole("REPORTS_SEE_ALL")) {
    $button_3 = '<li class="nav-item">
      <a class="nav-link btn ' . ($curPageName == 'reports.php' ? 'currentpage' : '') . '" aria-current="page" href="reports.php">' . $GLOBALS['messages_header']['NAVBAR_REPORTS'] . '</a>
      </li>';
  } else $button_3 = '';
  if (hasRole("PROFILE_CHANCE_PHONE")) {
    $button_4 = '<li>
      <a class="dropdown-item bg-dark" href="profil.php?tab=btn-profile">' . $GLOBALS['messages_header']['NAVBAR_PROFILE'] . '</a>
      </li>';
  } else $button_4 = '';
  if (hasRole("PROFILE_CHANCE_EMAIL")) {
    $button_5 = '<li>
      <a class="dropdown-item bg-dark" href="profil.php?tab=btn-email">' . $GLOBALS['messages_header']['NAVBAR_EMAIL'] . '</a>
      </li>';
  } else $button_5 = '';
  if (hasRole("PROFILE_CHANCE_PASSWORD")) {
    $button_6 = '<li>
      <a class="dropdown-item bg-dark" href="profil.php?tab=btn-password">' . $GLOBALS['messages_header']['NAVBAR_PASSWORD'] . '</a>
      </li>';
  } else $button_6 = '';
  if (hasRole("PROFILE_PERSONEL_DATA")) {
    $button_7 = '<li>
      <a class="dropdown-item bg-dark" href="profil.php?tab=btn-data">' . $GLOBALS['messages_header']['NAVBAR_PERSONELDATA'] . '</a>
      </li>';
  } else $button_7 = '';
  if (hasRole("USERS_SEE_ALL")) {
    $button_8 = '<li>
      <a class="nav-link btn ' . ($curPageName == 'users.php' ? 'currentpage' : '') . '" aria-current="page" href="users.php">' . $GLOBALS['messages_header']['NAVBAR_USERS'] . '</a>
      </li>';
  } else $button_8 = '';
  if (hasRole("PROFILE_EFFECTED")) {
    $button_9 = '<a class="dropdown-item bg-dark" id="btn-effected" href="profil.php?tab=btn-effected">' . $GLOBALS['messages_header']['NAVBAR_EFFECTED'] . '</a>';
  } else $button_9 = '';
  if (hasRole("PROFILE_EFFECTER")) {
    $button_10 = '<a class="dropdown-item bg-dark" id="btn-effecter" href="profil.php?tab=btn-effecter">' . $GLOBALS['messages_header']['NAVBAR_EFFECTER'] . '</a>';
  } else $button_10 = '';
  if ($GLOBALS['login']) {
    printf(
      '
        <header class="navbar navbar-expand-lg rounded corner-top" id="header">
          <a class="navbar-brand" href="index.php"> 
            <div class="d-flex justify-content-center me-3">
              <i data-feather="arrow-right"></i><i data-feather="box"></i><i data-feather="arrow-right"></i>
              </div>' . $GLOBALS['messages_header']['NAVBAR_TITLE'] . '
          </a>      
          <ul class="navbar-nav navbar-mobile d-flex flex-row" id="mobileNavbar" style="visibility:hidden;">
            %s %s %s %s
            <li class="nav-item">
            <div class="dropdown">
                <a class="nav-link btn active dropdown-toggle ' . ($curPageName == 'profil.php' ? 'currentpage' : '') . '" role="button" id="profile-tab" data-bs-toggle="dropdown" aria-current="page" href="profil.php">' . $GLOBALS['messages_header']['NAVBAR_HELLO'] . '
                    %s
                </a>
            <ul class="dropdown-menu" aria-labelledby="profile-tab">
                %s %s %s %s %s %s
            </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link btn theme-button-error" aria-current="page" href="logout.php">' . $GLOBALS['messages_header']['NAVBAR_LOGOUT_BUTTON'] . '</a>
            </li>
          </ul>  
          <button id="navbarButton" class="btn" onclick="navbarSwap();"><span class="dark-blue-text"><i
            data-feather="menu"></i></span></button>    
      </header>
    ',
      $button_1,
      $button_2,
      $button_3,
      $button_8,
      $username,
      $button_4,
      $button_5,
      $button_6,
      $button_7,
      $button_9,
      $button_9
    );
  }
} else {
  printf('
    <nav class="navbar navbar-expand-lg shadow p-3 rounded corner-top justify-content-between">
      <a class="navbar-brand" href="index.php">
          <div class="d-flex justify-content-center">
            <i data-feather="arrow-right"></i><i data-feather="box"></i><i data-feather="arrow-right"></i>
          </div>
          ' . $GLOBALS['messages_header']['NAVBAR_TITLE'] . '
        </a>
        <a
          class="btn theme-button-success my-2 my-sm-0 pull-right"
          href="login.php"
          >' . $GLOBALS['messages_header']['NAVBAR_LOGIN_BUTTON'] . '</a
        >
      </nav>
    ');
}
