<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class KontaktController extends Controller
{
<<<<<<< HEAD
<<<<<<< HEAD
    /**
     * @Route("/kontakt", name="kontakt")
     */
    public function indexAction()
    {
        return $this->render('kontakt/kontakt.html.twig', array(
            'webpage_title' => 'Kontekt - RecENT '
=======
   
    public function kontaktAction()
    {
        return $this->render('kontakt/kontakt.html.twig', array(
            'webpage_title' => 'Kontakt - RecENT '
>>>>>>> 42de2340cb8d642fdcc43bea458ef2871aaed8fd
=======
   
    public function kontaktAction()
    {
        return $this->render('kontakt/kontakt.html.twig', array(
            'webpage_title' => 'Kontakt - RecENT '
>>>>>>> masimo
        ));
    }
}
