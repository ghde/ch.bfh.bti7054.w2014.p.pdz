<?php

/**
 * Created by IntelliJ IDEA.
 * User: pfafs1
 * Date: 06.12.2014
 * Time: 15:18
 */
class Customer
{
    private $accountName;

    private $firstName;

    private $lastName;

    private $gender;

    private $company;

    public function setAccountName($accountName) {
        $this->accountName = $accountName;
    }

    public function getAccountName() {
        return $this->accountName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getGender() {
        return $this->gender;
    }

    public function setCompany($company) {
        $this->company = $company;
    }

    public function getCompany() {
        return $this->company;
    }
}