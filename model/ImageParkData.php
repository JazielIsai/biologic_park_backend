<?php

class ImageParkData extends  Controller {

    public function __construct()
    {
        parent::__construct('biologic_park');
    }

    public function upload_image_by_park_data () {

        $fileImage = '../Images/ImgParksData';

        if (!is_dir($fileImage)) {
            mkdir($fileImage);
        }



    }

    public function get_image_by_parks_data_id ($park_data_id) {
        $query = "
            SELECT images_parks.id,
                   images_parks.name,
                   images_parks.ruta,
                   images_parks.author,
                   images_parks.sightingDate,
                   images_parks.idParks,
                   users.firstName AS imageWasResgisterByUser
            FROM images_parks
            INNER JOIN users ON images_parks.idUser = users.id
            WHERE images_parks.idParks = ?;
        ";

        return $this->select_query($query, array($park_data_id));
    }

    public function get_images_by_user ($user_id) {
        $query = "
            SELECT images_parks.id,
                   images_parks.name,
                   images_parks.ruta,
                   images_parks.author,
                   images_parks.sightingDate,
                   images_parks.idParks,
                   users.firstName AS imageWasResgisterByUser
            FROM images_parks
            INNER JOIN users ON images_parks.idUser = users.id
            WHERE images_parks.idUser = ?;
        ";
        return $this->select_query($query, array($user_id));
    }

    public function add_image_to_parks ($data) {
        $query = "
            INSERT INTO images_parks(name, ruta, author, idParks, idUser)
            VALUES (?, ?, ?, ?, ?);
        ";
        $query_data = array($data->name, $data->ruta, $data->author, $data->idParks, $data->idUser);

        return $this->insert_query($query, array($query_data));
    }

}