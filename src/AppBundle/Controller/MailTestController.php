<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class MailTestController extends Controller
{
    /**
     * @Route("/mailtest", name="mailtest")
     */

    public function homepageAction()
    {
        $name = "masino";
        $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('recent@trendovi.com.hr')
        ->setTo('masimo.orbanic@gmail.com')
        ->setBody(
            $this->renderView(
                'email/test.html.twig',
                array('name' => $name)
            ),
            'text/html'
        )  
    ;
    if($this->get('mailer')->send($message)) {
        echo "poruka poslana<br>";
    }

    return new Response("poruka poslana valjda o.O ");

        
     }   

    
    

    
}

