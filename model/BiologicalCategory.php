<?php

class BiologicalCategory extends Controller {

    public function __construct()
    {
        parent::__construct('biologic_park');
    }

    public function get_all_category () {
        $query = "SELECT id, description FROM category;";
        return $this->select_query($query);
    }

    public function get_category_by_id () {
        $query = "SELECT id, description FROM category WHERE id = ?;";
        return $this->select_query($query);
    }



}