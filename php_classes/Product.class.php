<?php
/**
 * Created by IntelliJ IDEA.
 * User: pfafs1
 * Date: 26.12.2014
 * Time: 15:18
 */
class Product
{
    private $productId;

    private $productTitle;

    private $productDescription;

    private $productPrice;

    private $productType;

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return mixed
     */
    public function getProductTitle()
    {
        return $this->productTitle;
    }

    /**
     * @param mixed $productTitle
     */
    public function setProductTitle($productTitle)
    {
        $this->productTitle = $productTitle;
    }

    /**
     * @return mixed
     */
    public function getProductDescription()
    {
        return $this->productDescription;
    }

    /**
     * @param mixed $productDescription
     */
    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;
    }

    /**
     * @return mixed
     */
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * @param mixed $productPrice
     */
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;
    }

    /**
     * @return mixed
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * @param mixed $productType
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;
    }
}