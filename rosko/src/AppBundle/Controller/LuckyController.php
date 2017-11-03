<?php

// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LuckyController extends Controller
{
    /**
    * @Route("/lucky/number")
    */
    public function numberAction()
    {
        $number = rand(0, 100);
        
        return new Response(
        '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
    
    /**
    * @Route("/api/lucky/number")
    */
    public function apiNumberAction()
    {
        $data = array(
            'lucky_number' => rand(0, 100),
            );

        return new JsonResponse($data);
    }
    
    /**
    * @Route("/lucky/number/{count}")
    */
    public function number1Action($count)
    {
        $numbers = array();
        
        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }
        
        $numbersList = implode(', ', $numbers);
        
        return new Response(
            '<html><body>Lucky numbers: '.$numbersList.'</body></html>'
        )   ;
    }
    
    /**
    * @Route("/home/{count}")
    */
    public function getHome($count){
        
        $numbers = array();
        
        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }
        
        $numbersList = implode(', ', $numbers);
        
        return $this->render(
            'lucky/number.html.twig',
            array('luckyNumberList' => $numbersList)
            );
    }
}

?>