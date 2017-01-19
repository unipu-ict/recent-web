<?php
/**
 * Created by PhpStorm.
 * User: Marino
 * Date: 18.1.2017.
 * Time: 23:55
 */

namespace AppBundle\Serializer\Normalizer;

use AppBundle\Entity\User;
use AppBundle\Entity\Neprisustvo;
use AppBundle\Entity\Evidencija;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use JMS\Serializer\Context;

class EvidencijadanaNeprisustvoNormailzer
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return [
            'datum'     => $object->getDatum(),
            'vrijemeDolaska' =>  $object->getVrijemeDolaska(),
            'vrijemeOdlaska'   => $object->getVrijemeOdlaska(),
            'doneBusinessHours'   => $object->getDoneBusinessHours(),
            'notWorkingId'   => $object->getNotWorkingId()->getId()
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