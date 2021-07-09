<?php
include("connection/session.php");
include("actions.php");

$data = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_USER_WITH_ID'], "i", $_SESSION['id'])->fetch_array();

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="lib/bootstrap.min.css" />
	<link rel="stylesheet" href="styles/theme.css" />
	<link rel="stylesheet" href="styles/search.css" />
	<link rel="stylesheet" href="styles/profil.css" />
</head>
<body>
	<?php include("header.php"); ?>
	<article>
		<div class="container-md">
			<div class="btn-group-horizontal text-center" id="tabs">
				<?php
				if (hasRole("PROFILE_CHANCE_PHONE")) {
					$firstButton = '<a class="btn theme-button mt-1 mb-1 active" href="profil.php?tab=btn-profile">Profil</a>';
				} else $firstButton = '';
				if (hasRole("PROFILE_CHANCE_EMAIL")) {
					$secondButton = '<a class="btn theme-button mt-1 mb-1" href="profil.php?tab=btn-email">Email</a>';
				} else $secondButton = '';
				if (hasRole("PROFILE_CHANCE_PASSWORD")) {
					$thirdButton = '<a class="btn theme-button mt-1 mb-1" href="profil.php?tab=btn-password">Şifre</a>';
				} else $thirdButton = '';
				if (hasRole("PROFILE_CHANCE_EMAIL")) {
					$fourtyButton = '<a class="btn theme-button mt-1 mb-1" href="profil.php?tab=btn-data">Kişisel Veri</a>';
				} else $fourtyButton = '';
				if (hasRole("PROFILE_EFFECTED")) {
					$fivetyButton = '<a class="btn theme-button mt-1 mb-1" href="profil.php?tab=btn-effected">Hesabın üzerindeki işlemler</a>';
				} else $fivetyButton = '';
				if (hasRole("PROFILE_EFFECTER")) {
					$sixtyButton = '<a class="btn theme-button mt-1 mb-1" href="profil.php?tab=btn-effecter">Yaptığın İşlemler</a>';
				} else $sixtyButton = '';
				printf('
							%s %s %s %s %s %s
						', $firstButton, $secondButton, $thirdButton, $fourtyButton, $fivetyButton, $sixtyButton);
				?>
			</div>
			<hr />
			<div class="row justify-content-center">
			<?php
				if(!isset($_GET['tab'])) $_GET['tab'] = "btn-profile";
				switch ($_GET['tab']){
					case "btn-profile":
						include "components/profile/profile-tab.php";
						break;				
					case "btn-email":
						include "components/profile/email-tab.php";
						break;	
					case "btn-password":
						include "components/profile/password-tab.php";
						break;	
					case "btn-data":
						include "components/profile/data-tab.php";
						break;	
					case "btn-effected":
						include "components/profile/effected-tab.php";
						break;	
					case "btn-effecter":
						include "components/profile/effecter-tab.php";
						break;	
				}
			?>
			</div>
		</div>
	</article>

	<?php include("footer.php"); ?>
	<script src="lib/bootstrap.bundle.min.js"></script>
	<script src="scripts/profil.js"></script>
	<?php include("components/toastservice/toastservice.php"); ?>
</body>

</html>