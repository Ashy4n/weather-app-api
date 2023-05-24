<?php

namespace App\DTO;

class Statistics
{
    public function __construct(
        public readonly ?string $mostQueriedCity,
        public readonly int $allQueries,
        public readonly array $temperatureData
    )
    {
    }
}
