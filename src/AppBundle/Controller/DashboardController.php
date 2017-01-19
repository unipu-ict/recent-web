<?php

/**
 * Created by PhpStorm.
 * User: Marino Peresa
 * Date: 31.10.2016.
 * Time: 19:28
 */

namespace AppBundle\Controller;


use AppBundle\Serializer\Normalizer\EvidencijadanaNeprisustvoNormailzer;
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

        $god_show = $datum->format("Y");
        $mj_show = $datum->format("m");

        if($mj_show==1){
            $previous_g=$god_show-1;
            $previous_m=12;
            $next_g=$god_show;
            $next_m=$mj_show+1;
        }else if($mj_show==12){
            $previous_g=$god_show;
            $previous_m=$mj_show-1;
            $next_g=$god_show+1;
            $next_m=1;
        }else{
            $previous_g=$god_show;
            $previous_m=$mj_show-1;
            $next_g=$god_show;
            $next_m=$mj_show+1;
        }

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
            'godina' => $datum->format("Y"),
            'previous_g' =>$previous_g,
            'previous_m' =>$previous_m,
            'next_g' => $next_g,
            'next_m' => $next_m,

        ));
    }

    /**
     * @Route("/dashboard/radnik/neprisustvo/{evidencija_dana}/{idrazlog}", name="dashboardupdateneprisustvo")
     *
     */
    public function updateNeprisustvoAction($evidencija_dana, $idrazlog)
    {
        $em = $this->getDoctrine()->getManager();
        $ev_dan = $em->getRepository('AppBundle:Evidencija_dana')->find($evidencija_dana);
        $neprisustvo = $em->getRepository('AppBundle:Neprisustvo')->find($idrazlog);

        if (!$ev_dan) {
            throw $this->createNotFoundException(
                'No product found for id '.$evidencija_dana
            );
        }

        $ev_dan->setNotWorkingId($neprisustvo );
        $em->flush();

        return new Response("123");
    }


    /**
     * @Route("/dashboard/radnik/{user_id}/{godina}/{mjesec}", name="dashboard1" , requirements={ "user_id": "\d+"  })
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

        $stanje = array(); // result
        foreach ($evidencija as $u) { // spremanje u result
            $normal =  new EvidencijadanaNeprisustvoNormailzer();
            $u= $normal->normalize($u);
            array_push($stanje, $u);
        }
//        exit(dump($this->container,$stanje));
        $query2=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija u WHERE u.userId = :userid and YEAR(u.date) = :godina and MONTH(u.date) = :mjesec')
            ->setParameter('userid', $user->getId())
            ->setParameter('godina', $godina)
            ->setParameter('mjesec', $mjesec);

        $dolasci = $query2->getResult();

        $god_show = $godina;
        $mj_show = $mjesec;


        if($mj_show==1){
            $previous_g=$god_show-1;
            $previous_m=12;
            $next_g=$god_show;
            $next_m=$mj_show+1;
        }else if($mj_show==12){
            $previous_g=$god_show;
            $previous_m=$mj_show-1;
            $next_g=$god_show+1;
            $next_m=1;
        }else{
            $previous_g=$god_show;
            $previous_m=$mj_show-1;
            $next_g=$god_show;
            $next_m=$mj_show+1;
        }


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



//        $promjeni = $_POST['change_nedolazak'];
//        $ev_dan_not_here->setNotWorkingId($promjeni);
//        $em->persist($ev_dan_not_here);
//        $em->flush();

        return $this->render('dashboard/radnik-mj.html.twig', array(
            'evidencija' => $evidencija,
            'dolasci' => $dolasci,
            'user' => $user,
            'sati' => round($time, 2),
            'mjeseci' => $mjeseci,
            'mjesec' => $mj_show,
            'godina' => $god_show,
            'previous_g' =>$previous_g,
            'previous_m' =>$previous_m,
            'next_g' => $next_g,
            'next_m' => $next_m,
            'razlog_nedolaska' => $neprisustvo
        ));
    }


    /**
    * @Route("/dashboard/{godina}/{mjesec}", name="dashboard2", requirements={ "godina": "\d+" , "mjesec" : "\d+"  } )
    */
    public function pagination2Action($godina, $mjesec)
    {

        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();


        $god_show = $godina;
        $mj_show = $mjesec;

        if($mj_show==1){
            $previous_g=$god_show-1;
            $previous_m=12;
            $next_g=$god_show;
            $next_m=$mj_show+1;
        }else if($mj_show==12){
            $previous_g=$god_show;
            $previous_m=$mj_show-1;
            $next_g=$god_show+1;
            $next_m=1;
        }else{
            $previous_g=$god_show;
            $previous_m=$mj_show-1;
            $next_g=$god_show;
            $next_m=$mj_show+1;
        }

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
            'godina' => $god_show,
            'previous_g' =>$previous_g,
            'previous_m' =>$previous_m,
            'next_g' => $next_g,
            'next_m' => $next_m,

        ));
    }
}
