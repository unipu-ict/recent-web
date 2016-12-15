<?php
/**
 * Created by PhpStorm.
 * User: Marino
 * Date: 14.12.2016.
 * Time: 12:17
 */

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Evidencija;
use AppBundle\Entity\Razlog;
use AppBundle\Entity\Tag_user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class EvidencijadanaController extends FOSRestController
{
    /**
     * @Rest\View
     */
    public function evidencija_danaAction()
    {

//        $datum = (new \DateTime("now")); //postavi vrijeme

        $user = $this->getDoctrine()->getRepository('AppBundle:Evidencija_dana')->findAll();

//        exit(dump($this->container,$user);

//        if(!$evidencija) {
//            $content = array("uspjeh" => "ne"); /// neki dummy podaci//vrati dummy odg..
//        } else{
//            $content = array("uspjeh" => "da"); /// neki dummy podaci
//        }


        return $view = $this->view($user, Response::HTTP_OK);


    }

//    public function insertEvAction(){
//        $em = $this->getDoctrine()->getManager(); //dohvati managera
//        $em->persist($evidencija_dana); //pripremi za spremanje
//        $em->flush(); //spremi
//    }
//    public function updateEvAction(){
//
//    }
//    public function izracunajEvAction($evidencija){
//
//    }


}