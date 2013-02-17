<?php

namespace App\FrontendBundle\Form\DataTransformer;

use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;

class EntityToIdTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @var string
     */
    private $repository;

    /**
     * Constructor
     *
     * @param ObjectManager $em
     * @param string        $repository
     */
    public function __construct(ObjectManager $em, $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        if (null === $value) {
            return "";
        }

        return $value->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if (!$value) {
            return null;
        }

        $entity = $this->em
            ->getRepository($this->repository)
            ->find($value);
        ;

        if (null === $entity) {
            throw new TransformationFailedException(sprintf('An object with id "%s" does not exist!', $value));
        }

        return $entity;
    }
}
