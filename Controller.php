<?php

class Controller extends DBCnx
{

    public function __construct($db)
    {
        parent::__construct($db);
    }

    public function select_query($query, $params = []) {
        try {
            $data = array();

            $prepare_consult = $this->Connection()->prepare($query);

            if ($params) {
                $prepare_consult->execute($params);
            } else {
                $prepare_consult->execute();
            }

            if ($prepare_consult->rowCount()) {

                while ($row = $prepare_consult->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }
            }

            $prepare_consult = null;
            return $data;

        } catch (Error $err) {
            echo 'Error in the method select_query -> '.$err;
            return false;
        }

    }

    public function insert_query ($query, $data) {

        try {
            $prepare_query = $this->Connection()->prepare($query);

            foreach ( $data as $row ) {
                $prepare_query->execute($row);
            }

            $id = $this->Connection()->lastInsertId();
            $prepare_query = null;
            return $id;

        } catch (Error $err) {
            echo 'Error in the method insert_query' . $err;
            return false;
        }

    }

    public function update_delete_query ($query, $data) {
        try {

            $prepare_query = $this->Connection()->prepare($query);

            foreach ($data as $row) {
                $prepare_query->execute($row);
            }

            $rowCount = $prepare_query->rowCount();
            $prepare_query = null;
            return $rowCount;

        } catch (Error $err) {
            return false;
        }
    }

}