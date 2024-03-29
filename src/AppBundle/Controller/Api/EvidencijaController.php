<?php
namespace AppBundle\Controller\Api;
use AppBundle\Entity\Evidencija;
use AppBundle\Entity\Evidencija_dana;
use AppBundle\Entity\Razlog;
use AppBundle\Entity\Tag_user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Serializer\Normalizer\EvidencijaRazlogNormalizer;
use AppBundle\Serializer\Normalizer\EvidencijaVrijemeNormalizer;
use AppBundle\Serializer\Normalizer\EvidencijadanaUserNormalizer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Bundle\FrameworkBundle\Validator;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use AppBundle\Controller\ScanGetController;


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

        //dohvacanje taga 
        
        $file = fopen($_SERVER['DOCUMENT_ROOT']."/scanscanget/sfile.txt","r");
        if( fread($file,filesize($_SERVER['DOCUMENT_ROOT']."/scanscanget/sfile.txt")) == "1") {
            ScanGetController::zapisiUid($uID);
        }
        fclose($file);

        

        if (!$uid){ // ako nema rezultata, ako nepostoji korisnik s tim uid-om
            $content = array("uspjeh" => "ne"); //, "razlog" => "nepostojeci korisnik")
        }elseif ($uid->getType() == 0){
            $content = array("uspjeh" => "ne");
        }else{
            $user = $this->getDoctrine() ->getRepository('AppBundle:User') -> find( $uid->getUserId() ); //ako ima rzultata, identificiraj korisnika
            // 5 minuta blokada
            $evidencija_vrijeme = $this->getDoctrine()->getRepository('AppBundle:Evidencija')->findBy(
                array('userId' => $user, 'date' => $datum), array('time' => 'DESC')
            );
            $razlika_vrijeme = 6;
            if ($evidencija_vrijeme){
                $vrijeme = array(); // result
                foreach ($evidencija_vrijeme as $v) { // spremanje u result
                    $normalv =  new EvidencijaVrijemeNormalizer();
                    $v= $normalv->normalize($v);
                    array_push($vrijeme, $v);
                }
                $zadnje_vrijeme = strtotime($vrijeme[0]->format('H:i:s'));
                $trenutno_vrijeme = strtotime($datum->format('H:i:s'));
                $razlika_vrijeme = ($trenutno_vrijeme - $zadnje_vrijeme);
            }
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
                $kreiraj_evidenciju_dana = $this->kreirajEvidencijadana();
                $update_evidenciju_dana = $this->updateEvidencijadana($user);
                $content = array("uspjeh" => "da"); //, "kreirana_evidencija_dana" => $kreiraj_evidenciju_dana, "update_evidencija_dana" => $update_evidenciju_dana
//                $content = array("uspjeh" => "da");
            }else{
                $content = array("uspjeh" => "ne"); //, "razlog" => "blokada 5 sec"
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
    protected function kreirajEvidencijadana(){
        $em = $this->getDoctrine()->getManager(); //dohvati managera
        $datum = (new \DateTime("now")); //postavi vrijeme
        //$evidencija_dana = $this->getDoctrine()->getRepository('AppBundle:Evidencija_dana')->findAll(); // pronadij user id
        $user = $this->getDoctrine() ->getRepository('AppBundle:User') -> findAll();
        $ev_dana_datum = $this->getDoctrine() ->getRepository('AppBundle:Evidencija_dana') -> findBy(
            array('datum' => $datum), array('datum' => 'ASC'));
        if($ev_dana_datum){
            $poruka = 0; //postoji evidencija dana za danasnji datum
        }else{
            $result1 = array(); // result
            $neprisustvo = $this->getDoctrine()->getRepository('AppBundle:Neprisustvo')-> find(15);
            foreach ($user as $uv) { // spremanje u result
                $normal1 =  new EvidencijadanaUserNormalizer();
                $uv= $normal1->normalize($uv);
                $usr = $user = $this->getDoctrine() ->getRepository('AppBundle:User') -> find($uv);
                array_push($result1, $usr);
                $evidencija_dana = new Evidencija_dana(); // nova Evidencija_dana
                $evidencija_dana->setUserId($usr); // postavi usera
                $evidencija_dana->setDatum(new \DateTime("now")); //postavi vrijeme
                $evidencija_dana->setVrijemeDolaska(new \DateTime(date("H:i:s", strtotime("00:00:00"))));
                $evidencija_dana->setVrijemeOdlaska(new \DateTime(date("H:i:s", strtotime("00:00:00"))));
                $evidencija_dana->setDoneBusinessHours(0);
                $evidencija_dana->setNotWorkingId($neprisustvo);
                $em->persist($evidencija_dana); //pripremi za spremanje
                $em->flush(); //spremi
            }
            $poruka = 1; //kreiranana evidencija dana za danasnji datum
        }
        return $poruka;
    }
    protected function updateEvidencijadana($id){
        $datum = (new \DateTime("now"));
        $em = $this->getDoctrine()->getManager();
        $ev_dan_user = $em->getRepository('AppBundle:Evidencija_dana')->findBy(
            array('userId' => $id, 'datum' => $datum)
        ); // pronadij user id
        if($ev_dan_user){
            $normal1 =  new EvidencijadanaUserNormalizer();
            $uv= $normal1->normalize($ev_dan_user[0]);
            $ev_dan_user_ob = $em->getRepository('AppBundle:Evidencija_dana')->find($uv); // pronadij user id
            //eksperiment
            $evidencija_vrijeme = $this->getDoctrine()->getRepository('AppBundle:Evidencija')->findBy(
                array('userId' => $id, 'date' => $datum), array('time' => 'ASC')
            );
            $neprisustvo = $this->getDoctrine()->getRepository('AppBundle:Neprisustvo')-> find(1);
            $vrijeme = array(); // result
            foreach ($evidencija_vrijeme as $v) { // spremanje u result
                $normalv =  new EvidencijaVrijemeNormalizer();
                $v= $normalv->normalize($v);
                array_push($vrijeme, $v);
            }
            $vrijeme_count = count($vrijeme);


            $odradeno_sati = 0.0;

            // algoritam za računjnje odrađenih sati
            if($vrijeme_count > 1){

                $zadnji_odlazak = $vrijeme_count-1;
                $prvi_dolazak = 0;
                if($vrijeme_count%2 != 0)
                    $zadnji_odlazak = $vrijeme_count - 2;


                for($korak = 0 ; $korak < $zadnji_odlazak ; $korak += 2){
                    $odlazak = strtotime($vrijeme[$korak+1]->format('H:i:s'));
                    $dolazak = strtotime($vrijeme[$korak]->format('H:i:s'));
                    $odradeno_sati = $odradeno_sati + ($odlazak - $dolazak);
                }

                $odradeno_sati = $odradeno_sati / 3600;
                if($vrijeme_count > 3)
                    $odradeno_sati = $odradeno_sati + 0.5;

                $ev_dan_user_ob->setVrijemeDolaska($vrijeme[$prvi_dolazak]);
                $ev_dan_user_ob->setVrijemeOdlaska($vrijeme[$zadnji_odlazak]);
            }else{
                $ev_dan_user_ob->setVrijemeDolaska($vrijeme[0]);
            }





            $ev_dan_user_ob->setDoneBusinessHours($odradeno_sati);

            $ev_dan_user_ob->setNotWorkingId($neprisustvo);
            $em->persist($ev_dan_user_ob);
            $em->flush();
            $poruka = 1; //podaci izmjenjeni
        }else{
            $poruka = 0;
        }
        return $poruka;
    }
}