<?php
/**
 * Created by PhpStorm.
 * User: Marino
 * Date: 14.12.2016.
 * Time: 12:17
 */

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Evidencija;
use AppBundle\Entity\Evidencija_dana;
use AppBundle\Entity\Razlog;
use AppBundle\Entity\Tag_user;
use AppBundle\Serializer\Normalizer\Mobitel1Normalizer;
use AppBundle\Serializer\Normalizer\Mobitel2Normalizer;
use AppBundle\Serializer\Normalizer\UserNormalizer;
use AppBundle\Serializer\Normalizer\EvidencijadanaUserNormalizer;
use AppBundle\Serializer\Normalizer\EvidencijaVrijemeNormalizer;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


use Symfony\Bundle\FrameworkBundle\Validator;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use AppBundle\Controller\ScanGetController;

class MobitelController extends FOSRestController
{
    /**
     * @Rest\View
     */
    public function mjeseciAction($user_id)
    {

        $user = $this->getDoctrine() ->getRepository('AppBundle:User') -> find($user_id);
        $mjeseci = array(); // result
        $b = 0;
        for ($i = 0; $i <= 6; $i++) {
            $date = date("Y-m-d");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-$i months");
            $mjesec = date("m",$date);
            $godina = date("Y", $date);
            $mjesec_godina = array('mjesec' => $mjesec, 'godina' => $godina, "id" => ++$b);
            array_push($mjeseci, $mjesec_godina);
        }
        $odradeno_sati = array();
        foreach ($mjeseci as $mjesec){
            $time=0.0;

            $em = $this->getDoctrine()->getManager();
            $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija_dana u WHERE u.userId = :userid and YEAR(u.datum) = :godina and MONTH(u.datum) = :mjesec')
                ->setParameter('userid', $user->getId())
                ->setParameter('godina', $mjesec["godina"])
                ->setParameter('mjesec', $mjesec["mjesec"]);

            $data = $query->getResult();

            foreach($data as $odradeno){
                $time = $time + $odradeno->getDoneBusinessHours();//zbroj odradenih sati
            }
//            $mjes = $mjesec["mjesec"];
//            $mjes = strtotime(date("m", strtotime($mjes)));
//            $mjes = date("F",$mjes);
            $podaci = array('id' => $mjesec["id"], 'month' => $mjesec["mjesec"], 'year' => $mjesec["godina"], 'total' => round($time, 1));
            array_push($odradeno_sati, $podaci);
        }

        return $view = $this->view($odradeno_sati, Response::HTTP_OK);

    }


    protected function getContentAsArray($id){ //pomocna funkcjia za vratit json iz respnsa
        $content = $id->getContent();
        if(empty($content)){
            throw new BadRequestHttpException("Content is empty");
        }
        return json_decode($content);
    }

    /**
     * @Rest\View
     */
    public function getAction($user_id, $godina, $mjesec)
    {

        $user = $this->getDoctrine() ->getRepository('AppBundle:User') -> find($user_id);

        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija_dana u WHERE u.userId = :userid and YEAR(u.datum) = :godina and MONTH(u.datum) = :mjesec ORDER BY u.id DESC')
            ->setParameter('userid', $user->getId())
            ->setParameter('godina', $godina)
            ->setParameter('mjesec', $mjesec);

        $evidencija = $query->getResult();

        $podaci = array();
        foreach($evidencija as $dan){
            $normal1 =  new Mobitel1Normalizer();
            $dan= $normal1->normalize($dan);
            array_push($podaci, $dan);
        }


        return $view = $this->view($podaci, Response::HTTP_OK);
    }

    /**
     * @Rest\View
     */
    public function evidenAction($user_id, $godina, $mjesec, $dan)
    {

        $user = $this->getDoctrine() ->getRepository('AppBundle:User') -> find($user_id);

        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija u WHERE u.userId = :userid and YEAR(u.date) = :godina and MONTH(u.date) = :mjesec AND DAY(u.date) = :dan')
            ->setParameter('userid', $user->getId())
            ->setParameter('godina', $godina)
            ->setParameter('mjesec', $mjesec)
            ->setParameter('dan', $dan);

        $evidencija = $query->getResult();
        $podaci = array();
        foreach ($evidencija as $item){
            $normal1 =  new Mobitel2Normalizer();
            $item= $normal1->normalize($item);
            array_push($podaci, $item);
        }

        $mjesec_godina = $dan . "." . $mjesec;

        $data = array('date' => $mjesec_godina, 'records' => $podaci);


        return $view = $this->view($data, Response::HTTP_OK);
    }

}