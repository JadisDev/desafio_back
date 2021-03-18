<?php

namespace App\Services;

use App\Entities\Alternative;
use App\Entities\Question;
use Doctrine\ORM\EntityManager;

class QuestionService extends ApiResponse {

    public function answeredQuestions(int $userId, EntityManager $em) : array
    {
        try {
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
            $questions = $em->getRepository(Question::class)->unansweredQuestions($userId);
            $data = $this->toModel($questions, $em, false);
            return $this->success("Questões não repondidas", $data);
        } catch (\Throwable $e) {
            return $this->error("Erro ao obter questões repondidas", $e->getMessage());
        }
    }

    private function toModel(array $questions, EntityManager $em, bool $show = false) : array
    {
        $data = [];

        if (count($questions) > 0 && $show) {
            $data = $this->toModelQuestions($questions, $em, $show);
        }

        if (count($questions) > 0 && $show === false) {
            $data = $this->toModelQuestions($questions, $em, $show);
        }

        if (count($questions) === 0 && false === $show) {
            $questions = $em->getRepository(Question::class)->findAll();
            $data = $this->toModelQuestions($questions, $em, $show);
        }

        return $data;
    }

    private function toModelQuestions(array $questions, EntityManager $em, bool $show) : array
    {

        $data = [];

        foreach($questions as $question) {
            $alternatives = $em->getRepository(Alternative::class)->getByQuestion($question->getId());

            $arrayAlternatives = [];
            foreach ($alternatives as $alternative) {
                $arrayAlternatives[] = [
                    'id' => $alternative->getId(),
                    'description' => $alternative->getDescription(),
                    'isRight' => $show ? $alternative->isRight() : ''
                ];
            }

            $data['questions'][] = [
                'type_challenge' => $question->getTypeChallenge()->getDescription(),
                'description' => $question->getDescription(),
                'alternatives' => $arrayAlternatives
            ];
        }

        return $data;
    }
}