<?php

    $GLOBALS['role_count'] = 22;

    $GLOBALS['roles'] = array(
     "LOGIN" => 1,
     "CREATE_NEW_USER" => 2, 
     "VEHICLE_CREATE" => 3, 
     "VEHICLE_EDIT" => 4,
     "VEHICLE_DELETE" => 5,
     "VEHICLE_SEE_ALL" => 6,
     "VEHICLE_QUEST_MAKE" => 7,
     "ITEM_CREATE" => 8,
     "ITEM_EDIT" => 9,
     "ITEM_DELETE" => 10,
     "ITEM_SEE_ALL" => 11,
     "REPORTS_CLEAR" => 12,
     "REPORTS_SEE_ALL" => 13,
     "PROFILE_CHANCE_PHONE" => 14,
     "PROFILE_CHANCE_EMAIL" => 15,
     "PROFILE_CHANCE_PASSWORD" => 16,
     "PROFILE_PERSONEL_DATA" => 17,
     "PROFILE_CLEAR_SELF_DATAS" => 18,
     "PROFILE_DOWNLOAD_SELF_DATAS" => 19,
     "USERS_SEE_ALL" => 20,
     "USERS_EDIT" => 21,
     "USERS_DELETE" => 22,
     "USERS_DETAILS" => 23,
     "PROFILE_EFFECTED" => 24,
     "PROFILE_EFFECTER" => 25
    );

    $GLOBALS['gains'] = array(
        1 => "Giriş Yapabilir.",
        2 => "Yeni Üye Ekleyebilir.",
        3 => "Araç Oluşturabilir.",
        4 => "Mevcut Araçları Düzenleyebilir",
        5 => "Mevcut Araçları Silebilir.",
        6 => "Araçlar Sayfasını Görüntüleyebilir.",
        7 => "Araç Yükleme/Boşaltma Yapabilir",
        8 => "Yeni Ürün Oluşturabilir",
        9 => "Mevcut Ürünleri Düzenleyebilir",
        10 => "Mevcut Ürünleri Silebilir",
        11 => "Ürünler Sayfasını Görüntüleyebilir",
        12 => "Raporları Temizleyebilir",
        13 => "Raporlar Sayfasını Görüntüleyebilir",
        14 => "Profil Sayfasından Telefon Numarasını Değiştirebilir.",
        15 => "Profil Sayfasından Email Adresini Değiştirebilir.",
        16 => "Profil Sayfasından Şifresini Değiştirebilir.",
        17 => "Profil Sayfasından Kişisel Veriler Sayfasını Görebilir.",
        18 => "Profil Sayfasından Kişisel Verilerini Silmeyi Kullanabilir.",
        19 => "Profil Sayfasından Kişisel Verilerini İndirmeyi Kullanabilir",
        20 => "Kullanıcılar Sayfasında Kayıtlı Kullanıcıları Görüntülemeyi Sağlar",
        21 => "Kayıtlı Kullanıcıların Bilgilerini Güncellemeyi Sağlar",
        22 => "Kayıtlı Kullanıcıları Silmeyi Sağlar.",
        23 => "Kayıtlı Kullanıcıların Detayları Görüntülemeyi Sağlar.",
        24 => "Hesabın Üzerinde Yapılan Değişiklikleri Görüntülemeni Sağlar.",
        25 => "Diğer Kullanıcıların Hesaplarında Yaptığın Değişiklikleri Görüntülemeni Sağlar."
       );

    function hasRole($permission){
        if(!isset($_SESSION['id'])) return 0;
        if($_SESSION['id'] == 0) return 1;
		$data = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_USER_WITH_ID'], "i", $_SESSION['id'])->fetch_array();
        $userPermissions = $data['permissions'];
        $permission_id = "-{$GLOBALS['roles'][$permission]}-";
        if(strpos($userPermissions, $permission_id)  !== false) return 1;
        else return 0;
    }
?>