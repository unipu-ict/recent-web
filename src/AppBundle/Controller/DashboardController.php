<?php

/**
 * Created by PhpStorm.
 * User: Marino Peresa
 * Date: 31.10.2016.
 * Time: 19:28
 */

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
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();


        return $this->render('dashboard/zaposlenici-mj.html.twig', array(
            'webpage_title' => 'Evidencija zaposlenika ',
            'users' => $users
        ));
    }

    /**
     * @Route("/dashboard/radnik", name="dashboard1")
     *
     */

    public function workerAction()
    {
        // replace this example code with whatever you need

        return $this->render('dashboard/radnik-mj.html.twig');
    }


}
