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


        $evidencija = $this->getDoctrine()
        ->getRepository('AppBundle:Evidencija_dana')->findAll();



        $time=0;

        foreach($evidencija as $odradeno){
            $time = $time + $odradeno->getDoneBusinessHours();
        }






        return $this->render('dashboard/zaposlenici-mj.html.twig', array(
            'webpage_title' => 'Evidencija zaposlenika ',
            'users' => $users,
            'time' => $time

        ));
    }

    /**
     * @Route("/dashboard/radnik", name="dashboard1")
     *
     */

    public function workerAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u.done_business_hours, u.datum, u.vrijeme_dolaska, u.vrijeme_odlaska FROM AppBundle\Entity\Evidencija_dana u');
        $data = $query->getResult();
        return $this->render('dashboard/radnik-mj.html.twig', array(
            'evidencija' => $data,
        ));
    }

    /**
     * @Route("/dashboard/radnik/{user_id}", name="dashboard1")
     *
     */

    public function workerbyidAction($user_id)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id'=>$user_id));


        //$evidencija = $this->getDoctrine()+            ->getRepository('AppBundle:Evidencija_dana')->findBy(array('userId' => $user->getId()));
        $evidencija = $this->getDoctrine()
            ->getRepository('AppBundle:Evidencija_dana')->findBy(array('userId' => $user_id));


        $time=0;

        foreach($evidencija as $odradeno){
            $time = $time + $odradeno->getDoneBusinessHours();
        }


        return $this->render('dashboard/radnik-mj.html.twig', array(
            'evidencija' => $evidencija,
            'user' => $user,
            'sati' => $time
        ));
    }


}
