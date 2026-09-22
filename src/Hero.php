<?php

declare(strict_types=1);

namespace Dungeon;

final class Hero implements Fighter
{
    public private(set) int $maxHp = 0;

    public private(set) int $hp = 0;

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
        $this->maxHp = $maxHp;
        $this->hp = $maxHp;
        $this->inventory = new Inventory();
    }

    public function takeDamage(int $amount): void
    {
        $this->hp = max(0, $this->hp - $amount);
    }

    public function heal(int $amount): void
    {
        $this->hp = min($this->maxHp, $this->hp + $amount);
    }

    public function isAlive(): bool
    {
        return $this->hp > 0;
    }

    public function equip(Weapon $weapon): void
    {
        throw new \LogicException('À implémenter');
    }

    public function drink(Potion $potion): void
    {
        throw new \LogicException('À implémenter');
    }

    public function attack(): int
    {
        throw new \LogicException('À implémenter');
    }

    public function __toString(): string
    {
        return "{$this->name} ({$this->hp}/{$this->maxHp} PV)";
    }
}

