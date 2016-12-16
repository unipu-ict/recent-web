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
use AppBundle\Serializer\Normalizer\UserNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class EvidencijadanaController extends FOSRestController
{
    /**
     * @Rest\View
     */
    public function evidencija_danaAction(Request $request)
    {

//        $datum = (new \DateTime("now")); //postavi vrijeme

        $user = $this->getDoctrine()->getRepository('AppBundle:Evidencija')->findBy(
        	array('userId' => 2)
    	); // pronadij user id


        $result = array(); // result

        foreach ($user as $u) { // spremanje u result
        	$normal =  new UserNormalizer();
        	$u= $normal->normalize($u);
        	array_push($result, $u);
        }


        return $view = $this->view($result, Response::HTTP_OK);


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