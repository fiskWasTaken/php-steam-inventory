<?php

namespace SteamInventory\Entity;


abstract class Model {
    private $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function __get($name) {
        return $this->data[$name] ?? null;
    }

    public function toArray(): array {
        return $this->data;
    }
}