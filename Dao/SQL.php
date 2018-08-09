<?php

class SQL extends PDO
{
    private $connection;

    public function __construct()
    {
		// TODO: construção automática das configurações do banco e leitura de credenciais de usuário
        $this->connection = new PDO("mysql:host=127.0.0.1;dbname=abnphp", "root", "root", SQLConfiguration::OPTIONS);
	}
	
	/**
	 * Atualiza os parâmetros da query
	 */
    private function setParameters($statement, $parameters)
    {
        foreach ($parameters as $key => &$value) {
            $statement->bindParam($key, $value);
        }
	}
	
	/**
	 * Executa uma transação de acordo com a query e seus parâmetros
	 */
    public function execute($rawQuery, $parameters = array())
    {
        try {
            $this->connection->beginTransaction();
            $statement = $this->connection->prepare($rawQuery);
            $this->setParameters($statement, $parameters);
            $statement->execute();
            $this->connection->commit();
        } catch (Exception $e) {
            $this->connection->rollback();
        }

        return $statement;
	}
	
    public function getConnection()
    {
        return $this->connection;
    }
}
