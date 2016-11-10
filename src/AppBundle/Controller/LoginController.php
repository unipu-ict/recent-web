<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function indexAction()
    {
        return $this->render('login/login-form.html.twig', array(
            'webpage_title' => 'Prijava u RecENT'
        ));
    }
}
