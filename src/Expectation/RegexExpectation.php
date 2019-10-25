<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace DataTraveller\Expectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Path\Path;

/**
 * Class RegexExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class RegexExpectation implements ExpectationInterface {

    /**
     * @var string
     */
    protected $pattern;

    /**
     * RegexExpectation constructor.
     *
     * @param string $pattern
     */
    public function __construct( string $pattern ) {

        $this->pattern = $pattern;

    }

    /**
     * @return string
     */
    public function getType(): string {

        return $this->pattern;

    }

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        if ( ! preg_match( $this->pattern, $data ) ) {

            throw new UnexpectedDataException( $data, $this->getType(), $path );

        }

        return $this;

    }

}
