<?php
function bs_login(){
	global $wpdb;
	
    $_POST = (array) json_decode(file_get_contents('php://input'));

	$creds = array();
	$creds['user_login'] = $_POST['username'];
	$creds['user_password'] = $_POST['password'];
	$creds['remember'] = true;
	$current_user = wp_signon( $creds, false );
	
	if(!is_wp_error($current_user) && $current_user->data->company_id && $current_user->data->user_status == 0) {
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