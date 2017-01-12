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


class ReportsController extends Controller
{
    /**
     * @Route("/reports", name="reports")
     */


    public function indexAction()
    {

        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('reports/reports.twig', array(
            'webpage_title' => 'Evidencija zaposlenika ',
            'users' => $users

        ));
    }

    /**
     * @Route("/reports/po_radniku", name="reports1")
     *
     */

    public function poradnikuAction()
    {
//        if(!$request){
//            $god = $request->request->get('g');
//            $mj = $request->request->get('m');
//            $u = $request->request->get('k');
//
//            poradnikudetaljnoAction($god, $mj, $u);
//        }else{
            $em = $this->getDoctrine()->getManager();
            $query=$em->createQuery( 'SELECT u.done_business_hours, u.datum, u.vrijeme_dolaska, u.vrijeme_odlaska FROM AppBundle\Entity\Evidencija_dana u');
            $data = $query->getResult();
            return $this->render('reports/po_radniku.twig', array(
                'evidencija' => $data
            ));
//        }

    }

//    public function poradnikudetaljnoAction($user_id, $godina, $mjesec){
//
//        $user = $this->getDoctrine()
//            ->getRepository('AppBundle:User')->find($user_id);
//
//        $em = $this->getDoctrine()->getManager();
//        $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija_dana u WHERE u.userId = :userid and YEAR(u.datum) = :godina and MONTH(u.datum) = :mjesec')
//            ->setParameter('userid', $user)->setParameter('godina', $godina)->setParameter('mjesec', $mjesec);
//        $evidencija = $query->getResult();
//
//
//        $time=0;
//
//        foreach($evidencija as $odradeno){
//            $time = $time + $odradeno->getDoneBusinessHours();
//        }
//
//
//        return $this->render('reports/po_radniku-detaljno.twig', array(
//            'evidencija' => $evidencija,
//            'user' => $user,
//            'sati' => $time,
//            'godina' => $godina,
//            'mjesec' => $mjesec
//        ));
//    }

    /**
     * @Route("/reports/po_danu", name="reports2")
     *
     */

    public function podanuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u.done_business_hours, u.datum, u.vrijeme_dolaska, u.vrijeme_odlaska FROM AppBundle\Entity\Evidencija_dana u');
        $data = $query->getResult();
        return $this->render('reports/po_danu.twig', array(
            'evidencija' => $data,
        ));
    }

//    /**
//     * @Route("/reports/po_radniku/?godina={godina}&mjesec={mjesec}&user={user_id}", name="reports1-2")
//     *
//     */
//
//    public function workerbyidAction($godina, $mjesec, $user_id)
//    {
////        $userManager = $this->get('fos_user.user_manager');
////        $user = $userManager->findUserBy(array('id'=>$user_id));
//
//        $user = $this->getDoctrine()
//            ->getRepository('AppBundle:User')->find($user_id);
//
//        $em = $this->getDoctrine()->getManager();
//        $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija_dana u WHERE u.userId = :userid and YEAR(u.datum) = :godina and MONTH(u.datum) = :mjesec')
//            ->setParameter('userid', $user)->setParameter('godina', $godina)->setParameter('mjesec', $mjesec);
//        $evidencija = $query->getResult();
//
//
//        $time=0;
//
//        foreach($evidencija as $odradeno){
//            $time = $time + $odradeno->getDoneBusinessHours();
//        }
//
//
//        return $this->render('reports/po_radniku-detaljno.twig', array(
//            'evidencija' => $evidencija,
//            'user' => $user,
//            'sati' => $time,
//            'godina' => $godina,
//            'mjesec' => $mjesec
//        ));
//    }




}
