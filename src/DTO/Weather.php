<?php

namespace App\DTO;

class Weather {
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $main = null,
        public readonly ?string $description = null,
        public readonly ?string $icon = null
    ){
    }
}
