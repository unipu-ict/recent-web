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
use AppBundle\Serializer\Normalizer\UserNormalizer;
use AppBundle\Serializer\Normalizer\EvidencijadanaUserNormalizer;
use AppBundle\Serializer\Normalizer\EvidencijaVrijemeNormalizer;

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
        //ovaj dio koda kreira nove redke u evidenciji dana za trenutni datum za svakog korisnika
        //ako već postoji taj datum(danasni, nece ponovo kreirati)
        $em = $this->getDoctrine()->getManager(); //dohvati managera
        $datum = (new \DateTime("now")); //postavi vrijeme

        //$evidencija_dana = $this->getDoctrine()->getRepository('AppBundle:Evidencija_dana')->findAll(); // pronadij user id
        $user = $this->getDoctrine() ->getRepository('AppBundle:User') -> findAll();
        $ev_dana_datum = $this->getDoctrine() ->getRepository('AppBundle:Evidencija_dana') -> findBy(
            array('datum' => $datum), array('datum' => 'ASC'));

        if($ev_dana_datum){
            $poruka = array("stanje" => "postoji");
        }else{
            $result1 = array(); // result

            foreach ($user as $uv) { // spremanje u result
                $normal1 =  new EvidencijadanaUserNormalizer();
                $uv= $normal1->normalize($uv);
                array_push($result1, $uv);
                $evidencija_dana = new Evidencija_dana(); // nova Evidencija_dana
                $evidencija_dana->setUserId($uv); // postavi usera
                $evidencija_dana->setDatum(new \DateTime("now")); //postavi vrijeme
                $evidencija_dana->setVrijemeDolaska(new \DateTime("now"));
                $evidencija_dana->setVrijemeOdlaska(new \DateTime("now"));
                $evidencija_dana->setDoneBusinessHours(0);

                $em->persist($evidencija_dana); //pripremi za spremanje
                $em->flush(); //spremi
                $poruka = array("stanje" => "kreirano");

            }
        }

        return $view = $this->view($poruka, Response::HTTP_OK);

    }


    /**
     * @Rest\View
     */
    public function getAction(Request $request, $id)
    {
        $datum = (new \DateTime("now"));
        $em = $this->getDoctrine()->getManager();
        $ev_dan_user = $em->getRepository('AppBundle:Evidencija_dana')->findBy(
            array('userId' => $id, 'datum' => $datum)
        ); // pronadij user id
        $normal1 =  new EvidencijadanaUserNormalizer();
        $uv= $normal1->normalize($ev_dan_user[0]);
        $ev_dan_user = $em->getRepository('AppBundle:Evidencija_dana')->find($uv); // pronadij user id


        if(!$ev_dan_user){
            $poruka = array('Podaci' => 'Nisu pronadjeni!');
        }else{

            //eksperiment
            $evidencija_vrijeme = $this->getDoctrine()->getRepository('AppBundle:Evidencija')->findBy(
                array('userId' => $id, 'date' => $datum), array('time' => 'ASC')
            );

            $vrijeme = array(); // result

            foreach ($evidencija_vrijeme as $v) { // spremanje u result
                $normalv =  new EvidencijaVrijemeNormalizer();
                $v= $normalv->normalize($v);
                array_push($vrijeme, $v);
            }
// treba sredit, nije lijepo na ovkav naci radit, trba osmislit algoritam, ovo radi ako su u evidenciji 4 zapisa
            $vrijeme1 = strtotime($vrijeme[0]->format('H:i:s'));
            $vrijeme2 = strtotime($vrijeme[1]->format('H:i:s'));
            $vrijeme3 = strtotime($vrijeme[2]->format('H:i:s'));
            $vrijeme4 = strtotime($vrijeme[3]->format('H:i:s'));

            $broj_sati = ($vrijeme2 - $vrijeme1 + $vrijeme4 - $vrijeme3) / 60 / 60;

            //eksperiment kraj
            $ev_dan_user->setDoneBusinessHours($broj_sati);
            $em->flush();



            $poruka = array('Podaci' => 'Izmjenjeni!');
        }

        return $view = $this->view($poruka, Response::HTTP_OK);
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

//
//$em = $this->getDoctrine()->getManager();
//$user = $em->getRepository('AppBundle:Evidencija')->findBy(
//array('userId' => $id)
//); // pronadij user id
//
//
//$result = array(); // result
//
//foreach ($user as $u) { // spremanje u result
//$normal =  new UserNormalizer();
//$u= $normal->normalize($u);
//array_push($result, $u);
//}
//
//
//return $view = $this->view($result, Response::HTTP_OK);

}