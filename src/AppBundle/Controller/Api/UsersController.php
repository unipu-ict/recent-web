<?php


namespace AppBundle\Controller\Api;
 
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Tag_user;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Serializer\Normalizer\Tag_userNormalizer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Bundle\FrameworkBundle\Validator;


class UsersController extends FOSRestController
{
    /**
     * @Rest\Get("/api/")
     */
    public function indexAction(Request $request) //defaultni za api url
    {

       
       $data = ['Hi' => 'user :) '];
        $view = $this->view($data, Response::HTTP_OK);
        return $view;
       
    }

    /**
     * @Rest\View
     */
    public function allAction(Request $request)
    {
      
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
        throw $this->createAccessDeniedException();
       }

        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u.username, u.email , u.name , u.surname FROM AppBundle\Entity\User u ');
        $data = $query->getResult();

        $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;
 
    }
 
    /**
     * @Rest\View
     */
    public function getAction(Request $request, $id)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
        throw $this->createAccessDeniedException();
       }
        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u.username, u.email , u.name , u.surname FROM AppBundle\Entity\User u WHERE u.id = :uid')->setParameter('uid', $id);
        $data = $query->getResult();

        $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;
 
    }


     /**
     * @Rest\View
     */
    public function userInfoAction(Request $request)
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u.username, u.email , u.name , u.surname FROM AppBundle\Entity\User u WHERE u.id = :uid')->setParameter('uid', $id);
        $data = $query->getResult();

        $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;
 
    }

    /**
     * @Rest\View
     */
    public function userLoginAction(Request $request)
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $query=$em->createQuery( 'SELECT u.username, u.email , u.name , u.surname FROM AppBundle\Entity\User u WHERE u.id = :uid')->setParameter('uid', $id);
        $data = $query->getResult();
        $tag = $this->getDoctrine() ->getRepository('AppBundle:Tag_user')->findOneBy(array('userId' => $id));
        $normal1 =  new Tag_userNormalizer();
        $item= $normal1->normalize($tag);

        $podaci = array('info' => $data, 'user_tag' => $item);

        $view = $this->view($podaci, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;

    }
    
    /**
     * @Rest\View
     */
    public function userUpdateEmailAction(Request $request)
    {
       
        $content = $this->getContentAsArray($request); // poznvana pomocna klasa definirana ispod
        $user = $this->getUser();

        $user->setEmail($content->{'email'});

        $this->get('fos_user.user_manager')->updateUser($user, false);

        $this->getDoctrine()->getManager()->flush();

        return $view = $this->view($content, Response::HTTP_INTERNAL_SERVER_ERROR);

    }


    protected function getContentAsArray(Request $request){ //pomocna funkcjia za vratit json iz respnsa
        $content = $request->getContent();

        if(empty($content)){
            throw new BadRequestHttpException("Content is empty");
        }

        return json_decode($content);
    }


}