<?php

namespace App\Service;

class Validator
{
    public function validateWeatherInput(?float $lat,?float $lng): bool
    {
        if(!is_numeric($lng) || !is_numeric($lat))return false;
        if($lat == null || $lng == null) return false;
        if($lat < -90 || $lat > 90 || $lng < -180 || $lng > 180) return false;

        return true;
    }

    public function validateHistoryInput(?float  $page,?float  $limit): bool
    {
        if(!is_numeric($page) || !is_numeric($limit) || $limit > 100)return false;

        return true;
    }
}