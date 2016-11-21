<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need

        return $this->render('dashboard/zaposlenici-mj.html.twig');
    }

    /**
     * @Route("/dashboard/radnik", name="dashboard-radnik")
     */
    public function workerAction()
    {
        // replace this example code with whatever you need

        return $this->render('dashboard/radnik-mj.html.twig');
    }

    
}

