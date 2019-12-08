<?php
<?php
function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function time_ago($datetime, $full = false) {

	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function get_short_content($content,$i)
{
	$con_len=strlen(strip_tags(stripslashes($content)));
	if($con_len>$i)
	{
		$length=strpos(strip_tags(stripslashes($content)), ' ',$i);
		$final_content=substr(strip_tags(stripslashes($content)),0,$length).'...';
		return array('striped' => true, 'content' => $final_content);
	}
	elseif($con_len<=$i)
	{
		return array('striped' => false, 'content' => stripslashes($content));
	}
}

function send_mail($to, $user_id, $subject , $message, $noti = 0)
{
	global $wpdb;
	
	if(!$to) return false;
	if($user_id){
		$headers = getallheaders();
	
		$origin = isset($headers['referer']) ? $headers['referer'] : $headers['Referer'];
		$origin = 'https://engynn.net/panel';
		$unsubscribeLink = $origin.'/#!/unsubscribe/'.base64_encode(base64_encode($user_id.'#'.$to));
		$unsubscribeLink = str_replace('engynn-intranet.com', 'engynn.net', $unsubscribeLink);
		
		$unsubscribeContent = '<div style="background: #eee;padding: 10px 60px;margin-top: 60px;">
			<h4>Unsubscribe, Report A Problem, and Identifying Info</h4>
			<p><b>Why are you getting this email?</b> You are getting this email because your email is associated with an organization hosting an 
			intranet hosted on Engynn Intranet. Engynn is a LTD company in Edmonton, AB, Canada. Contact us at <a href="solutions@engynn.com">solutions@engynn.com</a>, 
			call us at (855) 910-5933, or visit Engynn-intranet.com </p>
			<p><b>Unsubscribe, Report A Problem, or Turn Off Notifications</b></p>
			<p>If you believe you are NOT the intended recipient, would like to turn off notifications, or want to unsubscribe from system emails – 
			visit <a href="'.$unsubscribeLink.'">'.$unsubscribeLink.'</p>
		</div>';
		
		
		$message .= $unsubscribeContent;
	}
	
    $option = get_option('sendgrid-api');
    
    $sendgrid = new SendGrid($option);
    $email = new SendGrid\Email();

    $email->setFrom('support@engynn.net');
    $email->setFromName('Engynn');
    
    $email->addTo($to);
    $email->setHtml($message);

    $email->setSubject($subject);

    try {
        if($sendgrid->send($email)){
        	$wpdb->update('wp_mail_tracker', array('status' => 1), array('id' => $eid));
        }
    } catch(\SendGrid\Exception $e) {
        echo $e->getCode();
        foreach($e->getErrors() as $er) {
            echo $er;
        }
    }

    return true;
}

function get_time($dt){
	$ttt = explode(' ', $dt);
    	
	$newtm = '';
	
	if($ttt[1] == 'PM'){
		$tmp = explode(":", $ttt[0]);
		if($tmp[0] == 12){
			$newtm = '12:'.$tmp[1].':00';
		} else {
			$newtm = ($tmp[0] + 12).':'.$tmp[1].':00';
		}
	} else {
		if($ttt[0] == '12:00'){
			$newtm = '00:00:00';
		}elseif($ttt[0] == '12:30'){
			$newtm = '00:30:00';
		}else{
			$newtm = $ttt[0].':00';	
		}
	}
	
	return $newtm;
}

function test_email(){
	send_mail('dhanavel237vino@gmail.com', 'Reset Password Link', 'Mail Received');
	
	die(0);
}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function logSessionUser($user_id){
	global $wpdb;
	
	$ip_address = get_client_ip();
	
	$type = isMobileDevice() ? 'mobile' : 'desktop';
	
	$wpdb->insert('wp_sessions', array('user_id' => $user_id, 'type' => $type, 'ip_address' => $ip_address, 'start_date' => date('Y-m-d H:i:s')));
	
	return $wpdb->insert_id;
}

function slug($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}