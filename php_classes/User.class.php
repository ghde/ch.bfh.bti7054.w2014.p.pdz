<?php

/**
 * Created by IntelliJ IDEA.
 * User: decla
 * Date: 04.12.2014
 * Time: 17:18
 */
class User
{

    private $id;

    private $username;

    private $firstname;

    private $lastname;

    private $loggedIn = false;

    private $failedLoginTry = false;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setLastname($lastname)
    {
        $this->firstlastnamename = $lastname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLoggedIn($loggedIn)
    {
        $this->loggedIn = $loggedIn;
    }

    public function isLoggedIn()
    {
        return $this->loggedIn;
    }

    public function setFailedLoginTry($failedLoginTry)
    {
        $this->failedLoginTry = $failedLoginTry;
    }

    public function isFailedLoginTry()
    {
        return $this->failedLoginTry;
    }

}