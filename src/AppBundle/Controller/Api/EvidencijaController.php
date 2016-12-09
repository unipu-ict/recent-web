<?php

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Evidencija;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Bundle\FrameworkBundle\Validator;





class EvidencijaController extends FOSRestController //potrebno ekstendati FOSRestController zbgo $this->getUser()
{
    /**
     * @Rest\View
     */
    public function unesipodatkeAction(Request $request)
    {
        // $content = $this->getContentAsArray($request); 
        $user = $this->getUser(); //dobiva usera
        $evidencija = new Evidencija(); // nova Evidencija
        $evidencija->setUserId($user->getId()); // postavi usera
        $evidencija->setDate(new \DateTime("now")); //postavi vrijeme
        $evidencija->setTime(new \DateTime("now"));
        $evidencija->setRazlogId(1);
        $evidencija->setUredajId(1);

        $em = $this->getDoctrine()->getManager(); //dohvati managera
        $em->persist($evidencija); //pripremi za spremanje
        $em->flush(); //spremi

        $content = array("uspjeh" => "da"); /// neki dummy podaci
        return $view = $this->view($content, Response::HTTP_OK); //vrati dummy odg..

    }



/*
    protected function getContentAsArray(Request $request){ //pomocna funkcjia za vratit json iz respnsa
        $content = $request->getContent();

        if(empty($content)){
            throw new BadRequestHttpException("Content is empty");
        }

        return json_decode($content);
    }
*/

}

