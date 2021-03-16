<?php

namespace App\Validations\User\Roles;

use App\Exceptions\ValidationException;
use App\Interfaces\Validations\ValidationInterface;
use App\Validations\User\ValideUser;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserValidation implements ValidationInterface {

    private $em;

    function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function valid($data) : bool
    {
        try {

            $list = [];
            $validation = Validation::createValidator();

            $list[] = $validation->validate($data['name'], [
                new NotBlank(['message' => "nome não informado"]),
                new Length([
                    'min' => 3,
                    'max' => 100,
                    'minMessage' => 'Nome deve conter no mínimo {{ limit }} caracteres',
                    'maxMessage' => 'Nome deve conter no máximo {{ limit }} caracteres',
                ])
            ]);

            $list[] = $validation->validate($data['password'], [
                new NotBlank(['message' => "senha não informado"]),
                new Length([
                    'min' => 3,
                    'max' => 10,
                    'minMessage' => 'Senha deve conter no mínimo {{ limit }} caracteres',
                    'maxMessage' => 'Senha deve conter no máximo {{ limit }} caracteres',
                ])
            ]);

            $list[] = $validation->validate($data['login'], [
                new NotBlank(['message' => "nome não informado"]),
                new Length([
                    'min' => 3,
                    'max' => 3,
                    'exactMessage' => 'Login deve conter exatamente {{ limit }} caracteres',
                ]),
                new ValideUser($this->em)
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