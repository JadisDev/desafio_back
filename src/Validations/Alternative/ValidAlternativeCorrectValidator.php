<?php

namespace App\Validations\Alternative;

use App\Entities\Alternative;
use App\Entities\Game;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidAlternativeCorrectValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        /** @var EntityManager $em */
        $em = $constraint->em;

        $alternativeId = $value['alternativeId'];
        $userId = $value['userId'];

        $alternative = $em->getRepository(Alternative::class)->find($alternativeId);
        if (!$alternative) {
            $this->context->addViolation('Alternativa não encontrada', []);
            return false;
        }

        $game = $em->getRepository(Game::class)->getGameByUserAndQuestion($userId, $alternative->getQuestion()->getId());
        if ($game) {
            $this->context->addViolation('Essa questão ja foi respondida', []);
            return false;
        }

        if ($alternative->isRight() === false) {
            $this->context->addViolation('Alternativa errada', ['%description%' => $alternative->getDescription()]);
        }

        return true;
    }
}