<?php

namespace AppBundle\Serializer\Normalizer;

use AppBundle\Entity\User;
use AppBundle\Entity\Razlog;
use AppBundle\Entity\Evidencija;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use JMS\Serializer\Context;

/**
 * EvidencijaRazlog normalizer
 */
class EvidencijaRazlogNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return $object->getRazlogId()->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof User;
    }
}