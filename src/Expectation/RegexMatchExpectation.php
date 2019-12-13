<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller\Expectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Path\Path;

/**
 * Class RegexMatchExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class RegexMatchExpectation implements ExpectationInterface {

    /**
     * @var string
     */
    protected $pattern;

    /**
     * RegexMatchExpectation constructor.
     *
     * @param string $pattern
     */
    public function __construct( string $pattern ) {

        $this->setPattern( $pattern );

    }

    /**
     * @return string
     */
    public function getType(): string {

        return 'regexMatch = ' . $this->getPattern();

    }

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        if ( ! preg_match( $this->getPattern(), $data ) ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

    /**
     * @return string
     */
    public function getPattern(): string {

        return $this->pattern;

    }

    /**
     * @param string $pattern
     *
     * @return $this
     */
    public function setPattern( string $pattern ) {

        $this->pattern = $pattern;
        return $this;

    }

}
