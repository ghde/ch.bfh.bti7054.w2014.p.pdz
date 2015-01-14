<?php

/**
 * Created by IntelliJ IDEA.
 * User: pfafs1
 * Date: 14.01.2015
 * Time: 20:20
 */
class PlantTx
{
    private $language;

    private $title;

    private $description;

    public function __construct($language, $title, $description)
    {
        $this->language = $language;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}