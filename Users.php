<?php

class Users extends Controller {

    public function __construct() {
        parent::__construct('biologic_park');
    }

    public function get_all_users () {
        $query = "SELECT id, firstname, lastname, academicTitle, email FROM users;";
        return $this->select_query($query);
    }

    public function get_all_user_by_rol () {
        $query = "SELECT users.firstName, users.lastname, users.academicTitle, users.email, roles.rol as rol FROM users inner join roles on roles.id = users.id;";
        return $this->select_query($query);
    }

}