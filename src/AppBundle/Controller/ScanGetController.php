<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ScanGetController extends Controller{

    /**
     * @Route("/scanscanget/", name="scanscanget")
     */
    public function scanscangetAction()
    {
        $this->setTrue();
        return new Response(json_encode($this->setTrue()));      
    } 


	public function zapisiUid($uid){
        $myfile = fopen("scanscanget/sfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $uid);
    }

    public function setTrue(){
        $myfile = fopen("scanscanget/sfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, "1");
    }

    public function setFalse(){
        $myfile = fopen("scanscanget/sfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, "0");
    }
   
}