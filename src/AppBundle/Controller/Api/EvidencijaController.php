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



class EvidencijaController extends FOSRestController
{

    /**
     * @Rest\View
     */

    public function unesipodatkeAction(Request $request) //defaultni za api url
    {
        $user = $this->getUser();
        $evidencija = new Evidencija();
        $evidencija -> setDatum(new \DateTime("now"));
        $evidencija -> setUserId($user->getId());

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($evidencija);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();


        $data = ['Hi' => 'user :) '];
        $view = $this->view($data, Response::HTTP_OK);
        return $view;

    }
}
