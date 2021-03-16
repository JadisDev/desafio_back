<?php

namespace App\Services;

use App\Entities\User;
use App\Exceptions\ValidationException;
use App\Validations\User\Roles\UserValidation;
use DateTime;
use Doctrine\ORM\EntityManager;

class UserService extends ApiResponse {

    public function saveUser(array $data, EntityManager $em) : array
    {
        try {
            $valid = new UserValidation($em);
            $valid->valid($data);
            $user = new User();
            $user->setName($data['name']);
            $user->setLogin($data['login']);
            $user->setPassword($data['password']);
            $user->setCreatedAn(new DateTime());
            $em->persist($user);
            $em->flush();
            return $this->success("Novo usuário cadastrado com sucesso", $data);
        } catch (ValidationException $e) {
            return $this->warning("Erro de validação", $e->getData());
        } catch (\Throwable $e) {
            return $this->error("Erro inesperado", $e->getMessage());
        }
    }

}