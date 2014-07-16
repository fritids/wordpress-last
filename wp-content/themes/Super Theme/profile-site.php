<?php
/*
Template Name: Profile page
*/

get_header();

$user_id = get_current_user_id();

//if user is logged in
if(is_user_logged_in()) {
    $user = get_userdata($user_id);
    
    //getting username
    $username = $user->user_login;
    
    //getting user age
    $birthyear = get_user_meta($user_id, "birthyear", true);
    $age = intval(date("Y")) - intval($birthyear);
    if($age == 0) {
        $age = "Brak danych";
    }
    
    //getting user localization
    $localization = get_user_meta($user_id, "localization", true);
    if(strlen($localization)<=0) {
        $localization = "Brak danych";
    }
    
    //getting user gender
    $gender = get_user_meta($user_id, "gender", true);
    if(strlen($gender)<=0) {
        $gender = "Brak danych";
    }
?>

<div id="profile_wrapper">
    <div id="profile_inner">
        <h2><?php the_title(); ?></h2>

        <div id="profile_data">
            <?php echo get_avatar($user_id, 150); ?>
            <p id="profile_login"><?php echo $username; ?></p>
            <p>Lokalizacja: <?php  echo $localization; ?></p>
            <p>Płeć: <?php  echo $gender; ?></p>
            <p>Wiek: <?php echo $age; ?></p>
            <div class="clear_div"></div>
            <a href="http://localhost/wordpress/?page_id=53" id="profile_settings">Ustawienia profilu</a>
        </div>

        <div id="profile_options">
            <a href="http://localhost/wordpress/?page_id=50">Moje posty</a>
            <a href="http://localhost/wordpress/?page_id=42">Dodaj post</a>
            <a href="http://localhost/wordpress/?page_id=47">Moje komentarze</a>
        </div>
    </div>
</div>

<?php
}
get_footer();
?>