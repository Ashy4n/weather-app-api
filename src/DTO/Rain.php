<?php

namespace App\DTO;

class Rain
{
    public function __construct(
        public readonly float $h,
    )
    {
    }
}