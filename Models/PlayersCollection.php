<?php declare( strict_types = 1 );

namespace Models;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use TypeError;

/**
 * Custom PlayerBase collection
 */
class PlayersCollection implements ArrayAccess, IteratorAggregate {

    private array $players;


    /**
     * @param PlayerBase ...$players
     */
    public function __construct(PlayerBase ...$players) {
        $this -> players = $players;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset) : bool {
        return isset($this -> players[$offset]);
    }

    /**
     * @param mixed $offset
     * @return PlayerBase
     */
    public function offsetGet(mixed $offset) : PlayerBase {
        return $this -> players[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value) : void {
        if ($value instanceof PlayerBase) {
            $this -> players[$offset] = $value;
        }
        else throw new TypeError("Not a player!");
    }

    /**
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset) : void {
        unset($this -> players[$offset]);
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator() : ArrayIterator {
        return new ArrayIterator($this -> players);
    }

    /**
     * @param PlayerBase $player
     * @return void
     */
    public function add(PlayerBase $player): void
    {
        $this->players[] = $player;
    }

}