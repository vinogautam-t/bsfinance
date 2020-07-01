<?php
include WP_CONTENT_DIR . '/themes/bsfinance/listtable.php';
include WP_CONTENT_DIR . '/themes/bsfinance/admin.php';
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

$functions = array('bs_login', 'bs_create_user', 'bs_plans', 'bs_transactions', 'bs_deposits', 'bs_deposit_request', 'bs_withdraw_request', 'bs_deposit_list', 'bs_withdraw_list', 'bs_transaction_list',
    'bs_cron', 'bs_home_data', 'bs_user_balance');

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


if(isset($_GET['action']) && $_GET['action'] == 'admin_approve_return'){
    $request = $wpdb->get_row('select * from wp_subscription_notification where id = '.$_GET['id']);
    $old_balance = get_user_meta($request->user_id, 'wallet_balance', true);
    $old_balance = $old_balance ? $old_balance : 0;
    
    $new_balance = $old_balance + $request->amount;

    if($request->amount){
       $wpdb->insert('wp_transactions', array(
        'user_id' => $request->user_id,
        'req_id' => $request->id,
        'amount' => $request->amount,
        'plan_id' => $request->plan_id,
        'type' => 'return',
        'transaction_date' => date('Y-m-d H:i:s'),
        'old_balance' => $old_balance,
        'new_balance' => $new_balance
        ));
        update_user_meta($request->user_id, 'wallet_balance', $new_balance);
        $wpdb->update('wp_subscription_notification', array('status' => 1, 'approve_date' => date('Y-m-d H:i:s')), array('id' => $_GET['id'])); 
    }
    wp_redirect('admin.php?page='.$_REQUEST['page'].'&tab='.$_REQUEST['tab']);exit;
} elseif(isset($_GET['action']) && $_GET['action'] == 'admin_approve'){
    $request = $wpdb->get_row('select * from wp_user_request where id = '.$_GET['id']);
    $old_balance = get_user_meta($request->user_id, 'wallet_balance', true);
    $old_balance = $old_balance ? $old_balance : 0;
    
    if($request->type == 'deposit'){
        $new_balance = $old_balance + $request->amount;
    } else {
        $new_balance = $old_balance - $request->amount;
    }

    if($request->amount){
       $wpdb->insert('wp_transactions', array(
        'user_id' => $request->user_id,
        'req_id' => $request->id,
        'amount' => $request->amount,
        'plan_id' => $request->plan_id,
        'type' => $request->type,
        'transaction_date' => date('Y-m-d H:i:s'),
        'old_balance' => $old_balance,
        'new_balance' => $new_balance
        ));
        update_user_meta($request->user_id, 'wallet_balance', $new_balance);
        $wpdb->update('wp_user_request', array('status' => 1), array('id' => $_GET['id'])); 
    }
    
    
    if($request->type == 'deposit'){
        $old_balance = $new_balance;
        $new_balance = $new_balance - $request->amount;

        $wpdb->insert('wp_subscription', array(
        'user_id' => $request->user_id,
        'req_id' => $request->id,
        'plan_id' => $request->plan_id,
        'amount' => $request->amount,
        'subscription_date' => date('Y-m-d H:i:s')
        ));

        $wpdb->insert('wp_transactions', array(
        'user_id' => $request->user_id,
        'req_id' => $request->id,
        'amount' => $request->amount,
        'plan_id' => $request->plan_id,
        'type' => 'subscription',
        'transaction_date' => date('Y-m-d H:i:s'),
        'old_balance' => $old_balance,
        'new_balance' => $new_balance
        ));
        update_user_meta($request->user_id, 'wallet_balance', $new_balance);
    }
    
    wp_redirect('admin.php?page='.$_REQUEST['page']);exit;
} elseif(isset($_GET['action']) && $_GET['action'] == 'admin_reject'){
    $wpdb->update('wp_user_request', array('status' => 2), array('id' => $_GET['id']));
    wp_redirect('admin.php?page='.$_REQUEST['page']);exit;
} elseif(isset($_GET['page']) && $_GET['page'] == 'plans' && isset($_GET['action']) && $_GET['action'] == 'delete'){
    $wpdb->delete('wp_plans', array('id' => $_GET['id']));
    wp_redirect('admin.php?page='.$_REQUEST['page']);exit;
} elseif(isset($_GET['page']) && $_GET['page'] == 'plans' && isset($_POST['bs_admin_create_plan'])){
    if(isset($_GET['id'])){
        $wpdb->update('wp_plans', 
            array(
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'no_of_days' => $_POST['no_of_days'],
                'return_percentage' => $_POST['return_percentage'],
                'minamount' => $_POST['minamount'],
                'maxamount' => $_POST['maxamount'],
                'vip' => isset($_POST['vip']) ? $_POST['vip'] : 0
            ),
            array('id' => $_GET['id'])
        );
    } else {
        $wpdb->insert('wp_plans', 
            array(
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'no_of_days' => $_POST['no_of_days'],
                'return_percentage' => $_POST['return_percentage'],
                'minamount' => $_POST['minamount'],
                'maxamount' => $_POST['maxamount'],
                'vip' => isset($_POST['vip']) ? $_POST['vip'] : 0
            )
        );
    }
    wp_redirect('admin.php?page='.$_REQUEST['page']);exit;
}