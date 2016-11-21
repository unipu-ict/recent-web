<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class oRecentController extends Controller
{
<<<<<<< HEAD
    /**
     * @Route("/o-recent", name="orecent")
     */
    public function indexAction()
    {
        return $this->render('o-recent/o-recent.html.twig', array(
=======
   
    public function orecentAction()
    {
        return $this->render('orecent/orecent.html.twig', array(
>>>>>>> 42de2340cb8d642fdcc43bea458ef2871aaed8fd
            'webpage_title' => 'O RecENT - karakteristike'
        ));
    }
}
