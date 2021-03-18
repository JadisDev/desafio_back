<?php

namespace App\Validations\Alternative\Roles;

use App\Exceptions\ValidationException;
use App\Interfaces\Validations\ValidationInterface;
use App\Validations\Alternative\ValidAlternativeCorrect;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\NotBlank;

class AlternativeValidation implements ValidationInterface {

    private $em;

    function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function valid($data) : bool
    {
        try {

            $list = [];
            $validation = Validation::createValidator();

            $list[] = $validation->validate($data['alternativeId'], [
                new NotBlank(['message' => "Alternativa não informado"]),
            ]);

            $list[] = $validation->validate($data, [
                new ValidAlternativeCorrect($this->em)
            ]);

            $erros = [];

            if (0 !== count($list)) {
                /** @var ConstraintViolationList $restricao */
                foreach ($list as $restrictions) {
                    /** @var ConstraintViolation $restricao */
                    foreach ($restrictions as $restriction) {
                        $erros[] = $restriction->getMessage();
                    }
                }
            }

            if (0 !== count($erros)) {
                throw new ValidationException('Erro ao validar dados', null, null, $erros);
            }

            return true;

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            throw $e;
        }

    }

}


