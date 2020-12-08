<?php

namespace App\Service\Cart;

use App\Controller\Constants;
use App\Entity\Handy;

class CartService
{
    public function getValuesForCart($cartArray, $em)
    {
        $res = array();
        foreach ($cartArray as $item) {
            $res[] = $em->getRepository(Handy::class)->find($item);
        }
        $sum = 0;
        /* @var $item \App\Entity\Handy */
        foreach ($res as $item){
            $sum = $sum + (int) $item->getPrice();
        }
        $mwStSum = $sum * Constants::mwst;
        $fullSum = $mwStSum + $sum;

        return ['handys' => $res, "summe" => $sum, "summeMwSt" => $mwStSum, "gesamtSumme" => $fullSum, "versand" => Constants::standardShipping];
    }
}