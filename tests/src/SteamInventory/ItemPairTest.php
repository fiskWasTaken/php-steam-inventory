<?php

namespace SteamInventory;

use PHPUnit\Framework\TestCase;
use SteamInventory\Entity\ItemPair;

class ItemPairTest extends TestCase {
    /**
     * @var ItemPair
     */
    private $instance;

    public function setUp() {
        $this->instance = new ItemPair([
            'appid' => 1105,
            'contextid' => 2,
            'assetid' => '123456',
            'classid' => '12345678',
            'instanceid' => '0',
            'amount' => 1
        ], [
            'appid' => 1105,
            'classid' => '12345678',
            'instanceid' => '0',
            'name' => "Sneed's Feed and Seed",
            'descriptions' => [
                [
                    'type' => 'html',
                    'value' => 'Description text'
                ]
            ],
            'tags' => [
                [
                    'category' => 'Food',
                    'localized_category_name' => 'Food',
                    'localized_tag_name' => 'Food',
                    'internal_name' => 'food'
                ]
            ]
        ]);
    }

    public function testInstance() {
        $this->assertEquals("Sneed's Feed and Seed", $this->instance->getDescription()->name);
        $this->assertEquals(1105, $this->instance->getAsset()->appid);
        $this->assertEquals('Description text', $this->instance->getDescription()->getDescriptions()[0]->value);
        $this->assertEquals('Food', $this->instance->getDescription()->getTags()[0]->localized_category_name);
    }
}
