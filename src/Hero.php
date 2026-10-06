<?php

declare(strict_types=1);

namespace Dungeon;

final class Hero implements Fighter
{
    public private(set) int $maxHp = 0;

    public private(set) int $hp = 0 {
        set => max(0, min($this->maxHp, $value));
    }

    public bool $isFullHealth {
        get => $this->hp === $this->maxHp;
    }

    public readonly Inventory $inventory;

    public private(set) ?Weapon $weapon = null;

    public function __construct(
        public readonly string $name,
        int $maxHp = 10,
        public readonly int $strength = 2,
    ) {
        if (trim($name) === '') {
            throw new \InvalidArgumentException('Un héros a un nom.');
        }

        if ($maxHp < 1) {
            throw new \InvalidArgumentException(
                "maxHp doit valoir au moins 1, $maxHp reçu."
            );
        }

        $this->maxHp = $maxHp;
        $this->hp = $maxHp;
        $this->inventory = new Inventory();
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

    public function equip(Weapon $weapon): void
    {
        $this->weapon = $weapon;
    }

    public function drink(Potion $potion): void
    {
        $this->heal($potion->healing);
        $this->inventory->remove($potion->name);
    }

    public function attack(): int
    {
        return $this->strength + ($this->weapon?->damage ?? 0);
    }

    public function __toString(): string
    {
        return "{$this->name} ({$this->hp}/{$this->maxHp} PV)";
    }
}