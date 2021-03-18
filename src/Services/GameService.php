<?php

namespace App\Services;

use App\Entities\Alternative;
use App\Entities\Game;
use App\Entities\User;
use App\Exceptions\ValidationException;
use App\Validations\Alternative\Roles\AlternativeValidation;
use Doctrine\ORM\EntityManager;

class GameService extends ApiResponse
{

    public function saveGame(array $data, EntityManager $em) : array
    {
        try {
            $valid = new AlternativeValidation($em);
            $valid->valid($data);
            $user = $em->getRepository(User::class)->find($data['userId']);
            $alternative = $em->getRepository(Alternative::class)->find($data['alternativeId']);
            $question = $alternative->getQuestion();
            $game = new Game();
            $game->setQuestion($question);
            $game->setUser($user);
            $em->persist($game);
            $em->flush();
            return $this->success("Alternativa correta", $data);
        } catch (ValidationException $e) {
            return $this->warning("Erro de validação", $e->getData());
        } catch (\Throwable $e) {
            return $this->error("Erro inesperado", $e->getMessage());
        }
    }

}