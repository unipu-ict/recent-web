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
    '_controller' => 'FOSUserBundle:Resetting:request',
)));

$collection->add('profile', new Route('/profile', array(
    '_controller' => 'FOSUserBundle:Profile:profile',
)));

$collection->add('profile', new Route('/profile/{godina}/{mjesec}', array(
    '_controller' => 'FOSUserBundle:Profile:pagination',
)));

$collection->add('edit', new Route('/edit', array(
    '_controller' => 'FOSUserBundle:Profile:edit',
)));

return $collection;
