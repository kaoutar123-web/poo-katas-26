<?php

declare(strict_types=1);

namespace Dungeon;

final class Weapon extends Item
{
    public function __construct(
        string $name,
        float $weight,
        public readonly int $damage,
        Rarity $rarity = Rarity::Common,
    ) {
        parent::__construct($name, $weight, $rarity);
    }

    public function describe(): string
    {
        return sprintf(
            '%s : arme (%s kg, %d dégâts)',
            $this->name,
            $this->weight,
            $this->damage
        );
    }
}