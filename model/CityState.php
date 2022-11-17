<?php

class CityState extends Controller {

    public function __construct() {
        parent::__construct('u400281830_biologic_park');
    }

    public function get_all_cityState () {

        $query = "
                SELECT id, nameCityStates FROM city_states_bp;
                ";

        return $this->select_query($query);
    }


}