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

        $content = $this->getContentAsArray($request); // poznvana pomocna klasa definirana ispod
        $uid = array($content->{'uid'});
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Tag_user')->findBy(array('user_tag' => $uid));

        $evidencija = new Evidencija(); // nova Evidencija
        $evidencija->setUserId($product[0]->getuserId()); // postavi usera
        $evidencija->setDate(new \DateTime("now")); //postavi vrijeme
        $evidencija->setTime(new \DateTime("now"));
        $evidencija->setRazlogId(1);
        $evidencija->setUredajId(1);
        //$em = $this->getDoctrine()->getManager(); //dohvati managera
        $em->persist($evidencija); //pripremi za spremanje
        $em->flush(); //spremi

        $content = array("uspjeh" => "da");///$product[0]->getuserId();  // neki dummy podaci
        return $view = $this->view($content, Response::HTTP_OK); //vrati dummy odg..

    }
    protected function getContentAsArray(Request $request){ //pomocna funkcjia za vratit json iz respnsa
        $content = $request->getContent();

        if(empty($content)){
            throw new BadRequestHttpException("Content is empty");
        }

        return json_decode($content);
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

