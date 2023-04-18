<?php

namespace console\helpers;

class Fruit
{
    public int $id;
    public string $name;
    public string $family;
    public array $nutritions;

    public function __construct($id, $name, $family, $nutritions) {
        $this->id = $id;
        $this->name = $name;
        $this->family = $family;
        $this->nutritions = $nutritions;
    }
}