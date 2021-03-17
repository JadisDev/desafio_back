<?php

namespace App\Services;

use App\Entities\User;
use App\Exceptions\ValidationException;
use App\Validations\User\Roles\LoginValidation;
use App\Validations\User\Roles\UserValidation;
use DateTime;
use Doctrine\ORM\EntityManager;
use Exception;
use \Firebase\JWT\JWT;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

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

    public function login(array $data, EntityManager $em) : array
    {
        try {
            $valid = new LoginValidation($em);
            $valid->valid($data);
            $user = $em->getRepository(User::class)->login(
                $data['login'], md5($data['password'])
            );
            if ($user) {
                $token = $this->jwtEncode($user);
                return $this->success("Autenticação realizada", $token);
            }
            throw new Exception('Usuário ou senha incorretos');
        } catch (ValidationException $e) {
            return $this->warning("Erro de validação", $e->getData());
        } catch (\Throwable $e) {
            return $this->info("Não foi possível autenticar usuário", $e->getMessage());
        }
    }

    public function jwtEncode(User $user) : string
    {
        try {
            $key = $_ENV['KEY'];
            $payload = [
                "id" => $user->getId(),
                "nome" => $user->getName(),
                "login" => $user->getLogin()
            ];
            return JWT::encode($payload, $key);
        } catch( \Throwable $e) {
            throw $e;
        }
    }

    public function jwtDecode($jwt) : array
    {
        try {
            $key = $_ENV['KEY'];
            return (array )JWT::decode($jwt, $key, array('HS256'));
        } catch (\Throwable $e) {
            throw $e;
        }
    }

}