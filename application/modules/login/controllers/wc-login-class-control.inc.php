<?php
/*
 * LOGIN CONTROLLER
 *
 */

/*
$user_input = 'fridolin88';
$password = crypt('fridolin88'); // let the salt be automatically generated

// You should pass the entire results of crypt() as the salt for comparing a
//   password, to avoid problems when different hashing algorithms are used. (As
//   it says above, standard DES-based password hashing uses a 2-character salt,
//   but MD5-based hashing uses 12.)
if (crypt($user_input, $password) == $password) {
   echo "Password verified!";
}
*/

class WC_LOGIN_model
{		
		public $model;
		public $conn;
		public $res;
		public $err = "Username or password incorrect :(";
		// constructor
		public function __construct( $conn ) {
			
			$this->conn = $conn;

		}
		
		// fetcher query function
		public function fetch( $user_name, $pw ) {
			
			// $sql = "SELECT username, password FROM users WHERE username = '{$user_name}' AND password = '{$pw}'";
			// $sub_res = $this->conn->query($sql);
			// $this->res = ($sub_res->num_rows < 1) ? false : true;
			// $this->err = ($this->res === false) ? "Username or password incorrect :(" : "";
		
			// 2013-04-23
			$user_input = $pw;
			$password = crypt('fridolin88');
			$this->res = ( crypt($user_input, $password) == $password ) ? true : false;
		}
}


class WC_LOGIN_controller
{		
		public $model;
		// constructor
		public function __construct($model, $user_input) {
			
			$this->model = $model;
			$this->model->fetch($user_input['username'], $user_input['password']);
			
		}
}

class WC_LOGIN_view
{		
		public $error;
		public $model;
		public $controller;
		// constructor
		public function __construct($model, $controller) {
			$this->model = $model;
			$this->controller = $controller;
			$this->error = $model->err;	
		}
		// fetcher query function
		public function get_login() {
			// return model result
			return $this->model->res;
		}
		// send error message
		public function get_error() {
			return $this->error;
		}
}

