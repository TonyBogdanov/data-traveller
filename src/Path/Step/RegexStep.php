<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller\Path\Step;

/**
 * Class RegexStep
 *
 * @package DataTraveller\Path\Step
 * @author TonyBogdanov <tonybogdanov@gmail.com>
 */
class RegexStep implements StepInterface {

    /**
     * @var string
     */
    protected $regex;

    /**
     * RegexStep constructor.
     *
     * @param string $regex
     */
    public function __construct( string $regex ) {

        $this->regex = $regex;

    }

    /**
     * @return string
     */
    public function __toString(): string {

        return $this->regex;

    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function expect( string $key ): bool {

        return preg_match( $this->regex, $key );

    }

}
