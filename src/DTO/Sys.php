<?php

namespace App\DTO;

class Sys {
    public function __construct(
        public readonly ?string $country,
        public readonly int $sunrise,
        public readonly int $sunset,
    ){
    }
}