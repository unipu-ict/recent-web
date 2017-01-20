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
class Mobitel1Normalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {

        return [
            'id'     => $object->getId(),
            'date'   => $object->getDatum()->format('d.m'),
            'arrived'   => $object->getVrijemeDolaska()->format('H:i'),
            'left'   => $object->getVrijemeOdlaska()->format('H:i'),
            'workHours'   => round($object->getDoneBusinessHours(), 2)
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