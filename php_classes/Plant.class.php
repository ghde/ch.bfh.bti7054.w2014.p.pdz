<?php

/**
 * Created by IntelliJ IDEA.
 * User: decla
 * Date: 30.11.2014
 * Time: 21:06
 */
class Plant
{

    private $id;

    private $name;

    private $picture;

    private $description;

    public function __construct($id, $name, $picture, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->picture = $picture;
        $this->description = $description;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPicture() {
        return $this->picture;
    }

}