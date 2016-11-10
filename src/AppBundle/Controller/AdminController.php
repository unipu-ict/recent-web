<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
	/**
	* @Route("/admin/", name="admin")
	* 
	*/
    public function adminAction(Request $request)
    {

        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        $message="";

        $id_user=$request->request->get('id');
        $new_user_email=$request->request->get('email');
        $new_user_username= $request->request->get('username');
        $new_user_name=$request->request->get('name');
        $new_user_surname = $request->request->get('surname');

	     if($userManager->findUserBy(array('id'=>$id_user)))   {
		     if(isset($id_user)&&isset($new_user_email)&&isset($new_user_name)&&isset($new_user_surname)&&isset($new_user_username)){
		        	$message=$this->updateAction($id_user,$new_user_email,$new_user_username,$new_user_name,$new_user_surname);
		     }
	     }
	     else { $message="Nepostojeći korisnik!";}   
        
        return $this->render('admin/admin.html.twig', array('users' =>  $users, 'message' => $message));
    }




    public function updateAction($id,$newEmail,$newUsername,$newName,$newSurname)
    {
    	$userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id'=>$id));

        $user->setEmail($newEmail);
        $user->setName($newName);
        $user->setSurname($newSurname);
        $user->setUsername($newUsername);

        $this->get('fos_user.user_manager')->updateUser($user, false);
        $this->getDoctrine()->getManager()->flush();

        return "Uspješno pormjenjeni podaci!";
        

        // make more modifications to the database

        
    }
}
