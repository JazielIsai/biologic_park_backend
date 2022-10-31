<?php

class PivotBiologicPark extends Controller {

    public function __construct() {
        parent::__construct('biologic_park');
    }

    public function get_all_relation_biologic_data_and_parks_data () {
        $query = "
            SELECT pivot_biologic_park.id,
                   biologic_data.commonName AS commonName,
                   parks_data.namePark AS namePark
            FROM pivot_biologic_park
            INNER JOIN biologic_data ON pivot_biologic_park.idBiologic = biologic_data.id
            INNER JOIN parks_data ON pivot_biologic_park.idParksData = parks_data.id;";

        return $this->select_query($query);
    }

}