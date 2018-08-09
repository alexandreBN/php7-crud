<?php

class User
{
    private $id;
    private $username;
    private $passwd;
    private $dtRegister;

    public function __construct($username = null, $passwd = null) {
        $this->setUsername($username);
        $this->setPasswd($passwd);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of dtRegister
     */ 
    public function getDtRegister()
    {
        return $this->dtRegister->format("d/m/y H:i:s");
    }

    /**
     * Set the value of dtRegister
     *
     * @return  self
     */ 
    public function setDtRegister($dtRegister)
    {
        $this->dtRegister = $dtRegister;

        return $this;
    }

    /**
     * Get the value of passwd
     */ 
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Set the value of passwd
     *
     * @return  self
     */ 
    public function setPasswd($passwd)
    {
        $this->passwd = HashAlgorithm::getHash($passwd);

        return $this;
    }

    public function map($user) {
        $this->setUsername($user['username']);
        $this->setPasswd($user['passwd']);
        $this->setDtRegister(new DateTime($user['dt_register']));
        $this->setId($user['id']);
    }

    public function __toString() {
        return "Username: " . $this->getUsername() . "<br />
                Password: " . $this->getPasswd() . "<br />
                Register Date: " . $this->getDtRegister() ."<br />";
    }
}
