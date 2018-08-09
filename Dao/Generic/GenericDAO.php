<?php

abstract class GenericDAO implements IGenericDAO {
    protected $tableName;

    public function __construct($tableName) {
        $this->tableName = $tableName;
    }

    /**
     * Executa a query genérica e retorna o statement
     * @return statement
     */
    protected function execute($rawQuery, $parametersMapped) {
        $sql = new SQL();
        $statement = $sql->execute($rawQuery, $parametersMapped);
        return $statement;
    }

    /**
     * Busca genérica baseada no id
     * @return list
     */
    public function get($id) {
        $query = "SELECT * FROM $this->tableName
                  WHERE id = :ID";
        
        $parametersMapped = array(
            ":ID" => $id
        );
        
        $statement = $this->execute($query, $parametersMapped);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($result) <= 0) {
            throw new Exception(GenericMessage::INVALID_PARAMETERS);
        }

        return $result;
    }
    
    /**
     * Remoção genérica baseada no id
     * @return id
     */
    public function delete($id) {
        $query = "DELETE FROM $this->tableName
                  WHERE id = :ID";
        
        $parametersMapped = array(
            ":ID" => $id
        );

        $statement = $this->execute($query, $parametersMapped);
        $count = $statement->rowCount();

        if($count <= 0) {
            throw new Exception(GenericMessage::INVALID_PARAMETERS);
        }

        return $id;
    }

    /**
     * Busca genérica de todos os registros
     * @return list
     */
    public function getAll() {
        $query = "SELECT * FROM $this->tableName";
        $statement = $this->execute($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}