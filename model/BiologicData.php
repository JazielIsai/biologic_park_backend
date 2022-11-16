<?php

class BiologicData extends Controller {

    public function __construct()
    {
        parent::__construct('biologic_park');
    }

    public function get_all_name_and_id_biologic_data ($idUser) {
        $query = "
            SELECT biologic_data.id, biologic_data.commonName 
            FROM biologic_data
            WHERE biologic_data.idUser = ?;
        ";

        return $this->select_query($query, array($idUser));
    }

    public function get_all_biological_data () {
        $query =
            "SELECT biologic_data.commonName, biologic_data.scientificName, biologic_data.description, 
                biologic_data.geographicalDistribution, biologic_data.naturalHistory, 
                biologic_data.statusConservation, biologic_data.authorBiologicData, 
                category.description as category, 
                users.firstName as user 
            FROM biologic_data 
            INNER JOIN category ON biologic_data.idCategory = category.id 
            INNER JOIN users on biologic_data.idUser = users.id;";
        return $this->select_query($query);
    }

    public function get_all_biologic_data_by_common_name ($search_common_name) {
        $search_common_name = "%".$search_common_name."%";
        $query =
            "SELECT biologic_data.commonName, biologic_data.scientificName, biologic_data.description,
                biologic_data.geographicalDistribution, biologic_data.naturalHistory, 
                biologic_data.statusConservation, biologic_data.authorBiologicData, 
                category.description as category,
                users.firstName as user 
            FROM biologic_data 
            INNER JOIN category ON biologic_data.idCategory = category.id 
            INNER JOIN users on biologic_data.idUser = users.id 
            WHERE biologic_data.commonName LIKE ?;";
        return $this->select_query($query, array($search_common_name));
    }

    public function get_all_biologic_data_by_scientific_data ($search_scientific_data) {
        $search_scientific_data = "%".$search_scientific_data."%";
        $query =
            "SELECT biologic_data.commonName, biologic_data.scientificName, biologic_data.description,
                biologic_data.geographicalDistribution, biologic_data.naturalHistory, 
                biologic_data.statusConservation, biologic_data.authorBiologicData, 
                category.description as category, 
                users.firstName as user 
            FROM biologic_data 
            INNER JOIN category ON biologic_data.idCategory = category.id 
            INNER JOIN users on biologic_data.idUser = users.id 
            WHERE biologic_data.scientificName LIKE ?;";
        return $this->select_query($query, array($search_scientific_data));
    }

    public function get_biologic_data_by_user_id ($user_id) {
        $query = "
            SELECT biologic_data.commonName, biologic_data.scientificName, biologic_data.description,
                   biologic_data.geographicalDistribution, biologic_data.naturalHistory,
                   biologic_data.statusConservation, biologic_data.authorBiologicData,
                   category.description as category
            FROM biologic_data
            INNER JOIN category ON biologic_data.idCategory = category.id
            WHERE biologic_data.idUser = ?;
        ";

        return $this->select_query($query, array($user_id));
    }

    public function add_biologic_data ($data) {
        $query = "
            INSERT INTO biologic_data(commonName, scientificName,
                          description, geographicalDistribution,
                          naturalHistory, statusConservation, authorBiologicData,
                          idCategory, idUser)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);
        ";
        $query_data = array($data->commonName, $data->scientificName, $data->description, $data->geographicalDistribution, $data->naturalHistory, $data->statusConservation, $data->authorBiologicData, $data->idCategory, $data->idUser);

        return $this->insert_query($query, array($query_data));
    }

}