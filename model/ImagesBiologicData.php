<?php

class ImagesBiologicData extends Controller {

    public function __construct()
    {
        parent::__construct('biologic_park');
    }

    public function add_img_biologic_data ($name, $ruta, $author, $id, $idUser) {

        echo $name . ' - ' . $ruta . ' - ' . $author . ' - ' . $id . ' - ' . $idUser;

        $query = "
            INSERT INTO images_biologic_data (name, ruta, author, idBiologicalData, idUser)
            VALUES (?, ?, ?, ?, ?);
        ";
        $query_data = array($name, $ruta, $author, $id, $idUser);

        return $this->insert_query($query, array($query_data));
    }

    public function upload_image_by_biologic_data ($data) {

        $fileImage = './Images/ImgBiologicData/';

        if (!is_dir($fileImage)) {
            mkdir($fileImage, 0755, true);
        }

        var_dump($data);

        $img_path = $fileImage . $data->id . '_' . $data->name . '.png';

        if (!isset($_FILES['photo'])) {
            return 0;
        }

        if( move_uploaded_file($_FILES['photo']['tmp_name'], $img_path )){
            $save_path = 'biological_parks_backend/Images/ImgBiologicData/' . $data->id . '_' . $data->name . '.png';
            $this->add_img_biologic_data($data->name, $save_path, $data->author, $data->id, $data->idUser);
            return 1;
        }

        return 0;

    }

    public function get_img_by_biologic_data_id ($biologic_data_id) {
        $query = "
            SELECT images_biologic_data.id,
                   images_biologic_data.name,
                   images_biologic_data.ruta,
                   images_biologic_data.author,
                   images_biologic_data.sightingDate,
                   images_biologic_data.idBiologicalData,
                   users.firstName AS imageWasResgisterByUser
            FROM images_biologic_data
            INNER JOIN users ON images_biologic_data.idUser = users.id
            WHERE images_biologic_data.idBiologicalData = ?;

        ";
        return $this->select_query($query, array($biologic_data_id));
    }

    public function get_img_with_biologic_data_and_category ($biologic_data_id) {
        $query = "
            SELECT images_biologic_data.id, images_biologic_data.name,
                   images_biologic_data.ruta, images_biologic_data.author,
                   images_biologic_data.sightingDate, images_biologic_data.idBiologicalData,
                   biologic_data.id AS id_tl_biologic_data,
                   biologic_data.commonName, biologic_data.scientificName, biologic_data.description,
                   biologic_data.geographicalDistribution, biologic_data.naturalHistory,
                   biologic_data.statusConservation, biologic_data.authorBiologicData,
                   category.description AS category
            FROM images_biologic_data
            RIGHT JOIN biologic_data ON images_biologic_data.idBiologicalData = biologic_data.id
            INNER JOIN category ON biologic_data.idCategory = category.id
            WHERE biologic_data.id = ?;
        ";
        return $this->select_query($query, array($biologic_data_id));
    }

}