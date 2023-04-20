<?php

namespace console\helpers;

class FavoriteFruit
{
    public Fruit $fruit;
    public bool $isFavorite = false;

    public function __construct(Fruit $fruit)
    {
        $this->fruit = $fruit;
    }
}