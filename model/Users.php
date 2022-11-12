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
        $query = "SELECT users.firstName, users.lastname, users.academicTitle, users.email, roles.rol as rol FROM users inner join roles on roles.id = users.id_rol;";
        return $this->select_query($query);
    }

    public function checking_if_exist_user ($email, $password) {
        $query = "
            SELECT users.id, firstname, lastname, academicTitle, email, id_rol,
                   roles.rol as Rol
            FROM users
            INNER JOIN roles ON users.id_rol = roles.id
            WHERE email = ? AND password = ?;
        ";
        $query_data = array($email, $password);

        return $this->select_query($query, $query_data);
    }

}