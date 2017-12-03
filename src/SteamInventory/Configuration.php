<?php
/**
 * Created by PhpStorm.
 * User: fisk
 * Date: 01/12/17
 * Time: 22:07
 */

namespace SteamInventory;

class Configuration {
    private $options = [
        'page_size' => 5000,
        'language' => 'english'
    ];

    /**
     * Configuration constructor.
     * @param array $options
     *
     * Available options:
     * - base_uri  change the base URI used for requests, for if you are using a
     *             forward proxy.
     *
     * - page_size the page size used for page iteration.
     *
     * - language  the language used for inventory descriptions. Note that
     *             some games may not have localised strings; these will be
     *             displayed in English instead.
     */
    public function __construct(array $options = []) {
        foreach ($options as $key => $value) {
            if (!array_key_exists($key, $this->options)) {
                $errFmt = "Key %s is not an applicable option.";
                throw new \InvalidArgumentException(sprintf($errFmt, $key));
            }

            $this->options[$key] = $value;
        }
    }

    public function getPageSize(): int {
        return $this->options['page_size'];
    }

    public function getLanguage(): string {
        return $this->options['language'];
    }
}