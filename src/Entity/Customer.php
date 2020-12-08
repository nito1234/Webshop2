<?php
namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use PhpParser\Node\Expr\Array_;

/**
 * @ORM\Entity
 * @ORM\Table(name="Customer")
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     *  @ORM\Column(type="string", length=255)
     */
    private $username;
    /**
     *  @ORM\Column(type="string", length=255)
     */
    private $password;
    /**
     *  @ORM\Column(type="string", length=255)
     */
    private $lastname;
    /**
     *  @ORM\Column(type="string", length=255)
     */
    private $surname;
    /**
     *  @ORM\Column(type="datetime")
     */
    private $registerDate;
    /**
     *  @ORM\Column(type="string", length=255)
     */
    private $city;
    /**
     *  @ORM\Column(type="integer")
     */
    private $postcode;
    /**
     *  @ORM\Column(type="string", length=255)
     */
    private $street;
    /**
     *  @ORM\Column(type="integer")
     */
    private $number;

    /**
     * Customer constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param $customerData
     */
    public function fillCustomer($customerData){
        $this->username = $customerData['Username'];
        $this->password = hash("sha256", $customerData['Passwort']);
        $this->lastname = $customerData['Nachname'];
        $this->surname = $customerData['Vorname'];
        $this->registerDate = new DateTime();
        $this->city = $customerData['Stadt'];
        $this->postcode = $customerData['PLZ'];
        $this->street = $customerData['Strasse'];
        $this->number = $customerData['Hausnummer'];
    }

    /**
     * @param $customerData
     */
    public function updateCustomer($customerData) {
        $this->username = $customerData['Username'];
        $this->lastname = $customerData['Nachname'];
        $this->surname = $customerData['Vorname'];
        $this->city = $customerData['Stadt'];
        $this->postcode = $customerData['PLZ'];
        $this->street = $customerData['Strasse'];
        $this->number = $customerData['Hausnummer'];
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * @param mixed $registerDate
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }
}