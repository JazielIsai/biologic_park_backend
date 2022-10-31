<?php

class CityState extends Controller {

    public function __construct() {
        parent::__construct('biologic_park');
    }

    public function get_all_municipality_by_state () {

        $query = "SELECT municipality_bp.id, municipality_bp.nameMunicipality,
                         city_states_bp.nameCityStates AS cityState
                  FROM municipality_bp
                  INNER JOIN city_states_bp
                  ON municipality_bp.idCityState = city_states_bp.id;";

        return $this->select_query($query);
    }


}