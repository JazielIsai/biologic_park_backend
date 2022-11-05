<?php

class ImagesBiologicData extends Controller {

    public function __construct()
    {
        parent::__construct('biologic_park');
    }

    public function upload_image_by_biologic_data ($image_data) {
        $fileImage = '../Images/ImgBiologicData';

        if (!is_dir($fileImage)) {
           mkdir($fileImage);
        }

        $imgBiologicData = './';
        if ( isset($_FILES['img']) ) {
            $nameImg = $_FILES['img']['name'];
            $ruta = $_FILES['img']['tmp_name'];
            $destination = '';
            if (move_uploaded_file($ruta, $destination)) {
                $query = "INSERT INTO images_biologic_data(name, ruta, author, idBiologicalData, idUser)
                           VALUES (?,?,?,?,?)";

                return $this->insert_query($query, $data);

            }
        }
    }

    public function get_img_by_name () {

    }

}