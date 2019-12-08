<?php
include WP_CONTENT_DIR . '/themes/bsfinance/userapi.php';
include WP_CONTENT_DIR . '/themes/bsfinance/common.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");

add_role(
    'site_user',
    __( 'Site User' ),
    array(
        'read'         => true,  
        'edit_posts'   => true,
        'delete_posts' => false, 
    )
);

$functions = array('bs_login', 'bs_create_user', 'bs_plans', 'bs_transactions', 'bs_deposits', 'bs_deposit_request');

foreach ($functions as $key => $value) {
	add_action( 'wp_ajax_'.$value, $value );
	add_action( 'wp_ajax_nopriv_'.$value, $value );
}


if(isset($_GET['debug'])){
    echo '<pre>';
}

function get_user_fields(){
	return array('name', 'secret_question', 'secret_answer', 'perfect_money', 'payeer_account',
		'bitcoin', 'litecoin', 'ethereum', 'bitcoin_cash', 'dash', 'email_confirmed'
	);
}