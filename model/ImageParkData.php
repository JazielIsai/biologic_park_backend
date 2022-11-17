<?php

class ImageParkData extends  Controller {

    public function __construct()
    {
        parent::__construct('u400281830_biologic_park');
    }

    public function add_image_to_parks ($name, $ruta, $author, $id, $idUser) {
        $query = "
            INSERT INTO images_parks(name, ruta, author, idParks, idUser)
            VALUES (?, ?, ?, ?, ?);
        ";
        $query_data = array($name, $ruta, $author, $id, $idUser);

        return $this->insert_query($query, array($query_data));
    }

    public function upload_image_by_park_data ($data) {

        $fileImage = './Images/ImgParksData/';

        if (!is_dir($fileImage)) {
            mkdir($fileImage, 0755, true);
        }

        var_dump($data);

        $img_path = $fileImage . $data->id . '_' . $data->name . '.png' ;

        if (!isset($_FILES['photo'])) {
            return 0;
        }

        if(move_uploaded_file($_FILES['photo']['tmp_name'], $img_path )){
            $save_path = 'biological_parks_backend/Images/ImgParksData/' . $data->id . '_' . $data->name . '.png' ;
            $this->add_image_to_parks($data->name, $save_path, $data->author, $data->id, $data->idUser);
            return 1;
        }

        return 0;
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

    public function delete_img_park_data ($id, $path) {

        if (unlink($path)) {
            // file was successfully deleted
            echo 'file deleted';
        } else {
            // there was a problem deleting the file
            echo 'the file didnt cannot delete';
        }

        $query = "
            DELETE FROM images_biologic_data WHERE id = ?;
        ";

        $query_data = array($id);

        return $this->update_delete_query($query, array($query_data));
    }

}