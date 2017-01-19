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
use Symfony\Component\HttpFoundation\Request;


class ReportsController extends Controller
{
    /**
     * @Route("/reports", name="reports")
     */


    public function indexAction()
    {

        $mjeseci = array(); // result

        for ($i = 0; $i < 12; $i++) {
            $date = date("Y-m-d");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-$i months");
            $mjesec = date("m",$date);
            array_push($mjeseci, $mjesec);
        }

        $godine = array(); // result

        for ($i = 0; $i < 3; $i++) {
            $date = date("Y-m-d");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-$i years");
            $godina = date("Y", $date);
            array_push($godine, $godina);
        }

        $users = $this->getDoctrine() ->getRepository('AppBundle:User') -> findAll();

            return $this->render('reports/reports.twig', array(
                'mjeseci' => $mjeseci,
                'godine' => $godine,
                'users' => $users
            ));

    }

    /**
     * @Route("/reports/po_radniku", name="reports1")
     *
     */

    public function poradnikuAction()
    {
        $mjeseci = array(); // result

        for ($i = 0; $i < 12; $i++) {
            $date = date("Y-m-d");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-$i months");
            $mjesec = date("m",$date);
            array_push($mjeseci, $mjesec);
        }

        $godine = array(); // result

        for ($i = 0; $i < 3; $i++) {
            $date = date("Y-m-d");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-$i years");
            $godina = date("Y", $date);
            array_push($godine, $godina);
        }

        $users = $this->getDoctrine() ->getRepository('AppBundle:User') -> findAll();

            return $this->render('reports/po_radniku.twig', array(
                'mjeseci' => $mjeseci,
                'godine' => $godine,
                'users' => $users
            ));

    }

    /**
     * @Route("/reports/po_danu", name="reports2")
     *
     */

    public function podanuAction()
    {
        return $this->render('reports/po_danu.twig');
    }

    /**
     * @Route("/reports/po_radniku/detaljno", name="reports1-2")
     *
     */

    public function workerbyidAction(Request $request)
    {

        $mjeseci = array(); // result

        for ($i = 0; $i < 12; $i++) {
            $date = date("Y-m-d");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-$i months");
            $mjesec = date("m",$date);
            array_push($mjeseci, $mjesec);
        }

        $godine = array(); // result

        for ($i = 0; $i < 3; $i++) {
            $date = date("Y-m-d");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-$i years");
            $godina = date("Y", $date);
            array_push($godine, $godina);
        }

        $users = $this->getDoctrine() ->getRepository('AppBundle:User') -> findAll();

        $user_id = $_POST['k'];
        $godina = $_POST['g'];
        $mjesec = $_POST['m'];

        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')->find($user_id);

        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija_dana u WHERE u.userId = :userid and YEAR(u.datum) = :godina and MONTH(u.datum) = :mjesec')
            ->setParameter('userid', $user)->setParameter('godina', $godina)->setParameter('mjesec', $mjesec);
        $evidencija = $query->getResult();


        $time=0;

        foreach($evidencija as $odradeno){
            $time = $time + $odradeno->getDoneBusinessHours();
        }


        return $this->render('reports/po_radniku-detaljno.twig', array(
            'evidencija' => $evidencija,
            'user' => $user,
            'sati' => $time,
            'godina' => $godina,
            'mjesec' => $mjesec,
            'mjeseci' => $mjeseci,
            'godine' => $godine,
            'users' => $users
        ));
    }

    /**
     * @Route("/reports/po_danu/detaljno", name="reports2-2")
     *
     */

    public function daybyidAction(Request $request)
    {

        $users = $this->getDoctrine() ->getRepository('AppBundle:User') -> findAll();
        $datum = $_POST['datum'];
        $d = (new \DateTime("$datum"));

        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u, n FROM AppBundle:Evidencija_dana u JOIN u.userId n WHERE u.datum = :datum')
            ->setParameter('datum', $d);
        $evidencija_dana = $query->getResult();

        $time=0;

        foreach($evidencija_dana as $odradeno){
            $time = $time + $odradeno->getDoneBusinessHours();
        }

        return $this->render('reports/po_danu-detaljno.twig', array(
            'evidencija' => $evidencija_dana,
            'datum' => $d,
            'sati' => $time,
            'users' => $users
        ));
    }




}
