<?php


namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;

use AppBundle\Entity\Tag_user;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;



class ZaposleniciController extends Controller
{

    /**
     * @Route("/dashboard/registracija", name="registracija")
     *
     */

    public function addworkerAction(Request $request)
    {
       /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $poruka ="";

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);


                if (null === $response = $event->getResponse()) {

                    /*
                postavljanje inicijalne vrijednosti taga
                 */
                $tag = new Tag_user();
                $tag->setUserId($user->getId());
                $tag->setType(0);
                $tag->setUserTag("bezveze");
                $em = $this->getDoctrine()->getManager();
                $em->persist($tag);
                $em->flush();

                    
                    return $this->render('dashboard/zaposlenici/registracija.html.twig', array(
                        'form' => $form->createView(),
                        'message' => 'Zaposlenik uspiješno registriran!'
                    ));
                }

                //$dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }

        return $this->render('dashboard/zaposlenici/registracija.html.twig', array(
            'form' => $form->createView(),
            'message' => $poruka
        ));



    }

    

    /**
     * @Route("/dashboard/postavkeevidencije", name="postavkeevidencije")
     *
     */

    public function postavkeEvidenAction(Request $request)
    {

        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

       
        return $this->render('dashboard/zaposlenici/postavkeevidencije.html.twig', array(
            'users' => $users,
            'selecteduser' => array('id'=> 'none')
        ));



    }


    /**
     * @Route("/dashboard/postavkeevidencije/{id}", name="postavkeevidencijeodabran")
     *
     */

    public function postavkeEvidenOdabraniAction($id, Request $request)
    {

        /*
        Definicija tipova tagova, za sad tu!
        0 => nema postavljen tag
        1 => Android Apliikacija
        2 => Tag/Kartica/NeAndroidAplikacija
         */
        $poruka="";
        $userManager = $this->get('fos_user.user_manager');
        $em = $this->getDoctrine()->getManager();

        $tag = $em->getRepository('AppBundle:Tag_user')->findOneBy(array('userId'=>$id) );

        $users = $userManager->findUsers();
        $suser = $userManager->findUserBy(array( 'id' => $id));

        $update = $request->request->get('tip'); // update gleda ako je submitirana forma
         if(isset($update)) {
            $poruka = $this->updateTagUserAction($request);
         }
       
       

        return $this->render('dashboard/zaposlenici/postavkeevidencije.html.twig', array(
            'users' => $users,
            'selecteduser' => $suser,
            'tag' => $tag,
            'message' => $poruka
        ));
    }


    /**
     * @Route("/dashboard/uredizaposlenika", name="uredizaposlenika")
     *
     */
    public function urediZaposlenikaAction(Request $request)
    {

        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        $poruka ="";

        return $this->render('dashboard/zaposlenici/uredi.html.twig', array(
            'suser' => "",
            'users' => $users,
            'message' => $poruka
        ));

    }

    /**
     * @Route("/dashboard/uredizaposlenika/{id}", name="uredizaposlenikaid")
     *
     */
    public function urediZaposlenikaSIdAction($id, Request $request)
    {

        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        $suser = $userManager->findUserBy(  array('id' => $id ));

        $message ="";
        $id_user=$request->request->get('id');
        $new_user_email=$request->request->get('email');
        $new_user_username= $request->request->get('username');
        $new_user_name=$request->request->get('name');
        $new_user_surname = $request->request->get('surname');

         if($userManager->findUserBy(array('id'=>$id_user)))   {
             if(isset($id_user)&&isset($new_user_email)&&isset($new_user_name)&&isset($new_user_surname)&&isset($new_user_username)){
                    $message=$this->updateUserAction($id_user,$new_user_email,$new_user_username,$new_user_name,$new_user_surname);
             }
         }
        


        return $this->render('dashboard/zaposlenici/uredi.html.twig', array(
            'suser' => $suser,
            'users' => $users,
            'message' => $message
        ));

    }

    // update korisnika
    public function updateUserAction($id,$newEmail,$newUsername,$newName,$newSurname)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id'=>$id));

        $user->setEmail($newEmail);
        $user->setName($newName);
        $user->setSurname($newSurname);
        $user->setUsername($newUsername);

        $this->get('fos_user.user_manager')->updateUser($user, false);
        $this->getDoctrine()->getManager()->flush();

        return "Uspješno promjenjeni podaci!";
        

        // make more modifications to the database

        
    }

    public function updateTagUserAction(Request $request)
    {
        $id_taga=$request->request->get('id_tag_user'); // primarni kljuc taga
        $tip =$request->request->get('tip');
        $vrijednost = $request->request->get('vrijednost');


        
        $em = $this->getDoctrine()->getManager();
        $tag_trenutni = $em->getRepository('AppBundle:Tag_user')->find($id_taga);

        $trenutni_tip = $tag_trenutni->getType();

    
            if($tip=='0') {
                $tag_trenutni->setUserTag( "none" );
                $tag_trenutni->setType(0);
                $em->flush();
                return "Uspješno pormjenjeni podaci! tip = 0 ";
            }
            else if($tip=='1' && $trenutni_tip!='1') {
                $vr= uniqid();
                $tag_trenutni->setUserTag( $vr );
                $tag_trenutni->setType(1);
                $em->flush();
                return "Uspješno pormjenjeni podaci! tip = 1 , vrijednost: " . $vr . " .";
            }
            else if($tip=='2' && isset($vrijednost) ) { // ako je trenutni tip android nista ne mjenjaj čovječe božiji :-)
                $tag_trenutni->setUserTag( $vrijednost);
                $tag_trenutni->setType(2);
                $em->flush();
                ScanGetController::setFalse();
                return "Uspješno pormjenjeni podaci! tip = 2 , vrijednost: " . $vrijednost . " . ";
            }
            else { return "Ništa nije mijenjano!"; }
        
    }
}
