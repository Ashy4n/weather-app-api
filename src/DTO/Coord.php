<?php

namespace App\DTO;

class Coord
{
    public function __construct(
        public readonly float $lon,
        public readonly float $lat,
    )
    {
    }
}