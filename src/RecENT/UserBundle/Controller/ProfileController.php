<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RecENT\UserBundle\Controller;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller managing the user profile.
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends Controller
{
    /**
     * Show the user.
     */
    public function showAction()
    {
        $datum = (new \DateTime('now'));
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


//        $evidencija = $this->getDoctrine()
//            ->getRepository('AppBundle:Evidencija_dana')
//            ->findBy(array('userId' => $user->getId()));

        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija_dana u WHERE u.userId = :userid and YEAR(u.datum) = :godina and MONTH(u.datum) = :mjesec')
            ->setParameter('userid', $user->getId())->setParameter('godina', $datum->format('Y'))->setParameter('mjesec', $datum->format('m'));
        $data = $query->getResult();

        $dolazak = $this->getDoctrine()
            ->getRepository('AppBundle:Evidencija')
            ->findBy(array('userId' => $user->getId()));

        $god_show = $datum->format("Y");
        $mj_show = $datum->format("m");

        if($mj_show==1){
            $previous_g=$god_show-1;
            $previous_m=12;
            $next_g=$god_show;
            $next_m=$mj_show+1;
        }else if($mj_show==12){
            $previous_g=$god_show;
            $previous_m=$mj_show-1;
            $next_g=$god_show+1;
            $next_m=1;
        }else{
            $previous_g=$god_show;
            $previous_m=$mj_show-1;
            $next_g=$god_show;
            $next_m=$mj_show+1;
        }


        $time=0.0;

        foreach($data as $odradeno){
            $time = $time + $odradeno->getDoneBusinessHours();//zbroj odradenih sati
        }

        $mjeseci = array(); // result

        for ($i = 0; $i <= 6; $i++) {
            $date = date("Y-m-d");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-$i months");
            $mjesec = date("m",$date);
            $godina = date("Y", $date);
            $mjesec_godina = array('mjesec' => $mjesec, 'godina' => $godina);
            array_push($mjeseci, $mjesec_godina);
        }

//        exit(dump($this->container,gettype($time));


        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'evidencija' => $data,
            'dolasci' => $dolazak,
            'odradeno' => round($time, 2), //odrađeno radno vrijeme
            'mjeseci' => $mjeseci,
            'previous_g' =>$previous_g,
            'previous_m' =>$previous_m,
            'next_g' => $next_g,
            'next_m' => $next_m,
            'mjesec' => $datum->format("m"),
            'godina' => $datum->format("Y")


        ));
    }


    /**
     * Show the user.
     */
    public function paginationAction($godina, $mjesec)
    {
        $datum = (new \DateTime('now'));
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $god_show = $godina;
        $mj_show = $mjesec;

//        $evidencija = $this->getDoctrine()
//            ->getRepository('AppBundle:Evidencija_dana')
//            ->findBy(array('userId' => $user->getId()));

        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u FROM AppBundle:Evidencija_dana u WHERE u.userId = :userid and YEAR(u.datum) = :godina and MONTH(u.datum) = :mjesec')
            ->setParameter('userid', $user->getId())->setParameter('godina', $godina)->setParameter('mjesec', $mjesec);
        $data = $query->getResult();

        $dolazak = $this->getDoctrine()
            ->getRepository('AppBundle:Evidencija')
            ->findBy(array('userId' => $user->getId()));

        if($mj_show==1){
            $previous_g=$god_show-1;
            $previous_m=12;
            $next_g=$god_show;
            $next_m=$mj_show+1;
        }else if($mj_show==12){
            $previous_g=$god_show;
            $previous_m=$mj_show-1;
            $next_g=$god_show+1;
            $next_m=1;
        }else{
            $previous_g=$god_show;
            $previous_m=$mj_show-1;
            $next_g=$god_show;
            $next_m=$mj_show+1;
        }


        $time=0.0;

        foreach($data as $odradeno){
            $time = $time + $odradeno->getDoneBusinessHours();//zbroj odradenih sati
        }

        $mjeseci = array(); // result

        for ($i = 0; $i <= 6; $i++) {
            $date = date("Y-m-d");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-$i months");
            $mjesec = date("m",$date);
            $godina = date("Y", $date);
            $mjesec_godina = array('mjesec' => $mjesec, 'godina' => $godina);
            array_push($mjeseci, $mjesec_godina);
        }

//        exit(dump($this->container,gettype($time));


        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'evidencija' => $data,
            'dolasci' => $dolazak,
            'odradeno' => round($time, 2), //odrađeno radno vrijeme
            'mjeseci' => $mjeseci,
            'mjesec' => $mj_show,
            'godina' => $god_show,
            'previous_g' =>$previous_g,
            'previous_m' =>$previous_m,
            'next_g' => $next_g,
            'next_m' => $next_m
        ));
    }

    /**
     * Edit the user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
