<?php

class JoinsTables extends Controller {

    public function __construct()
    {
        parent::__construct('u400281830_biologic_park');
    }

    public function get_join_tables_parks_and_biologic_data ($parks_user_id, $biological_data_user_id) {
        $query = "
                (SELECT
                    CASE
                        WHEN biologic_data.id IS NOT NULL THEN 'Biologic Data'
                    END AS verificate,
                    biologic_data.commonName AS names,
                    biologic_data.scientificName AS column1,
                    biologic_data.description AS column2,
                    biologic_data.authorBiologicData AS column3,
                    biologic_data.naturalHistory AS column4,
                    biologic_data.geographicalDistribution AS column5,
                    biologic_data.registrationDate AS registrationDate
                FROM biologic_data WHERE biologic_data.idUser = ?
                UNION
                SELECT
                    CASE
                        WHEN parks_data.id IS NOT NULL THEN 'Parks Data'
                    END AS verificate,
                    parks_data.namePark AS names,
                    parks_data.recreationAreas AS column1,
                    parks_data.latitude AS column2,
                    parks_data.length AS column3,
                    parks_data.street AS column4,
                    parks_data.suburb AS column5,
                    parks_data.registrationDate AS registrationDate
                FROM parks_data WHERE idUser = ?)
                ORDER BY registrationDate DESC;
        ";

        return $this->select_query($query, array($parks_user_id, $biological_data_user_id));
    }

    public function get_join_tables_images ($parks_user_id, $biologic_user_id) {
        $query = "
            (SELECT
                images_biologic_data.id,
                images_biologic_data.name,
                images_biologic_data.ruta,
                images_biologic_data.author,
                images_biologic_data.sightingDate,
                images_biologic_data.idBiologicalData
            FROM images_biologic_data
            WHERE images_biologic_data.idUser = ?
            UNION ALL
            SELECT
                images_parks.id,
                images_parks.name,
                images_parks.ruta,
                images_parks.author,
                images_parks.sightingDate,
                images_parks.idParks
            FROM images_parks
            WHERE images_parks.idUser = ?
            ) ORDER BY sightingDate DESC;
        ";
        return $this->select_query($query, array($parks_user_id, $biologic_user_id));
    }

    public function get_data_and_img_parks_biologic ($parks_user_id, $biologic_user_id, $img_parks_user_id, $img_biologic_user_id) {

        $query = "
            (SELECT
                CASE
                    WHEN biologic_data.id IS NOT NULL THEN 'Biologic Data'
                END AS verificate,
                biologic_data.id AS ID,
                biologic_data.commonName AS names,
                biologic_data.scientificName AS column1,
                biologic_data.description AS column2,
                biologic_data.authorBiologicData AS column3,
                biologic_data.naturalHistory AS column4,
                biologic_data.geographicalDistribution AS column5,
                biologic_data.registrationDate AS registrationDate
            FROM biologic_data WHERE biologic_data.idUser = ?
            UNION ALL
            SELECT
                CASE
                    WHEN parks_data.id IS NOT NULL THEN 'Parks Data'
                END AS verificate,
                parks_data.id AS ID,
                parks_data.namePark AS names,
                parks_data.recreationAreas AS column1,
                parks_data.latitude AS column2,
                parks_data.length AS column3,
                parks_data.street AS column4,
                parks_data.suburb AS column5,
                parks_data.registrationDate AS registrationDate
            FROM parks_data WHERE idUser = ?
            UNION ALL
            SELECT
                CASE
                    WHEN images_biologic_data.id IS NOT NULL THEN 'img biologic data'
                END AS verificate,
                images_biologic_data.id AS ID,
                images_biologic_data.id,
                images_biologic_data.name,
                images_biologic_data.ruta,
                images_biologic_data.author,
                images_biologic_data.idBiologicalData,
                images_biologic_data.idUser,
                images_biologic_data.sightingDate AS registrationDate
            FROM images_biologic_data
            WHERE images_biologic_data.idUser = ?
            UNION ALL
            SELECT
                CASE
                    WHEN images_parks.id IS NOT NULL THEN 'img parks data'
                END AS verificate,
                images_parks.id AS ID,
                images_parks.id,
                images_parks.name,
                images_parks.ruta,
                images_parks.author,
                images_parks.idParks,
                images_parks.idUser,
                images_parks.sightingDate AS registrationDate
            FROM images_parks
            WHERE images_parks.idUser = ?
            )ORDER BY registrationDate DESC;
        ";

        return $this->select_query($query, array($parks_user_id, $biologic_user_id, $img_parks_user_id, $img_biologic_user_id));
    }

