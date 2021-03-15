<?php

namespace App\Interfaces\Validations;

interface ValidationInterface {
    public function valid($data) : bool;
}