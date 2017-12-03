<?php
/**
 * Created by PhpStorm.
 * User: fisk
 * Date: 01/12/17
 * Time: 23:17
 */

namespace SteamInventory;


use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase {
    public function testConfigurationDefaults() {
        $cfg = new Configuration();
        $this->assertEquals('english', $cfg->getLanguage());
        $this->assertEquals(5000, $cfg->getPageSize());
    }

    public function testInvalidConfiguration() {
        $this->expectException(\InvalidArgumentException::class);
        new Configuration([
            'notRealKey' => 'value'
        ]);
    }

    public function testModifiedConfiguration() {
        $cfg = new Configuration([
            'language' => 'french',
            'page_size' => 500
        ]);

        $this->assertEquals('french', $cfg->getLanguage());
        $this->assertEquals(500, $cfg->getPageSize());
    }
}