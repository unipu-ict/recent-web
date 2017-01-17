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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;

use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

        $datum = (new \DateTime('now'));

        $odradeno_sati = array();
        foreach ($users as $korisnik){
            $time=0.0;
            $prekovremeni=0.0;
            $em = $this->getDoctrine()->getManager();
            $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija_dana u WHERE u.userId = :userid and YEAR(u.datum) = :godina and MONTH(u.datum) = :mjesec')
                ->setParameter('userid', $korisnik->getId())
                ->setParameter('godina', $datum->format('Y'))
                ->setParameter('mjesec', $datum->format('m'));

            $data = $query->getResult();

            foreach($data as $odradeno){
                $time = $time + $odradeno->getDoneBusinessHours();//zbroj odradenih sati
                if($odradeno->getDoneBusinessHours()>7)
                    $prekovremeni = $prekovremeni + $odradeno->getDoneBusinessHours() - 7;
            }
            $podaci = array('user' => $korisnik, 'odradeno' => $time, 'prekovremeni' => $prekovremeni,
                'mjesec' => $datum->format("m"),
                'godina' => $datum->format("Y"));
            array_push($odradeno_sati, $podaci);
        }


        $mjeseci = array(); // result

        for ($i = 0; $i <= 12; $i++) {
            $date = date("Y-m-d");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-$i months");
            $mjesec = date("m", $date);
            $godina = date("Y", $date);
            $mjesec_godina = array('mjesec' => $mjesec, 'godina' => $godina);
            array_push($mjeseci, $mjesec_godina);
        }

        return $this->render('dashboard/zaposlenici-mj.html.twig', array(
            'webpage_title' => 'Evidencija zaposlenika ',
            'odradeno' => $odradeno_sati, //odrađeno radno vrijeme
            'mjeseci' => $mjeseci,
            'mjesec' => $datum->format("m"),
            'godina' => $datum->format("Y")

        ));
    }

    /**
     * @Route("/dashboard/radnik/{user_id}/{godina}/{mjesec}", name="dashboard1")
     *
     */

    public function workerbyidAction($user_id, $godina, $mjesec)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id'=>$user_id));


        //$evidencija = $this->getDoctrine()+            ->getRepository('AppBundle:Evidencija_dana')->findBy(array('userId' => $user->getId()));
//        $evidencija = $this->getDoctrine()
//            ->getRepository('AppBundle:Evidencija_dana')->findBy(array('userId' => $user_id, 'datum' => $godina$mjesec));

        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija_dana u WHERE u.userId = :userid and YEAR(u.datum) = :godina and MONTH(u.datum) = :mjesec')
                ->setParameter('userid', $user->getId())
                ->setParameter('godina', $godina)
                ->setParameter('mjesec', $mjesec);

        $data = $query->getResult();

        $time=0.0;

        foreach($data as $odradeno){
            $time = $time + $odradeno->getDoneBusinessHours();
        }


        return $this->render('dashboard/radnik-mj.html.twig', array(
            'evidencija' => $data,
            'user' => $user,
            'sati' => $time
        ));
    }


    /**
    * @Route("/dashboard/{godina}/{mjesec}", name="dashboard2")
    */
    public function pagination2Action($godina, $mjesec)
    {

        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        $evidencija = $this->getDoctrine()
            ->getRepository('AppBundle:Evidencija_dana')->findAll();

        $datum = (new \DateTime('now'));

        $god_show = $godina;
        $mj_show = $mjesec;

        $odradeno_sati = array();
        foreach ($users as $korisnik){
            $time=0.0;
            $prekovremeni=0.0;
            $em = $this->getDoctrine()->getManager();
            $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija_dana u WHERE u.userId = :userid and YEAR(u.datum) = :godina and MONTH(u.datum) = :mjesec')
                ->setParameter('userid', $korisnik->getId())
                ->setParameter('godina', $godina)
                ->setParameter('mjesec', $mjesec);

            $data = $query->getResult();

            foreach($data as $odradeno){
                $time = $time + $odradeno->getDoneBusinessHours();//zbroj odradenih sati
                if($odradeno->getDoneBusinessHours()>7)
                    $prekovremeni = $prekovremeni + $odradeno->getDoneBusinessHours() - 7;
            }
            $podaci = array('user' => $korisnik, 'odradeno' => $time, 'prekovremeni' => $prekovremeni,
                'mjesec' => $mj_show,
                'godina' => $god_show);
            array_push($odradeno_sati, $podaci);
        }


        $mjeseci = array(); // result

        for ($i = 0; $i <= 12; $i++) {
            $date = date("Y-m-d");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-$i months");
            $mjesec = date("m", $date);
            $godina = date("Y", $date);
            $mjesec_godina = array('mjesec' => $mjesec, 'godina' => $godina);
            array_push($mjeseci, $mjesec_godina);
        }

            return $this->render('dashboard/zaposlenici-mj.html.twig', array(
                'webpage_title' => 'Evidencija zaposlenika ',
                'odradeno' => $odradeno_sati, //odrađeno radno vrijeme
                'mjeseci' => $mjeseci,
                'mjesec' => $mj_show,
                'godina' => $god_show

            ));
    }








   


}
