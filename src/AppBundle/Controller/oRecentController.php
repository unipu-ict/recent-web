<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class oRecentController extends Controller
{
   
    public function orecentAction()
    {
        return $this->render('orecent/orecent.html.twig', array(
            'webpage_title' => 'O RecENT - karakteristike'
        ));
    }
}
