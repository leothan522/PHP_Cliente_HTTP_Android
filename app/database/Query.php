<?php

namespace database;

class Query extends Conexion
{

    public function getFirst($sql)
    {
        $statement = $this->CONEXION->prepare($sql);
        $statement->execute();
        $row = $statement->fetch();
        return $row;
    }

    public function getAll($sql)
    {
        $statement = $this->CONEXION->prepare($sql);
        $statement->execute();
        $rows = array();
        while ($result = $statement->fetch()) {
            array_push($rows, $result);
        }
        return $rows;
    }

    public function save($sql)
    {
        $statement = $this->CONEXION->prepare($sql);
        $statement->execute();
        return $statement;
    }

    public function count($sql)
    {
        $statement = $this->CONEXION->prepare($sql);
        $statement->execute();
        $count = $statement->fetchColumn();
        return $count;
    }

}