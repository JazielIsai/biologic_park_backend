<?php

class Parks extends Controller {

    public function __construct()
    {
        parent::__construct('biologic_park');
    }

    public function get_all_name_and_id_parks ($user_id) {
        $query = "
            SELECT id, namePark 
            FROM parks_data
            WHERE parks_data.idUser = ?;
        ";
        return $this->select_query($query, array($user_id));
    }

    // GET
    public function get_all_parks () {
        $query = "
            SELECT namePark, trainingBackground, areaHa, form, 
                   boundaries, recreationAreas, street, suburb, latitude, length,
                   municipality_bp.nameMunicipality AS municipality, city_states_bp.nameCityStates AS cityState,
                   users.firstName AS ParkWasRegisterByUser
            FROM parks_data
            INNER JOIN municipality_bp ON parks_data.idMunicipality = municipality_bp.id 
            INNER JOIN city_states_bp ON parks_data.idCityStates = city_states_bp.id
            INNER JOIN users ON parks_data.idUser = users.id;";

        return $this->select_query($query);
    }

    public function get_park_by_id ($idPark) {
        $query = "SELECT * FROM parks_data WHERE id = ?;";
        $idPark = array($idPark);
        return $this->select_query($query, $idPark);
    }

    public function get_parks_by_city_state ($cityState) {
        $cityState = "%".$cityState."%";

        $query = "
            SELECT namePark, trainingBackground, areaHa, form,
                   boundaries, recreationAreas, street, suburb, latitude, length,
                   municipality_bp.nameMunicipality AS municipality, city_states_bp.nameCityStates AS cityState
            FROM parks_data
            INNER JOIN municipality_bp ON parks_data.idMunicipality = municipality_bp.id
            INNER JOIN city_states_bp ON parks_data.idCityStates = city_states_bp.id
            WHERE city_states_bp.nameCityStates  LIKE ?;";

        return $this->select_query($query, array($cityState));
    }

    public function get_parks_by_municipality ($municipality) {
        $municipality = '%' . $municipality . '%';
        $query = "
                SELECT namePark, trainingBackground, areaHa, form,
                       boundaries, recreationAreas, street, suburb, latitude, length,
                       municipality_bp.nameMunicipality AS municipality, city_states_bp.nameCityStates AS cityState
                FROM parks_data
                INNER JOIN municipality_bp ON parks_data.idMunicipality = municipality_bp.id
                INNER JOIN city_states_bp ON parks_data.idCityStates = city_states_bp.id
                WHERE municipality_bp.nameMunicipality LIKE ?;";

        return $this->select_query($query, array($municipality));
    }

    public function get_park_by_name ($searchPark) {
        $searchPark = "%".$searchPark."%";
        $query = "
        SELECT namePark, trainingBackground, areaHa, form, boundaries,
               recreationAreas, street, suburb, latitude, length,
               municipality_bp.nameMunicipality as municipality,
               city_states_bp.nameCityStates AS cityState,
               users.firstName AS ParkWasRegisterByUser
         FROM parks_data
         INNER JOIN municipality_bp ON parks_data.idMunicipality = municipality_bp.id
         INNER JOIN city_states_bp ON parks_data.idCityStates = city_states_bp.id
         INNER JOIN users ON parks_data.idUser = users.id
         WHERE parks_data.namePark LIKE ?;";

        return $this->select_query($query, array($searchPark));
    }

    public function get_parks_by_user_id ($user_id) {
        $query = "
            SELECT parks_data.id, namePark, trainingBackground, areaHa, form,
                   boundaries, recreationAreas, street, suburb, latitude, length,
                   municipality_bp.nameMunicipality AS municipality, city_states_bp.nameCityStates AS cityState
            FROM parks_data
            INNER JOIN municipality_bp ON parks_data.idMunicipality = municipality_bp.id
            INNER JOIN city_states_bp ON parks_data.idCityStates = city_states_bp.id
            WHERE parks_data.idUser = ?;
        ";
        return $this->select_query($query, array($user_id));
    }

    // Insert
    public function add_park ($data) {

        $query = "
            INSERT INTO parks_data
                    (namePark, trainingbackground, areaha, form, boundaries,
                     recreationareas, street, suburb, latitude, length,
                     idmunicipality, idcitystates, idUser)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
        ";

        $query_data = array($data->namePark, $data->trainingbackground, $data->areaha, $data->form, $data->boundaries, $data->recreationareas, $data->street, $data->suburb, $data->latitude, $data->length, $data->idmunicipality, $data->idcitystates, $data->idUser);

        return $this->insert_query($query, array($query_data));
    }

    public function delete_park ($id) {
        $query = "
            DELETE FROM parks_data WHERE id = ?;
        ";
        $query_data = array($id);
        return $this->update_delete_query($query, array($query_data));
    }

}