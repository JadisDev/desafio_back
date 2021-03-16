<?php

namespace App\Validations\User;

use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValideUserValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        /** @var EntityManager $em */
        $em = $constraint->em;

        $user = $em->getRepository(User::class)->getUserByLogin($value);

        if ($user) {
            $this->context->addViolation($constraint->message, ['%login%' => $value]);
            return false;
        }
        return true;
    }
}