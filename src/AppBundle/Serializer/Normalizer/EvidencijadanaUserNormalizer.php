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
class UserNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {

        return [
            'id'     => $object->getId(),
            'userId' =>  $object->getUserId()->getId(),
            'date'   => $object->getDate(),
            'time'   => $object->getTime(),
            'razlogId'   => $object->getRazlogId()->getId(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof User;
    }
}