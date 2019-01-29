<?php

class Login_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function run() {
        $sth = $this->db->prepare("select id from users
                where login = :login 
                and password = MD5(:password)");
        $sth->execute(array(
            ':login'=>$_POST['login'],
            ':password'=>$_POST['password']
        ));
        if ($sth->rowCount() > 0) {
            // login
            Session::init();
            Session::set('loggedIn',true);
            header('location: ../dashboard');
        } else {
            // Show an error
            header('location: ../login');
        }
        // print_r($data);
    }
}
?>