<?php
/*
 * Login logic
 * Controls login procedure
 *
 *
 */
$LOGIN_ERROR = "";

function WC_login_logic( $user_input, &$error ) {
	
	// redirect to main page on successfull login
	$REDIRECT = "http://localhost/wordcrunch_3/public";
	// db connection
	$db = new WC_DB_connect("localhost", "$db_accessor", "$db_accessor_pw", "wordcrunch", "mysqli");
	// call model and pass db connection
	$model = new WC_LOGIN_model($db->conn);
	// call controller, pass model and userinput
	$controller = new WC_LOGIN_controller($model, $user_input);
	// call view, pass model, controller
	$view = new WC_LOGIN_view($model, $controller);
	$db->conn->close();

	// if login successful redirect
	// if not successfull call error and display on login page
	if ($view->get_login() === true) {
		header("Location:{$REDIRECT}");
		
		
		
	} else {
		$error = $view->get_error();
	}

}

// if $_POST is set run login logic
if( isset($_POST['username']) && isset($_POST['password']) ) {
	WC_login_logic( $_POST, $LOGIN_ERROR);
}
