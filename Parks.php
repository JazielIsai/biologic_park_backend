<?php

class Parks extends Controller {

    public function __construct()
    {
        parent::__construct('biologic_park');
    }

    public function get_all_parks () {
        $query = "SELECT name, trainingBackground, areaHa, form, boundaries, recreationAreas, street, suburb, latitude, length, idMunicipality, idState FROM parks_data;";
        return $this->select_query($query);
    }

    public function get_park_by_id () {
        $query = "SELECT * FROM ";
        return $this->select_query($query);
    }


}