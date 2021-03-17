<?php

namespace App\Validations\User\Roles;

use App\Exceptions\ValidationException;
use App\Interfaces\Validations\ValidationInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginValidation implements ValidationInterface
{

    function __construct() {}

    public function valid($data) : bool
    {
        try {

            $list = [];
            $validation = Validation::createValidator();

            $list[] = $validation->validate($data['login'], [
                new NotBlank(['message' => "login não informado"]),
            ]);

            $list[] = $validation->validate($data['password'], [
                new NotBlank(['message' => "senha não informado"]),
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