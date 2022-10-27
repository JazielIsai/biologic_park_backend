<?php

class Parks extends Controller {

    public function __construct()
    {
        parent::__construct('biologic_park');
    }

    // GET

    public function get_all_parks () {
        $query = "SELECT name, trainingBackground, areaHa, form, boundaries, recreationAreas, street, suburb, latitude, length, idMunicipality, idState FROM parks_data;";
        return $this->select_query($query);
    }

    public function get_park_by_id () {
        $query = "SELECT * FROM ";
        return $this->select_query($query);
    }

    public function get_parks_by_city_state ($cityState) {

    }

    public function get_parks_by_municipality ($municipality) {
        $query = "SELECT namePark, trainingBackground, areaHa, form, " .
                 "boundaries, recreationAreas, street, suburb, latitude, length, " .
                 "municipality_bp.nameMunicipality AS municipality, city_states_bp.nameCityStates AS cityState ".
                 "FROM parks_data " .
                 "INNER JOIN municipality_bp ON parks_data.idMunicipality = municipality_bp.id ".
                 "INNER JOIN city_states_bp ON parks_data.idCityStates = city_states_bp.id ".
                 "WHERE municipality_bp.nameMunicipality = '?';";
        return $this->select_query($query);
    }

    public function get_park_search ($searchPark) {

    }

    // Insert

    public function add_park () {
        $query = "INSERT INTO VALUES ";
    }



}