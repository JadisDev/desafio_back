<?php

namespace App\Services;

use App\Entities\TypeChallenge;
use Doctrine\ORM\EntityManager;

class TypeService extends ApiResponse {

    public function getTypes(EntityManager $em) : array
    {
        try {
            $data = [];
            $types = $em->getRepository(TypeChallenge::class)->findAll();
            foreach($types as $type) {
                $data[] = [
                    'id' => $type->getId(),
                    'text' => $type->getDescription()
                ];
            }
            return $this->success("Lista de tipos de desafios", $data);
        } catch (\Throwable $e) {
            return $this->error("Erro ao obter questões repondidas", $e->getMessage());
        }
    }
}