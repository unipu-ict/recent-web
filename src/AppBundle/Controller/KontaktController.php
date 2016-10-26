<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class KontaktController extends Controller
{
    /**
     * @Route("/kontakt", name="kontakt")
     */
    public function indexAction()
    {
        return $this->render('kontakt/kontakt.html.twig', array(
            'webpage_title' => 'Kontekt - RecENT '
        ));
    }
}
