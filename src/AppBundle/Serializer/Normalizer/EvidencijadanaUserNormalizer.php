<?php

namespace AppBundle\Serializer\Normalizer;

use AppBundle\Entity\User;
use AppBundle\Entity\Razlog;
use AppBundle\Entity\Evidencija;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use JMS\Serializer\Context;

/**
 * User normalizer
 */
class EvidencijadanaUserNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {

        return $object->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof User;
    }
}