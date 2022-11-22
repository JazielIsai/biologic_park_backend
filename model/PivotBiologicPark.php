<?php

class PivotBiologicPark extends Controller {

    public function __construct() {
        parent::__construct('u400281830_biologic_park');
    }


    public function add_relation_to_pivot_table ($data) {

        $query_data = array($data->idBiologic, $data->idParksData);

        $query_prev = "
            SELECT * FROM pivot_biologic_park
            WHERE idBiologic = ? AND idParksData = ?;
        ";

        $result = $this->select_query($query_prev, $query_data);

        if ( count($result) == 0 ) {

            $query = "
                INSERT INTO pivot_biologic_park (idBiologic, idParksData)
                VALUES (?, ?);
            ";

            $this->insert_query($query, array($query_data));

            return 1;
        }

        return 0;
    }

    public function get_all_relation_biologic_data_and_parks_data () {
        $query = "
            SELECT
                biologic_data.commonName,
                biologic_data.scientificName,
                biologic_data.description,
                biologic_data.authorBiologicData,
                biologic_data.naturalHistory,
                biologic_data.geographicalDistribution,
                parks_data.namePark,
                parks_data.recreationAreas,
                parks_data.latitude,
                parks_data.length,
                parks_data.street,
                parks_data.suburb
            FROM pivot_biologic_park
            INNER JOIN biologic_data ON pivot_biologic_park.idBiologic = biologic_data.id
            INNER JOIN parks_data ON pivot_biologic_park.idParksData = parks_data.id;
        ";

        return $this->select_query($query);
    }

    public function get_all_relation_biologic_data_and_parks_data_by_biologic_data_id ($biologic_data_id) {
        $query = "
            SELECT
                biologic_data.commonName,
                biologic_data.scientificName,
                biologic_data.description,
                biologic_data.authorBiologicData,
                biologic_data.naturalHistory,
                biologic_data.geographicalDistribution,
                parks_data.namePark,
                parks_data.recreationAreas,
                parks_data.latitude,
                parks_data.length,
                parks_data.street,
                parks_data.suburb
            FROM pivot_biologic_park
            INNER JOIN biologic_data ON pivot_biologic_park.idBiologic = biologic_data.id
            INNER JOIN parks_data ON pivot_biologic_park.idParksData = parks_data.id
            WHERE biologic_data.id = ?;
        ";

        return $this->select_query($query, array($biologic_data_id));
    }

    public function get_all_relation_biologic_data_and_parks_data_with_img_way_desc () {
        $query = "
            SELECT pivot_biologic_park.id,
                   pivot_biologic_park.idBiologic,
                   pivot_biologic_park.idParksData,
                   biologic_data.commonName AS commonName,
                   biologic_data.scientificName AS scientificName,
                   parks_data.namePark as NamePark,
                   parks_data.street AS Street,
                   parks_data.suburb AS Suburb,
                   images_biologic_data.name AS name_img_biologic_data,
                   images_biologic_data.ruta AS path_img_biologic_data,
                   images_parks.name as name_img_parks,
                   images_parks.ruta AS path_img_parks
            FROM pivot_biologic_park
            RIGHT OUTER JOIN biologic_data ON pivot_biologic_park.idBiologic = biologic_data.id
            RIGHT OUTER JOIN parks_data ON pivot_biologic_park.idParksData = parks_data.id
            LEFT JOIN images_biologic_data ON biologic_data.id = images_biologic_data.idBiologicalData
            LEFT JOIN images_parks ON parks_data.id = images_parks.idParks
            ORDER BY pivot_biologic_park.id DESC;
        ";
        return $this->select_query($query);
    }

    public function get_all_name_park_and_biologic_data_from_parks_id ($id) {
        $query = "
            SELECT
                biologic_data.commonName,
                parks_data.namePark
            FROM pivot_biologic_park
            INNER JOIN biologic_data ON pivot_biologic_park.idBiologic = biologic_data.id
            INNER JOIN parks_data ON pivot_biologic_park.idParksData = parks_data.id
            WHERE parks_data.id = ?;
        ";

        return $this->select_query($query, array($id));

    }

    public function get_all_name_park_and_biologic_data_from_biologic_data_id ($id) {
        $query = "
            SELECT
                biologic_data.commonName,
                parks_data.namePark
            FROM pivot_biologic_park
            INNER JOIN biologic_data ON pivot_biologic_park.idBiologic = biologic_data.id
            INNER JOIN parks_data ON pivot_biologic_park.idParksData = parks_data.id
            WHERE biologic_data.id = ?;
        ";

        return $this->select_query($query, array($id));

    }

    public function get_all_name_park_and_biologic_data_from_biologic_data_id_and_parks_id ($biologic_data_id, $parks_id) {
        $query = "
            SELECT
                biologic_data.commonName,
                parks_data.namePark
            FROM pivot_biologic_park
            INNER JOIN biologic_data ON pivot_biologic_park.idBiologic = biologic_data.id
            INNER JOIN parks_data ON pivot_biologic_park.idParksData = parks_data.id
            WHERE biologic_data.id = ? AND parks_data.id = ?;
        ";

        return $this->select_query($query, array($biologic_data_id, $parks_id));

    }


}