<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
/**
 * @ORM\Entity
 * @ORM\Table(name="Orders")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $OrderID;
    /**
     * @ORM\Column(type="datetime")
     */
    private $date;
    /**
     * @ORM\Column(type="string")
     */
    private $sum;
    /**
     * @ORM\Column(type="integer")
     * @OneToOne(targetEntity="Customer")
     * @JoinColumn(name="customerId",referencedColumnName="id")
     **/
    private $customerId;

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->OrderID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID): void
    {
        $this->OrderID = $ID;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * @param mixed $sum
     */
    public function setSum($sum): void
    {
        $this->sum = $sum;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     */
    public function setCustomerId($customerId): void
    {
        $this->customerId = $customerId;
    }

}

