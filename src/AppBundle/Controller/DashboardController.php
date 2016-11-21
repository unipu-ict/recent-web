<?php
<<<<<<< HEAD
/**
 * Created by PhpStorm.
 * User: Marino Peresa
 * Date: 31.10.2016.
 * Time: 19:28
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

=======

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


>>>>>>> masimo
class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
<<<<<<< HEAD

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
=======
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

>>>>>>> masimo
