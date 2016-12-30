<?php

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Evidencija;

use AppBundle\Entity\Razlog;
use AppBundle\Entity\Tag_user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Serializer\Normalizer\EvidencijaRazlogNormalizer;
use AppBundle\Serializer\Normalizer\EvidencijaVrijemeNormalizer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Bundle\FrameworkBundle\Validator;
use Symfony\Component\Debug\Exception\FatalThrowableError;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;



class EvidencijaController extends FOSRestController//potrebno ekstendati FOSRestController zbgo $this->getUser()
{
    /**
     * @Rest\View
     */
    public function unesipodatkeAction(Request $request)
    {
        $datum = (new \DateTime("now"));
        $content = $this->getContentAsArray($request); // poznvana pomocna klasa definirana ispod
        $uID = $content->{'uid'};
        $em = $this->getDoctrine()->getManager(); //dohvati managera

        $uid = $this->getDoctrine() ->getRepository('AppBundle:Tag_user')->findOneBy( array('user_tag' => $uID)); // dohvaca red iz Tag_user s uidom

        if (!$uid){ // ako nema rezultata, ako nepostoji korisnik s tim uid-om
            $content = array("uspjeh" => "ne");
        }else{
            $user = $this->getDoctrine() ->getRepository('AppBundle:User') -> find( $uid->getUserId() ); //ako ima rzultata, identificiraj korisnika

            // 5 minuta blokada

            $evidencija_vrijeme = $this->getDoctrine()->getRepository('AppBundle:Evidencija')->findBy(
                array('userId' => $user, 'date' => $datum), array('time' => 'DESC')
            );

            $vrijeme = array(); // result

            foreach ($evidencija_vrijeme as $v) { // spremanje u result
                $normalv =  new EvidencijaVrijemeNormalizer();
                $v= $normalv->normalize($v);
                array_push($vrijeme, $v);
            }

            $zadnje_vrijeme = strtotime($vrijeme[0]->format('H:i:s'));
            $trenutno_vrijeme = strtotime($datum->format('H:i:s'));
            $razlika_vrijeme = ($trenutno_vrijeme - $zadnje_vrijeme) / 60;


            // 5 minuta blokada - kraj



            $evidencija_razlog = $this->getDoctrine()->getRepository('AppBundle:Evidencija')->findBy(
                array('userId' => $user, 'date' => $datum), array('time' => 'DESC')
            ); // pronadji zadni unos usera za danasnji datum, zadnji unos je na prvom mjestu jer je sortirano po zadnjem vremenu


            $result = array(); // result

            foreach ($evidencija_razlog as $u) { // spremanje u result
                $normal =  new EvidencijaRazlogNormalizer();
                $u= $normal->normalize($u);
                array_push($result, $u);
            }
            if(!$result){ //ako nema unosa za danasnji dan, unesi razlog 1
                $razlog = $this->getDoctrine() ->getRepository('AppBundle:Razlog')->find( 1 );
            }elseif($result[0] == 1){ //ako je zadni jedan unesi 2
                $razlog = $this->getDoctrine() ->getRepository('AppBundle:Razlog')->find( 2 );
            }elseif ($result[0] == 2){
                $razlog = $this->getDoctrine() ->getRepository('AppBundle:Razlog')->find( 1 );
            }else{
                $razlog = $this->getDoctrine() ->getRepository('AppBundle:Razlog')->find( 6 );
            }

            if($razlika_vrijeme >= 5){
                $evidencija = new Evidencija(); // nova Evidencija
                $evidencija->setUserId($user); // postavi usera
                $evidencija->setDate(new \DateTime("now")); //postavi vrijeme
                $evidencija->setTime(new \DateTime("now"));
                $evidencija->setRazlogId($razlog);

                $em->persist($evidencija); //pripremi za spremanje
                $em->flush(); //spremi
                $content = array("uspjeh" => "da");
            }else{
                $content = array("uspjeh" => "ne");
            }

        }


        //$content = array("uspjeh" => "da");



        return $view = $this->view($content, Response::HTTP_OK); //vrati dummy odg..

    }




    protected function getContentAsArray(Request $request){ //pomocna funkcjia za vratit json iz respnsa
        $content = $request->getContent();
        if(empty($content)){
            throw new BadRequestHttpException("Content is empty");
        }
        return json_decode($content);
    }

}