    public function get_all_data_img_biologic_data_and_parks () {

        $query = "
            (SELECT
                CASE
                    WHEN biologic_data.id IS NOT NULL THEN 'Biologic Data'
                END AS verificate,
                biologic_data.id AS ID,
                biologic_data.commonName AS names,
                biologic_data.scientificName AS column1,
                biologic_data.description AS column2,
                biologic_data.authorBiologicData AS column3,
                biologic_data.naturalHistory AS column4,
                biologic_data.geographicalDistribution AS column5,
                biologic_data.registrationDate AS registrationDate
            FROM biologic_data
            UNION ALL
            SELECT
                CASE
                    WHEN parks_data.id IS NOT NULL THEN 'Parks Data'
                END AS verificate,
                parks_data.id AS ID,
                parks_data.namePark AS names,
                parks_data.recreationAreas AS column1,
                parks_data.latitude AS column2,
                parks_data.length AS column3,
                parks_data.street AS column4,
                parks_data.suburb AS column5,
                parks_data.registrationDate AS registrationDate
            FROM parks_data
            UNION ALL
            SELECT
                CASE
                    WHEN images_biologic_data.id IS NOT NULL THEN 'img biologic data'
                END AS verificate,
                images_biologic_data.id AS ID,
                images_biologic_data.id,
                images_biologic_data.name,
                images_biologic_data.ruta,
                images_biologic_data.author,
                images_biologic_data.idBiologicalData,
                images_biologic_data.idUser,
                images_biologic_data.sightingDate AS registrationDate
            FROM images_biologic_data
            UNION ALL
            SELECT
                CASE
                    WHEN images_parks.id IS NOT NULL THEN 'img parks data'
                END AS verificate,
                images_parks.id AS ID,
                images_parks.id,
                images_parks.name,
                images_parks.ruta,
                images_parks.author,
                images_parks.idParks,
                images_parks.idUser,
                images_parks.sightingDate AS registrationDate
            FROM images_parks
            )ORDER BY registrationDate DESC;

        ";

        return $this->select_query($query);
    }

    public function search_data_img_parks_biologic_data ($commonName, $namePark, $nameImg1, $nameImg2) {

        $commonName = "%" . $commonName . "%";
        $namePark = "%" . $namePark . "%";
        $nameImg1 = "%" . $nameImg1 . "%";
        $nameImg2 = "%" . $nameImg2 . "%";

        $query = "
            (SELECT
                CASE
                    WHEN biologic_data.id IS NOT NULL THEN 'Biologic Data'
                END AS verificate,
                biologic_data.id AS ID,
                biologic_data.commonName AS names,
                biologic_data.scientificName AS column1,
                biologic_data.description AS column2,
                biologic_data.authorBiologicData AS column3,
                biologic_data.naturalHistory AS column4,
                biologic_data.geographicalDistribution AS column5,
                biologic_data.registrationDate AS registrationDate
            FROM biologic_data
            WHERE biologic_data.commonName LIKE ?
            UNION ALL
            SELECT
                CASE
                    WHEN parks_data.id IS NOT NULL THEN 'Parks Data'
                END AS verificate,
                parks_data.id AS ID,
                parks_data.namePark AS names,
                parks_data.recreationAreas AS column1,
                parks_data.latitude AS column2,
                parks_data.length AS column3,
                parks_data.street AS column4,
                parks_data.suburb AS column5,
                parks_data.registrationDate AS registrationDate
            FROM parks_data
            WHERE parks_data.namePark LIKE ?
            UNION ALL
            SELECT
                CASE
                    WHEN images_biologic_data.id IS NOT NULL THEN 'img biologic data'
                END AS verificate,
                images_biologic_data.id AS ID,
                images_biologic_data.id,
                images_biologic_data.name,
                images_biologic_data.ruta,
                images_biologic_data.author,
                images_biologic_data.idBiologicalData,
                images_biologic_data.idUser,
                images_biologic_data.sightingDate AS registrationDate
            FROM images_biologic_data
            WHERE images_biologic_data.name LIKE ?
            UNION ALL
            SELECT
                CASE
                    WHEN images_parks.id IS NOT NULL THEN 'img parks data'
                END AS verificate,
                images_parks.id AS ID,
                images_parks.id,
                images_parks.name,
                images_parks.ruta,
                images_parks.author,
                images_parks.idParks,
                images_parks.idUser,
                images_parks.sightingDate AS registrationDate
            FROM images_parks
            WHERE images_parks.name LIKE ?
            ) ORDER BY registrationDate DESC;
        ";

        return $this->select_query($query, array($commonName, $namePark, $nameImg1, $nameImg2));
    }

}