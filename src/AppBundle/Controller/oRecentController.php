<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class oRecentController extends Controller
{

    /**
     * @Route("/o-recent", name="orecent")
     */
   
    public function indexAction()
    {
        return $this->render('orecent/orecent.html.twig', array(

            'webpage_title' => 'O RecENT - karakteristike'
        ));
    }
}
