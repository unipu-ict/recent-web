<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
<<<<<<< HEAD
<<<<<<< HEAD
    public function homepageAction()
    {
        // replace this example code with whatever you need

        return $this->render('default/index.html.twig', array(
            'webpage_title' => 'RecENT - suvremeni način evidencije radnog vremena'
        ));
=======
    public function indexAction()
    {
        // replace this example code with whatever you need

        return $this->render('Default/index.html.twig');
>>>>>>> 42de2340cb8d642fdcc43bea458ef2871aaed8fd
=======
    public function indexAction()
    {
        // replace this example code with whatever you need

        return $this->render('Default/index.html.twig');
>>>>>>> masimo
    }


    
}
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> 42de2340cb8d642fdcc43bea458ef2871aaed8fd
=======

>>>>>>> masimo
