<?php

namespace App\DTO;

class WeatherApiResponse
{

public readonly Weather $weather;

    public function __construct(
        public readonly ?Coord $coord = null,
        ?array $weather = null,
        public readonly ?string $base = null,
        public readonly ?Main $main = null,
        public readonly ?int $visibility = null,
        public readonly ?Wind $wind = null,
        public readonly ?Rain $rain = null,
        public readonly ?Clouds $clouds = null,
        public readonly ?int $dt = null,
        public readonly ?Sys $sys = null,
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?int $cod = null,
    )
    {
        $this->weather = new Weather($weather[0]['id'],$weather[0]['main'],$weather[0]['description'],$weather[0]['icon']);
    }
}

