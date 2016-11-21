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


        return $this->render('dashboard/dashboard.html.twig', array(
            'webpage_title' => 'Evidencija zaposlenika ',
            'users' => $users
        ));
    }

    /**
     * @Route("/dashboard/profile", name="dashboard1")
     *
     */

    public function profileAction()
    {
        $conn = $this->get('database_connection');
        $users = $conn->fetchAll('SELECT * FROM user WHERE User_id=5');


        return $this->render('dashboard/dashboard.html.twig', array(
            'webpage_title' => 'Evidencija zaposlenika ',
            'users' => $users

        ));
    }

}