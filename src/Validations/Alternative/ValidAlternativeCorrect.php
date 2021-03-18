<?php

namespace App\Validations\Alternative;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;

class ValidAlternativeCorrect extends Constraint
{

    /** @var EntityManager */
    public $em;

    public $message = 'Alternativa errada: "%description%"';

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

}