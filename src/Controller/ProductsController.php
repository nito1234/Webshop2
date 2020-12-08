<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Handy;

class ProductsController extends AbstractController
{
    public function productsAction(Request $request){
        $em = $this->getDoctrine()->getManager("handy");
        $res = $em->getRepository(Handy::class)->findAll();
        $response = $this->render('overview.twig',
            ['handys' => $res]);
        return $response;
    }

    public function productDetailsAction($id) {

        $em = $this->getDoctrine()->getManager("handy");
        $res = $em->getRepository(Handy::class)->findOneBy(['iD' => $id]);
        $response = $this->render('productDetails.twig',
            ['handy' => $res]);

        return $response;
    }

    function fillDB($em){
        $response = $this->get_web_page("https://angular-api.handyvertrag.check24.de/ajax/hardwarewall/handy?5g=all&data_included=4000&network_o2=yes&network_tmobile=yes&network_vodafone=yes");
        $resArr = json_decode($response);
        $result = array();
        foreach ($resArr as $res){
            $handy = new Handy( $res->hardware->name,
                $res->hardware->attributes->provider,
                $res->tariff->cheapest->tariffPrices->hardware->amount/100,
                $res->hardware->attributes->memorysize,
                $res->hardware->attributes->color,true,
                $res->hardware->images->front->big,
                $res->hardware->id);
            $result[] = $handy;
        }
        return $result;

    }
    function get_web_page($url) {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);

        $content  = curl_exec($ch);

        curl_close($ch);

        return $content;
    }
}