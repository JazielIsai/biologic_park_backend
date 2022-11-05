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

    public function get_image_by_parks_data () {

    }

}