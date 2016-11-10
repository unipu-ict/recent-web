<?php

namespace RecENT\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RecENTUserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
