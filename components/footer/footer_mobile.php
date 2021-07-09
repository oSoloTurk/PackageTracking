<?php

if ($GLOBALS['login']) {
  printf('
      <footer class="pt-4 pt-md-5 corner-bottom">
        <div class="container py-5">
          <div class="row">
            <div class="col-md-3 align-self-center ">
              <span class="row display-6 justify-content-start">' . $GLOBALS['messages_footer']['FOOTER_COPYRIGHT_UP_ROW'] . '</span>
              <span class="row display-7 justify-content-start">' . $GLOBALS['messages_footer']['FOOTER_COPYRIGHT_DOWN_ROW'] . '</span>
              <div class="row dropdown justify-content-start">
                <button class="btn dropdown-toggle col-6" type="button" id="languages" data-bs-toggle="dropdown">
                <i data-feather="globe"></i>
                </button>
                <ul class="dropdown-menu bg-dark" aria-labelledby="languages">
                  <li>
                    <button class="dropdown-item language bg-dark" aria-current="page" value="tr">' . $GLOBALS['messages_footer']['FOOTER_LANGUAGE_TURKISH'] . '</a>
                  </li>
                  <li>
                    <button class="dropdown-item language bg-dark" aria-current="page" value="en">' . $GLOBALS['messages_footer']['FOOTER_LANGUAGE_ENGLISH'] . '</a>
                  </li>
                  <li>
                    <button class="dropdown-item language bg-dark" aria-current="page" value="de">' . $GLOBALS['messages_footer']['FOOTER_LANGUAGE_DEUTSCH'] . '</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-3">
            <b class="col">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_1_TITLE'] . '</b>
            <ul class="list-unstyled text-small">
              <li><a class="link-secondary" aria-current="page" href="index.php">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_1_1_ELEMENT'] . '</a></li>
              <li><a class="link-secondary" aria-current="page" href="vehicles.php">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_1_2_ELEMENT'] . '</a></li>
              <li><a class="link-secondary" aria-current="page" href="products.php">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_1_3_ELEMENT'] . '</a></li>
              <li><a class="link-secondary" aria-current="page" href="reports.php">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_1_4_ELEMENT'] . '</a></li>
              <li><a class="link-secondary" aria-current="page" href="users.php">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_1_5_ELEMENT'] . '</a></li>
            </ul>
          </div>
          <div class="col-md-3">
            <b class="col">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_2_TITLE'] . '</b>
            <ul class="list-unstyled text-small">
              <li><a class="link-secondary" href="profil.php?tab=btn-profile">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_2_1_ELEMENT'] . '</a></li>
              <li><a class="link-secondary" href="profil.php?tab=btn-email">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_2_2_ELEMENT'] . '</a></li>
              <li><a class="link-secondary" href="profil.php?tab=btn-password">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_2_3_ELEMENT'] . '</a></li>
              <li><a class="link-secondary" href="profil.php?tab=btn-data">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_2_4_ELEMENT'] . '</a></li>
              <li><a class="link-secondary" href="profil.php?tab=btn-effected">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_2_5_ELEMENT'] . ' İşlemler</a></li>
              <li><a class="link-secondary" href="profil.php?tab=btn-effecter">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_2_6_ELEMENT'] . '</a></li>
            </ul>
          </div>
          <div class="col-md-3">
            <b class="col">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_3_TITLE'] . '</b>
            <ul class="list-unstyled text-small">
              <li><a class="link-secondary" href="vehicles.php?operation=add">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_3_1_ELEMENT'] . '</a></li>
              <li><a class="link-secondary" href="products.php?operation=add">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_3_2_ELEMENT'] . '</a></li>
              <li><a class="link-secondary" href="vehicle_upload.php">' . $GLOBALS['messages_footer']['FOOTER_COLUMN_3_3_ELEMENT'] . '</a></li>
              <li><a class="link-secondary" href="users.php?operation=add">Sisteme ' . $GLOBALS['messages_footer']['FOOTER_COLUMN_3_4_ELEMENT'] . '</a></li>
            </ul>
          </div>
          </div>
        </div>
      </footer>
    ');
} else {
  printf('
      <footer class="pt-4 pt-md-5 corner-bottom">
        <div class="container py-5">
          <div class="row">
            <div class="col-md-3 align-self-center ">
              <span class="row display-6 justify-content-start">' . $GLOBALS['messages_footer']['FOOTER_COPYRIGHT_UP_ROW'] . '</span>
              <span class="row display-7 justify-content-start">' . $GLOBALS['messages_footer']['FOOTER_COPYRIGHT_DOWN_ROW'] . '</span>
              <div class="row dropdown justify-content-start">
                <button class="btn dropdown-toggle col-6" type="button" id="languages" data-bs-toggle="dropdown">
                <i data-feather="globe"></i>
                </button>
                <ul class="dropdown-menu bg-dark" aria-labelledby="languages">
                  <li>
                    <button class="dropdown-item language bg-dark" aria-current="page" value="tr">' . $GLOBALS['messages_footer']['FOOTER_LANGUAGE_TURKISH'] . '</a>
                  </li>
                  <li>
                    <button class="dropdown-item language bg-dark" aria-current="page" value="en">' . $GLOBALS['messages_footer']['FOOTER_LANGUAGE_ENGLISH'] . '</a>
                  </li>
                  <li>
                    <button class="dropdown-item language bg-dark" aria-current="page" value="de">' . $GLOBALS['messages_footer']['FOOTER_LANGUAGE_DEUTSCH'] . '</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </footer>
    ');
}
