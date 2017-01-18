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

        $datum = (new \DateTime('now'));

        $odradeno_sati = array();
        foreach ($users as $korisnik){
            $time=0.0;
            $prekovremeni=0.0;
            $neprisutnost=0.0;
            $em = $this->getDoctrine()->getManager();
            $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija_dana u WHERE u.userId = :userid and YEAR(u.datum) = :godina and MONTH(u.datum) = :mjesec')
                ->setParameter('userid', $korisnik->getId())
                ->setParameter('godina', $datum->format('Y'))
                ->setParameter('mjesec', $datum->format('m'));

            $data = $query->getResult();

            foreach($data as $odradeno){
                $time = $time + $odradeno->getDoneBusinessHours();//zbroj odradenih sati
                if($odradeno->getDoneBusinessHours()>8)
                    $prekovremeni = $prekovremeni + $odradeno->getDoneBusinessHours() - 8;
                if($odradeno->getNotWorkingId()->getId()>1)
                    $neprisutnost = $neprisutnost + 8;
            }
            $podaci = array('user' => $korisnik, 'odradeno' => round($time, 2), 'neprisutnost' => $neprisutnost, 'prekovremeni' => round($prekovremeni, 2),
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

        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija_dana u WHERE u.userId = :userid and YEAR(u.datum) = :godina and MONTH(u.datum) = :mjesec')
                ->setParameter('userid', $user->getId())
                ->setParameter('godina', $godina)
                ->setParameter('mjesec', $mjesec);

        $evidencija = $query->getResult();


        $query2=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija u WHERE u.userId = :userid and YEAR(u.date) = :godina and MONTH(u.date) = :mjesec')
            ->setParameter('userid', $user->getId())
            ->setParameter('godina', $godina)
            ->setParameter('mjesec', $mjesec);

        $dolasci = $query2->getResult();

        $god_show = $godina;
        $mj_show = $mjesec;

        $neprisustvo = $this->getDoctrine()->getRepository('AppBundle:Neprisustvo')->findAll();

        $time=0.0;

        foreach($evidencija as $odradeno){
            $time = $time + $odradeno->getDoneBusinessHours();
        }

        $mjeseci = array(); // result

        for ($i = 0; $i <= 12; $i++) {
            $date = date("Y-m-d");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-$i months");
            $mjesec = date("m", $date);
            $godina = date("Y", $date);
            $mjesec_godina = array('user' => $user->getId(),'mjesec' => $mjesec, 'godina' => $godina);
            array_push($mjeseci, $mjesec_godina);
        }

        return $this->render('dashboard/radnik-mj.html.twig', array(
            'evidencija' => $evidencija,
            'dolasci' => $dolasci,
            'user' => $user,
            'sati' => round($time, 2),
            'mjeseci' => $mjeseci,
            'mjesec' => $mj_show,
            'godina' => $god_show,
            'razlog_nedolaska' => $neprisustvo
        ));
    }


    /**
    * @Route("/dashboard/{godina}/{mjesec}", name="dashboard2")
    */
    public function pagination2Action($godina, $mjesec)
    {

        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();


        $god_show = $godina;
        $mj_show = $mjesec;

        $odradeno_sati = array();
        foreach ($users as $korisnik){
            $time=0.0;
            $prekovremeni=0.0;
            $neprisutnost=0.0;
            $em = $this->getDoctrine()->getManager();
            $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija_dana u WHERE u.userId = :userid and YEAR(u.datum) = :godina and MONTH(u.datum) = :mjesec')
                ->setParameter('userid', $korisnik->getId())
                ->setParameter('godina', $godina)
                ->setParameter('mjesec', $mjesec);

            $data = $query->getResult();

            foreach($data as $odradeno){
                $time = $time + $odradeno->getDoneBusinessHours();//zbroj odradenih sati
                if($odradeno->getDoneBusinessHours()>8)
                    $prekovremeni = $prekovremeni + $odradeno->getDoneBusinessHours() - 8;
                if($odradeno->getNotWorkingId()->getId()>1)
                    $neprisutnost = $neprisutnost + 8;
            }
            $podaci = array('user' => $korisnik, 'odradeno' => round($time, 2), 'neprisutnost' => $neprisutnost, 'prekovremeni' => round($prekovremeni, 2),
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
