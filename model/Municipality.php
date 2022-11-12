<?php

class Municipality extends Controller {

    public function __construct()
    {
        parent::__construct('biologic_park');
    }

    public function get_all_municipality_by_id ($cityState_id) {
        $query = "
            SELECT municipality_bp.id, municipality_bp.nameMunicipality
            FROM municipality_bp
            WHERE municipality_bp.idCityState = ?;
        ";

        return $this->select_query($query, array($cityState_id));
    }

}