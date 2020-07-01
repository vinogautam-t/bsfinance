<?php
function bs_login(){
	global $wpdb;
	
    $_POST = (array) json_decode(file_get_contents('php://input'));

	$creds = array();
	$creds['user_login'] = $_POST['username'];
	$creds['user_password'] = $_POST['password'];
	$creds['remember'] = true;
	$current_user = wp_signon( $creds, false );
	
	if(!is_wp_error($current_user) && $current_user->data->user_status == 0) {
	    $current_userr = (array)$current_user->data;
	    $current_userr['session_id'] = logSessionUser($current_userr['ID']);

	    $fields = get_user_fields();

	    foreach ($fields as $key => $value) {
	    	$current_userr[$value] = get_user_meta($current_userr['ID'], $value, true);
	    }
	    
	    $response = array('status' => 'Success', 'data' => $current_userr);	
	}else {
		
		$rr = get_user_by('email', $_POST['username']);
		
		$creds['user_login'] = $rr->user_login;
		
		$current_user = wp_signon( $creds, false );
		
		if(!is_wp_error($current_user) && $current_user->data->user_status == 0) {
		    $current_userr = (array)$current_user->data;
		    $current_userr['session_id'] = logSessionUser($current_userr['ID']);

		    $fields = get_user_fields();

		    foreach ($fields as $key => $value) {
		    	$current_userr[$value] = get_user_meta($current_userr['ID'], $value, true);
		    }
		    
		    $response = array('status' => 'Success', 'data' => $current_userr);	
		} else {
			$response = array('status' => 'Error', 'msg' => 'Invalid Credentials!!');
		}
	}

	echo json_encode($response);
	die(0);
}

function bs_create_user(){
	global $wpdb;
	$_POST = (array) json_decode(file_get_contents('php://input'));
	
	if(isset($_POST['ID'])){
		$userdata = array(
		    'user_email'  =>  $_POST['email'],
		    'ID'   =>  $_POST['ID']
		);
		
		$user_id = wp_update_user( $userdata ) ;
		
		if ( ! is_wp_error( $user_id ) ) {
			$user_info = (array) get_userdata($_POST['ID']);
			if(isset($user_info['data'])){
				if($user_info['data']->user_email != $_POST['email']){
					update_user_meta($_POST['ID'], 'email_confirmed', false);
					bs_send_verification_link($_POST['ID'], 1);
				}
			}
			
			$fields = get_user_fields();

		    foreach ($fields as $key => $value) {
		    	if($_POST[$value]){
		    		$current_userr[$value] = update_user_meta($current_userr['ID'], $value, $_POST[$value]);
		    	}
		    }
			
		    echo json_encode(array('status' => 'Success', 'data' => $_POST));
		} else {
			echo json_encode(array('status' => 'Error', 'msg' => 'Failed to update user. Please Try again Later'));
		}
	} else {
		$userdata = array(
		    'user_login'  =>  $_POST['username'],
		    'user_email'  =>  $_POST['email'],
		    'user_pass'   =>  $_POST['password'],
		    'role'		  => 'site_user'
		);
		
		$user_id = wp_insert_user( $userdata ) ;
	
		if ( ! is_wp_error( $user_id ) ) {
			$fields = get_user_fields();

		    foreach ($fields as $key => $value) {
		    	if($_POST[$value]){
		    		$current_userr[$value] = update_user_meta($user_id, $value, $_POST[$value]);
		    	}
		    }
			
		    $_POST['ID'] = $user_id;

			bs_send_verification_link($user_id);
			
		    echo json_encode(array('status' => 'Success', 'data' => $_POST));
		} else {
			echo json_encode(array('status' => 'Error', 'msg' => 'Failed to create user. Please Try again Later'));
		}
	}
	
	die(0);
}

function bs_send_verification_link(){

}

function bs_plans(){
	global $wpdb;

	$data = $wpdb->get_results('select * from wp_plans');

	echo json_encode(array('status' => 'Success', 'data' => $data));
	die(0);
}

function bs_deposit_list(){
	global $wpdb;
	$_POST = (array) json_decode(file_get_contents('php://input'));
	$user_id= $_GET['user_id'];

	$data = $wpdb->get_results('select * from wp_user_request where type="deposit" and user_id='.$user_id);

	echo json_encode(array('status' => 'Success', 'data' => $data));
	die(0);
}
function bs_withdraw_list(){
	global $wpdb;
	$_POST = (array) json_decode(file_get_contents('php://input'));
	$user_id= $_POST['user_id'];
	$data = $wpdb->get_results('select * from wp_user_request where type="withdraw" and user_id='.$user_id);

	echo json_encode(array('status' => 'Success', 'data' => $data));
	die(0);
}

function bs_transaction_list(){
	global $wpdb;
	$_POST = (array) json_decode(file_get_contents('php://input'));
	$user_id= $_POST['user_id'];

	$data = $wpdb->get_results("select * from wp_transactions where user_id=$user_id");

	echo json_encode(array('status' => 'Success', 'data' => $data));
	die(0);
}


