<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();



$collection->add('orecent', new Route('/orecent', array(
    '_controller' => 'AppBundle:oRecent:orecent',
)));

$collection->add('kontakt', new Route('/kontakt', array(
    '_controller' => 'AppBundle:Kontakt:kontakt',
)));

$collection->add('resetting', new Route('/resetting', array(
    '_controller' => 'FOSUserBundle:Resetting:reset',
)));

$collection->add('profile', new Route('/profile', array(
    '_controller' => 'FOSUserBundle:Profile:profile',
)));

return $collection;
