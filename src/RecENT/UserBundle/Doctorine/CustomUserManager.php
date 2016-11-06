<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
////////// NIJE U UPOTREBI!!!!!!////////// NIJE U UPOTREBI!!!!!!
////////// NIJE U UPOTREBI!!!!!!
////////// NIJE U UPOTREBI!!!!!!
////////// NIJE U UPOTREBI!!!!!!
////////// NIJE U UPOTREBI!!!!!!

namespace RecENT\UserBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use FOS\UserBundle\Model\UserManager as BaseUserManager;
use FOS\UserBundle\Util\CanonicalFieldsUpdater;
use FOS\UserBundle\Util\PasswordUpdaterInterface;
////////// NIJE U UPOTREBI!!!!!!
////////// NIJE U UPOTREBI!!!!!!
////////// NIJE U UPOTREBI!!!!!!
////////// NIJE U UPOTREBI!!!!!!
class CustomUserManager extends BaseUserManager
{
    public function getParent()
    {
        return 'FOS\UserBundle\Doctorine\UserManager';


    }

    public function getBaseUserInfo(){
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
                'SELECT username, name, surname, email,  FROM RecENT:User '
            );

        return $query->getResult();
    }

    public function getBlockPrefix()
    {
        return 'custom_user_manager_id';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
