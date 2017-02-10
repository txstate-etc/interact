<?php
/*
// Optional configuration file for wpCAS plugin
// 
// Settings in this file override any options set in the 
// wpCAS menu in Options and that menu will not be displayed
*/

require_once('/etc/wordpress/wpcas-config.php');

// the configuration array
$wpcas_options = array(
	'cas_version' => $WPCAS_PHPCAS_VERSION,
	'include_path' => $WPCAS_PHPCAS_INCLUDE_PATH,
	'server_hostname' => $WPCAS_SERVER,
	'server_port' => $WPCAS_PORT,
	'server_path' => $WPCAS_PATH
	);

// this function gets executed 
// if the CAS username doesn't match a username in WordPress
function wpcas_nowpuser( $username ) {
	global $WPCAS_USERINFO_QUERY, $WPCAS_ACCEPTED_TXSTATE_AFFILIATIONS, $WPCAS_DESC;
	if ( $username == 'guest' ) {
		wp_redirect(site_url());
		exit;
	}
	
	// Ensure user is faculty or staff
	$userinfo = json_decode(file_get_contents($WPCAS_USERINFO_QUERY.$username));
	if (!in_array(strtolower($userinfo->txstatePersonPrimaryAffiliation), $WPCAS_ACCEPTED_TXSTATE_AFFILIATIONS)) {
		echo "<html><head><title>Login Error</title></head><body>Unable to log you in.<br/><br/>Click <a href=\"".site_url()."\">here</a> to return to the $WPCAS_DESC start page.</body></html>";
	} else {
		$userid = wp_create_user($username, NULL, "$userinfo->mail");
		if (!is_wp_error($userid)) {
			wp_update_user(array('ID'=>$userid, 'first_name'=>$userinfo->givenName, 'last_name'=>$userinfo->sn, 'display_name'=>$userinfo->displayName, 'nickname'=>$userinfo->givenName, 'user_email'=>$userinfo->mail));
			wp_redirect("wp-login.php".(empty($_GET["redirect_to"])?NULL:"?redirect_to=".$_GET["redirect_to"]));
		} else {
			$error_string = $userid->get_error_message();
			echo "<html><head><title>Login Error</title></head><body>Unable to log you in: $error_string.<br /><br/>Click <a href=\"".site_url()."\">here</a> to return to the $WPCAS_DESC start page.</body></html>";
		}
	}
	exit;
}

?>
