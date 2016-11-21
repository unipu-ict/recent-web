<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function homepageAction()
    {
        // replace this example code with whatever you need

        return $this->render('default/index.html.twig', array(
            'webpage_title' => 'RecENT - suvremeni način evidencije radnog vremena'
        ));
     }   

    public function indexAction()
    {
        // replace this example code with whatever you need

        return $this->render('default/index.html.twig');
    }
    

    
}

