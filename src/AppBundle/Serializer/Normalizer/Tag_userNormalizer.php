<?php

namespace AppBundle\Serializer\Normalizer;

use AppBundle\Entity\User;
use AppBundle\Entity\Razlog;
use AppBundle\Entity\Evidencija_dana;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use JMS\Serializer\Context;

/**
 * User normalizer
 */
class Tag_userNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {

        return  $object->getUserTag();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof User;
    }
}