<?php

declare(strict_types=1);

namespace Dungeon;

final class Inventory
{
    /** @var Item[] Les objets transportés. */
    private array $items = [];

    public function __construct(
        public readonly float $maxWeight = 20.0,
    ) {
    }

    /**
     * Ajoute un objet, sauf si le sac déborde.
     *
     * @throws InventoryFullException
     */
    public function add(Item $item): void
    {
        if ($this->totalWeight() + $item->weight > $this->maxWeight) {
            throw new InventoryFullException(
                sprintf(
                    '"%s" ne rentre pas : le sac ne porte que %s kg.',
                    $item->name,
                    $this->maxWeight,
                )
            );
        }

        $this->items[] = $item;
    }

    /** Le nombre d'objets dans le sac. */
    public function count(): int
    {
        return count($this->items);
    }

    /** La somme des poids, en kilos. */
    public function totalWeight(): float
    {
        $total = 0.0;

        foreach ($this->items as $item) {
            $total += $item->weight;
        }

        return $total;
    }

    /** Vérifie si un objet portant ce nom est présent. */
    public function has(string $name): bool
    {
        foreach ($this->items as $item) {
            if ($item->name === $name) {
                return true;
            }
        }

        return false;
    }

    /** Retire le premier objet portant ce nom. */
    public function remove(string $name): void
    {
        foreach ($this->items as $index => $item) {
            if ($item->name === $name) {
                unset($this->items[$index]);

                // Réindexe le tableau pour garder des indices propres.
                $this->items = array_values($this->items);

                return;
            }
        }
    }
}