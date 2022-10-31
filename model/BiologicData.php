<?php

class BiologicData extends Controller {

    public function __construct()
    {
        parent::__construct('biologic_park');
    }

    public function get_all_biological_data () {
        $query = "SELECT biologic_data.commonName, biologic_data.scientificName, biologic_data.description, ".
                         "biologic_data.geographicalDistribution, biologic_data.naturalHistory, ".
                         "biologic_data.statusConservation, biologic_data.authorBiologicData, ".
                         "category.description as category, ".
                         "users.firstName as user ".
                 "FROM biologic_data ".
                 "INNER JOIN category ON biologic_data.idCategory = category.id ".
                 "INNER JOIN users on biologic_data.idUser = users.id;";
        return $this->select_query($query);
    }

    public function get_all_biologic_data_by_common_name ($search_common_name) {
        $search_common_name = "%".$search_common_name."%";
        $query = "SELECT biologic_data.commonName, biologic_data.scientificName, biologic_data.description, ".
                         "biologic_data.geographicalDistribution, biologic_data.naturalHistory, ".
                         "biologic_data.statusConservation, biologic_data.authorBiologicData, ".
                         "category.description as category, ".
                         "users.firstName as user ".
                 "FROM biologic_data ".
                 "INNER JOIN category ON biologic_data.idCategory = category.id ".
                 "INNER JOIN users on biologic_data.idUser = users.id ".
                 "WHERE biologic_data.commonName LIKE ?;";
        return $this->select_query($query, array($search_common_name));
    }

    public function get_all_biologic_data_by_scientific_data ($search_scientific_data) {
        $search_scientific_data = "%".$search_scientific_data."%";
        $query = "SELECT biologic_data.commonName, biologic_data.scientificName, biologic_data.description, ".
                        "biologic_data.geographicalDistribution, biologic_data.naturalHistory, ".
                        "biologic_data.statusConservation, biologic_data.authorBiologicData, ".
                        "category.description as category, ".
                        "users.firstName as user ".
                 "FROM biologic_data ".
                 "INNER JOIN category ON biologic_data.idCategory = category.id ".
                 "INNER JOIN users on biologic_data.idUser = users.id ".
                 "WHERE biologic_data.scientificName LIKE ?;";
        return $this->select_query($query, array($search_scientific_data));
    }

}