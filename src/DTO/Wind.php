<?php

namespace App\DTO;

class Wind {
    public function __construct(
        public readonly float $speed,
        public readonly float $deg,
        public readonly float $gust,
    ){
    }
}
