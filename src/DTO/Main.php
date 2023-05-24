<?php

namespace App\DTO;

class Main
{
    public function __construct(
        public readonly float $temp,
        public readonly float $feels_like,
        public readonly float $temp_min,
        public readonly float $temp_max,
        public readonly float $pressure,
        public readonly float $humidity,
        public readonly float $sea_level,
        public readonly float $grnd_level,
    )
    {
    }
}