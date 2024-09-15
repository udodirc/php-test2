<?php

namespace app\models;

use core\Model;

class PositionModel extends Model
{
    public function positions(): array|false
    {
        $query = "SELECT `id`, `title`
        FROM `positions`";

        return $this->fetch($query);
    }
}