<?php

declare(strict_types=1);

namespace Dungeon;

abstract class Item implements \Stringable
{
    public function __construct(
        public readonly string $name,
        public readonly float $weight,
        public readonly Rarity $rarity = Rarity::Common,
    ) {
        if ($weight < 0) {
            throw new \InvalidArgumentException(
                "Un poids n'est pas négatif, $weight reçu."
            );
        }
    }

    public function __toString(): string
    {
        return $this->name;
    }
}