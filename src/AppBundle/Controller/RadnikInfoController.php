<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RadnikInfoController extends Controller
{
    /**
     * @Route("/radnik", name="radnik")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need

        return $this->render('info/radnik.html.twig');
    }


    
}

