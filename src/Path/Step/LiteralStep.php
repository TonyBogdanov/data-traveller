<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller\Path\Step;

/**
 * Class LiteralStep
 *
 * @package DataTraveller\Path\Step
 * @author TonyBogdanov <tonybogdanov@gmail.com>
 */
class LiteralStep implements StepInterface {

    /**
     * @var string
     */
    protected $value;

    /**
     * LiteralStep constructor.
     *
     * @param string $value
     */
    public function __construct( string $value ) {

        $this->value = $value;

    }

    /**
     * @return string
     */
    public function __toString(): string {

        return $this->value;

    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function expect( string $key ): bool {

        return $key === $this->value;

    }

}
