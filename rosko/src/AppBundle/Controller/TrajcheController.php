<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TrajcheController extends Controller{
    
    /**
    * @Route("/trajche/{count}")
    */
    public function trajcheAction($count, Request $request){
        if ($count == 'nik'){
            $page = $request->query->get('page');
            return new Response("Welcome ".$page);
        }else{
            return new Response("Hello ".$count);
        }
    }
}

?>