<?php

declare(strict_types=1);

namespace Dungeon;

abstract class Monster implements Fighter
{
    public private(set) int $maxHp = 0;

    public private(set) int $hp = 0 {
        set => max(0, min($this->maxHp, $value));
    }

    public bool $isFullHealth {
        get => $this->hp === $this->maxHp;
    }

    public function __construct(
        public readonly string $name,
        int $maxHp,
    ) {
        if (trim($name) === '') {
            throw new \InvalidArgumentException('Un monstre a un nom.');
        }

        if ($maxHp < 1) {
            throw new \InvalidArgumentException(
                "maxHp doit valoir au moins 1, $maxHp reçu."
            );
        }

        $this->maxHp = $maxHp;
        $this->hp = $maxHp;
    }

    public function takeDamage(int $amount): void
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException(
                "Les dégâts doivent être positifs, $amount reçu."
            );
        }

        $this->hp -= $amount;
    }

    public function heal(int $amount): void
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException(
                "Le soin doit être positif, $amount reçu."
            );
        }

        $this->hp += $amount;
    }

    public function isAlive(): bool
    {
        return $this->hp > 0;
    }

    abstract public function attack(): int;

    public function __toString(): string
    {
        return sprintf(
            '%s (%d/%d PV)',
            $this->name,
            $this->hp,
            $this->maxHp
        );
    }
}