function bs_deposit_request(){
	global $wpdb;
	$_POST = (array) json_decode(file_get_contents('php://input'));

	$wpdb->insert('wp_user_request', 
		array(
			'user_id' => $_POST['user_id'],
			'amount' => $_POST['amount'],
			'plan_id' => $_POST['plan_id'],
			'reference_id' => $_POST['reference_id'],
			'notes' => $_POST['notes'],
			'request_date' => date('Y-m-d H:i:s'),
			'type'=> 'deposit'
		)
	);

	//echo $wpdb->last_query;

	echo json_encode(array('status' => 'Success'));
	die(0);
}

function bs_withdraw_request(){
	global $wpdb;
	$_POST = (array) json_decode(file_get_contents('php://input'));

	$wpdb->insert('wp_user_request', 
		array(
			'user_id' => $_POST['user_id'],
			'amount' => $_POST['amount'],
			'notes' => $_POST['notes'],
			'request_date' => date('Y-m-d H:i:s'),
			'type'=> 'withdraw'
		)
	);

	//echo $wpdb->last_query;

	echo json_encode(array('status' => 'Success'));
	die(0);
}

function bs_cron(){
	global $wpdb;

	$results = $wpdb->get_results('select * from wp_subscription where status = 0');
	foreach ($results as $key => $value) {
		$plan = $wpdb->get_row('select * from wp_plans where id = '.$value->plan_id);
		$noti = $wpdb->get_results('select * from wp_subscription_notification where noti_date = "'.date('Y-m-d').'" and subscription_id = '.$value->id);

		if(count($noti) == 0){
			$now = strtotime(date('Y-m-d')); 
			$your_date = strtotime(explode(" ", $value->subscription_date)[0]);
			$datediff = ($now - $your_date) / (60 * 60 * 24);
			if($datediff){
				if($plan->type == 'daily' || $plan->no_of_days == $datediff) {
					$amount = $value->amount * ($plan->return_percentage/100);
					$amount = number_format((float)$amount, 2, '.', '');

					$wpdb->insert('wp_subscription_notification', 
						array(
							'subscription_id' => $value->id,
							'plan_id' => $value->plan_id,
							'user_id' => $value->user_id,
							'amount' => $amount,
							'noti_date' => date('Y-m-d')
						)
					);
					if($plan->no_of_days == $datediff){
						$wpdb->update('wp_subscription', array('status' => 1), array('id' => $value->id));
					}
				}
			}
		}
	}
	echo json_encode(array('status' => 'Success'));
	die(0);
}

function bs_user_balance(){
	global $wpdb;
	$_POST = (array) json_decode(file_get_contents('php://input'));
	$data = array();
	$balance = get_user_meta($_POST['user_id'], 'wallet_balance', true);
    $balance = $balance ? $balance : 0;

    $data['deposit'] = $wpdb->get_row('select sum(amount) as sum from wp_user_request where status = 1 and type = "deposit" and user_id = '.$_POST['user_id'])->sum;
    $data['pending_deposit'] = $wpdb->get_row('select sum(amount) as sum from wp_user_request where status = 0 and type = "deposit" and user_id = '.$_POST['user_id'])->sum;

    $data['withdraw'] = $wpdb->get_row('select sum(amount) as sum from wp_user_request where status = 1 and type = "withdraw" and user_id = '.$_POST['user_id'])->sum;
    $data['pending_withdraw'] = $wpdb->get_row('select sum(amount) as sum from wp_user_request where status = 0 and type = "withdraw" and user_id = '.$_POST['user_id'])->sum;
    $data['balance'] = $balance;

	echo json_encode(array('status' => 'Success', 'data' => $data));
	die(0);
}

function bs_home_data(){
	global $wpdb;
	$res = $wpdb->get_results('select user_id, sum(amount) as amt from wp_transactions where type = "deposit" group by user_id order by amt desc limit 0, 10');
	$data = array('investors' => array(), 'deposits' => array(), 'withdraw' => array());
	foreach ($res as $key => $value) {
		$user = $wpdb->get_row('select * from wp_users where ID='.$value->user_id);
		$name = get_user_meta($value->user_id, 'name', true);

		$data['investors'][] = array('name' => $name, 'registered' => $user->user_registered, 'amt' => $value->amt);
	}

	$res = $wpdb->get_results('select * from wp_transactions where type = "deposit" order by id desc limit 0, 10');
	foreach ($res as $key => $value) {
		$name = get_user_meta($value->user_id, 'name', true);
		$value = (array) $value;
		$value['name'] = $name;
		$data['deposits'][] = $value;
	}

	$res = $wpdb->get_results('select * from wp_transactions where type = "withdraw" order by id desc limit 0, 10');
	foreach ($res as $key => $value) {
		$user = $wpdb->get_row('select * from wp_users where ID='.$value->user_id);
		$name = get_user_meta($value->user_id, 'name', true);
		$value = (array) $value;
		$value['name'] = $name;
		$data['withdraw'][] = $value;
	}

	$res = $wpdb->get_row('select count(*) as cnt from wp_users');
	$data['users'] = $res->cnt ? $res->cnt : 0;

	$res = $wpdb->get_row('select sum(amount) as amt from wp_transactions where type = "deposit"');
	$data['total_deposit'] = $res->amt ? $res->amt : 0;

	$res = $wpdb->get_row('select sum(amount) as amt from wp_transactions where type = "withdraw"');
	$data['total_withdraw'] = $res->amt ? $res->amt : 0;

	echo json_encode(array('status' => 'Success', 'data' => $data));
	die(0);
}