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
        chmod($_SERVER['DOCUMENT_ROOT']."/scanscanget/sfile.txt", 0777);
        $myfile = fopen($_SERVER['DOCUMENT_ROOT']."/scanscanget/sfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $uid);
        fclose($myfile);
    }

    public function setTrue(){
        chmod($_SERVER['DOCUMENT_ROOT']."/scanscanget/sfile.txt", 0777);
        $myfile = fopen($_SERVER['DOCUMENT_ROOT']."/scanscanget/sfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, "1");
        fclose($myfile);
    }

    public function setFalse(){
        chmod($_SERVER['DOCUMENT_ROOT']."/scanscanget/sfile.txt", 0777);
        $myfile = fopen($_SERVER['DOCUMENT_ROOT']."/scanscanget/sfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, "0");
        fclose($myfile);
    }
   
}