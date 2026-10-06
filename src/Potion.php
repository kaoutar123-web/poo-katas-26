<?php

declare(strict_types=1);

namespace Dungeon;

final class Potion extends Item
{
    public function __construct(
        string $name,
        float $weight,
        public readonly int $healing,
        Rarity $rarity = Rarity::Common,
    ) {
        parent::__construct($name, $weight, $rarity);
    }

    public function describe(): string
    {
        return sprintf(
            '%s : potion (%s kg, +%d PV)',
            $this->name,
            $this->weight,
            $this->healing
        );
    }
}