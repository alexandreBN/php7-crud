<?php

class UserDAO extends GenericDAO
{
    public function __construct()
    {
        parent::__construct("tb_users");
    }

    /**
     * Inserção de usuário
     * @return id
     */
    public function insert(User $user) {
        $query = "INSERT INTO $this->tableName (username, passwd) VALUES (:USERNAME, :PASSWD)";
        
        $parametersMapped = array(
            ":USERNAME" => $user->getUsername(),
            ":PASSWD" => $user->getPasswd()
        );

        $statement = parent::execute($query, $parametersMapped);
        $success = $statement->rowCount() > 0;
        
        if(!$success) {
            throw new Exception(GenericMessage::INVALID_PARAMETERS);
        }

        $id = $this->getByUsername($user->getUsername())->getId();
        return $id;
    }

    /**
     * Atualização de usuário
     * @return id
     */
    public function update($id, User $user) {
        $query = "UPDATE $this->tableName
                  SET username = :USERNAME, passwd = :PASSWD
                  WHERE id = :ID";
        
        $parametersMapped = array(
            ":USERNAME" => $user->getUsername(),
            ":PASSWD" => $user->getPasswd(),
            ":ID" => $id
        );

        $statement = parent::execute($query, $parametersMapped);
        $success = $statement->rowCount() > 0;
        
        if(!$success) {
            throw new Exception(GenericMessage::INVALID_PARAMETERS);
        }

        return $id;
    }

    /**
     * Busca de usuário baseada no id
     * @return user
     */
    public function get($id) {
        $result = parent::get($id);
        $user = $this->mapFirstResultAsUser($result);
        return $user;
    }

    /**
     * Busca de usuário baseada no username
     * @return user
     */
    public function getByUsername($username) {
        $query = "SELECT * FROM $this->tableName
                  WHERE username = :USERNAME";

        $parametersMapped = array(
            ":USERNAME" => $username
        );

        $statement = parent::execute($query, $parametersMapped);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($result) <= 0) {
            throw new Exception(GenericMessage::INVALID_PARAMETERS);
        }

        $user = $this->mapFirstResultAsUser($result);
        return $user;
    }

    /**
     * Busca de um usuário baseada no seu username e senha
     * @return user
     */
    public function getByUsernamePassword($username, $password) {
        $query = "SELECT * FROM tb_users WHERE username = :USER AND passwd = :PASS";

        $parametersMapped = array(
            ":USER" => $username,
            ":PASS" => HashAlgorithm::getHash($password)
        );

        $statement = parent::execute($query, $parametersMapped);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($result) <= 0) {
            throw new Exception(GenericMessage::INVALID_PARAMETERS);
        }

        $user = new User();
        $user->map($result[0]);
        return $user;
    }

    /**
     * Procura de usuários baseada no username
     * @return list
     */
    public function search($username) {
        
        $query = "SELECT * FROM $this->tableName
                  WHERE username LIKE :USERNAME";
        
        $parametersMapped = array(
            ':USERNAME' => "%$username%"
        );

        $statement = parent::execute($query, $parametersMapped);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(count($result) > 0)  {
            $users = array();
            
            foreach($result as $user) {
                $userMapped = new User();
                $userMapped->map($user);
                array_push($users, $userMapped);
            }

            return $users;
        }
    }
    
    /**
     * Busca de todos os registros de usuários
     * @return list
     */
    public function getAll() {
        $result = parent::getAll();

        if(count($result) > 0)  {
            $users = array();
            
            foreach($result as $user) {
                $userMapped = new User();
                $userMapped->map($user);
                array_push($users, $userMapped);
            }

            return $users;
        }
    }
    
    /**
     * Mapeia o primeiro resultado de uma lista de resultados para um usuário
     * @return user
     */
    private function mapFirstResultAsUser($resultList) {
        $row = $resultList[0];
        $user = new User();
        $user->map($row);
        return $user;
    }

}
