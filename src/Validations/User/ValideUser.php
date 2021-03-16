<?php

namespace App\Validations\User;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;

class ValideUser extends Constraint
{
    /** @var EntityManager */
    public $em;

    public $message = 'Login ja usado: "%login%"';

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