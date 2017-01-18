<?php
namespace AppBundle\Controller;

class Zapisi {
	
	public function zapisiUid($uid){
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $uid);
    }

    public function setTrue(){
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, "1");
    }

    public function setFalse(){
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, "0");
    }
   
}