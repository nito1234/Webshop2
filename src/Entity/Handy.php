<?php
namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="handy")
 */
class Handy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $iD;
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\Column(type="string")

     */
    private $brand;
    /**
     * @ORM\Column(type="string")
     */
    private $model;
    /**
     * @ORM\Column(type="integer")
     */
    private $ram;
    /**
     * @ORM\Column(type="string")
     */
    private $price;
    /**
     * @ORM\Column(type="integer")
     */
    private $memory;
    /**
     * @ORM\Column(type="string")
     */
    private $color;
    /**
     * @ORM\Column(type="boolean")
     */
    private $available;
    /**
     * @ORM\Column(type="datetime")
     */
    private $releaseDate;
    /**
     * @ORM\Column(type="string")
     */
    private $image;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Handy constructor.
     * @param $name
     * @param $brand
     * @param $price
     * @param $memory
     * @param $color
     * @param $available
     * @param $image
     * @param $ram
     */
    public function __construct($name, $brand, $price, $memory, $color, $available, $image, $ram)
    {
        $this->name = $name;
        $this->brand = $brand;
        $this->price = $price;
        $this->memory = $memory;
        $this->color = $color;
        $this->available = $available;
        $this->image = $image;
        $this->ram = $ram;
    }


    /**
     * @return integer
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * @param integer $iD
     */
    public function setID($iD)
    {
        $this->iD = $iD;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return integer
     */
    public function getRam()
    {
        return $this->ram;
    }

    /**
     * @param integer $ram
     */
    public function setRam($ram)
    {
        $this->ram = $ram;
    }

    /**
     * @return String
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param String $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return integer
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @param integer $memory
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return boolean
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @param boolean $available
     */
    public function setAvailable($available)
    {
        $this->available = $available;
    }

    /**
     * @return DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param DateTime $releaseDate
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

}