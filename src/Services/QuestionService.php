<?php

namespace App\Services;

use App\Entities\Alternative;
use App\Entities\Game;
use App\Entities\Question;
use App\Entities\TypeChallenge;
use Doctrine\ORM\EntityManager;

class QuestionService extends ApiResponse {

    private $userId;

    public function answeredQuestions(int $userId, EntityManager $em) : array
    {
        try {
            $this->userId = $userId;
            $questions = $em->getRepository(Question::class)->answeredQuestions($userId);
            $data = $this->toModel($questions, $em, true);
            return $this->success("Questões repondidas", $data);
        } catch (\Throwable $e) {
            return $this->error("Erro ao obter questões repondidas", $e->getMessage());
        }
    }

    public function unansweredQuestions(int $userId, EntityManager $em) : array
    {
        try {
            $this->userId = $userId;
            $questions = $em->getRepository(Question::class)->unansweredQuestions($userId);
            $data = $this->toModel($questions, $em, false);
            return $this->success("Questões não repondidas", $data);
        } catch (\Throwable $e) {
            return $this->error("Erro ao obter questões repondidas", $e->getMessage());
        }
    }

    private function toModel(array $questions, EntityManager $em, bool $show = false) : array
    {
        if (count($questions) > 0 && $show) {
            return $this->toModelQuestions($questions, $em, $show);
        }

        if (count($questions) > 0 && $show === false) {
            return $this->toModelQuestions($questions, $em, $show);
        }

        $game = $em->getRepository(Game::class)->getGameByUser($this->userId);
        if ( count($game) === 0 && count($questions) === 0 && false === $show) {
            $questions = $em->getRepository(Question::class)->findAll();
            return $this->toModelQuestions($questions, $em, $show);
        }

        return [];
    }

    private function toModelQuestions(array $questions, EntityManager $em, bool $show) : array
    {

        $typesChallenges = $em->getRepository(TypeChallenge::class)->findAll();
        $arrayTypeChallenges = [];

        foreach($typesChallenges as $type) {
            $arrayQuestion = [];
            foreach($questions as $question) {
                if (is_array($question)) {
                    $question = $em->getRepository(Question::class)->find($question['id']);
                }
                if ($type->getId() === $question->getTypeChallenge()->getId()) {
                    $alternatives = $em->getRepository(Alternative::class)->getByQuestion($question->getId());
                    $arrayAlternatives = [];
                    foreach($alternatives as $alternative) {
                        $arrayAlternatives[] = [
                            'id' => $alternative->getId(),
                            'alternative' => $alternative->getDescription(),
                            'is_right' => $show ? $alternative->isRight() : ''
                        ];
                    }
                    $arrayQuestion[] = [
                        'description' => $question->getDescription(),
                        'alternatives' => $arrayAlternatives
                    ];
                }
            }
            $arrayTypeChallenges[] = [
                'type' => $type->getDescription(),
                'questions' => $arrayQuestion
            ];
        }

        return $arrayTypeChallenges;
    }
}