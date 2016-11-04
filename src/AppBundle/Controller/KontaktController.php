<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class KontaktController extends Controller
{
   
    public function kontaktAction()
    {
        return $this->render('kontakt/kontakt.html.twig', array(
            'webpage_title' => 'Kontakt - RecENT '
        ));
    }
}
