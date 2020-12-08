<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use App\Entity\Order;
/**
 * @ORM\Entity
 * @ORM\Table(name="OrderHandy")
 */
class OrderHandy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $entryID;
    /**
     * @ORM\Column(type="integer")
     * @OneToOne(targetEntity="Order")
     * @JoinColumn(name="orderiD",referencedColumnName="id")
     **/
    private $orderID;
    /**
     * @ORM\Column(type="integer")
     * @OneToOne(targetEntity="Handy")
     * @JoinColumn(name="Handy",referencedColumnName="id")
     **/
    private $Handy;

    /**
     * @return mixed
     */
    public function getOrderID()
    {
        return $this->orderID;
    }

    /**
     * @param mixed $orderID
     */
    public function setOrderID($orderID): void
    {
        $this->orderID = $orderID;
    }

    /**
     * @return mixed
     */
    public function getHandyID()
    {
        return $this->Handy;
    }

    /**
     * @param mixed $handyID
     */
    public function setHandyID($handyID): void
    {
        $this->Handy = $handyID;
    }


}