<?php

namespace model;

use database\Query;

class Model
{
    public $TABLA;
    public $DATA;

    public function getAll($band = null)
    {
        $extra = null;
        if (!is_null($band)) {
            $extra = "WHERE `band`= $band";
        }
        $query = new Query();
        $sql = "SELECT * FROM `$this->TABLA` $extra  ;";
        $rows = $query->getAll($sql);
        return $rows;
    }

    public function paginate($limit, $offset = null, $orderBy = 'id', $opt = 'ASC', $band = null)
    {
        $extra = null;
        if (!is_null($band)) {
            $extra = "WHERE `band`= $band";
        }
        if (!is_null($offset)) {
            $offset = $offset . ",";
        }
        $query = new Query();
        $sql = "SELECT * FROM `$this->TABLA` $extra ORDER BY `$orderBy` $opt LIMIT $offset $limit;";
        $rows = $query->getAll($sql);
        return $rows;
    }

    public function getList($campo, $operador, $valor, $band = null)
    {
        $extra = null;
        if (!is_null($band)) {
            $extra = "AND `band`= $band";
        }
        $query = new Query();
        $sql = "SELECT * FROM `$this->TABLA` WHERE `$campo` $operador '$valor' $extra; ";
        $rows = $query->getAll($sql);
        return $rows;
    }

    public function count($band = null)
    {
        $extra = null;
        if (!is_null($band)) {
            $extra = "WHERE `band`= $band";
        }
        $query = new Query();
        $sql = "SELECT COUNT(*) FROM `$this->TABLA` $extra ;";
        $rows = $query->count($sql);
        return $rows;
    }

    public function find($id)
    {
        $query = new Query();
        $sql = "SELECT * FROM `$this->TABLA` WHERE `id`= '$id'; ";
        $rows = $query->getfirst($sql);
        return $rows;
    }

    public function first($campo, $operador, $valor)
    {
        $query = new Query();
        $sql = "SELECT * FROM `$this->TABLA` WHERE `$campo` $operador '$valor'; ";
        $rows = $query->getfirst($sql);
        return $rows;
    }

    public function existe($campo, $operador, $valor, $id = null, $band = null)
    {
        $extra = null;
        $edit = null;
        if ($band) {
            $extra = "AND `band`= $band";
        }
        if ($id) {
            $edit = "AND `id` != '$id'";
        }
        $query = new Query();
        $sql = "SELECT * FROM `$this->TABLA` WHERE `$campo` $operador '$valor' $extra $edit;";
        $row = $query->getFirst($sql);
        return $row;
    }

    public function save($data = array())
    {
        $query = new Query();
        $campos = "(";
        foreach ($this->DATA as $campo) {
            $campos .= "`$campo`, ";
        }
        $campos .= ")exit";
        $campos = str_replace(", )exit", ")", $campos);
        $values = "(";
        foreach ($data as $input) {
            $values .= "'$input', ";
        }
        $values .= ")exit";
        $values = str_replace(", )exit", ")", $values);

        $sql = "INSERT INTO `$this->TABLA` $campos VALUES $values;";

        $row = $query->save($sql);
        return $row;
    }

    public function update($id, $campo, $valor)
    {
        $query = new Query();
        $sql = "UPDATE `$this->TABLA` SET `$campo` = '$valor' WHERE `id` = '$id';";
        $row = $query->save($sql);
        return $row;
    }

    public function delete($id)
    {
        $query = new Query();
        $sql = "DELETE FROM `$this->TABLA` WHERE  `id` = $id;";
        $row = $query->save($sql);
        return $row;
    }

}