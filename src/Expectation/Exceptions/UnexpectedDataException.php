<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller\Expectation\Exceptions;

use DataTraveller\Expectation\ExpectationInterface;
use DataTraveller\Path\Path;

/**
 * Class UnexpectedDataException
 *
 * @package DataTraveller\Expectation\Exceptions
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class UnexpectedDataException extends \Exception {

    /**
     * @var ExpectationInterface
     */
    protected $expectation;

    /**
     * @var string
     */
    protected $expected;

    /**
     * @var string
     */
    protected $actual;

    /**
     * @var string|null
     */
    protected $at;

    /**
     * @param $data
     *
     * @return string
     */
    protected function format( $data ): string {

        if ( is_object( $data ) ) {

            return get_class( $data );

        }

        return gettype( $data );

    }

    /**
     * UnexpectedDataException constructor.
     *
     * @param $data
     * @param ExpectationInterface $expectation
     * @param Path|null $path
     * @param UnexpectedDataException|null $previous
     */
    public function __construct(

        $data,
        ExpectationInterface $expectation,
        Path $path = null,
        UnexpectedDataException $previous = null

    ) {

        $this
            ->setExpectation( $expectation )
            ->setExpected( $expectation->getType() )
            ->setActual( $this->format( $data ) )
            ->setAt( $path && 0 < count( $path ) ? (string) $path : null );

        parent::__construct( sprintf(

            "Unexpected data: %1\$s, expected:\n%2\$s%3\$s.",
            $this->getActual(),
            $this->getExpected(),
            $this->hasAt() ? sprintf( "\nat: %1\$s", $this->getAt() ) : '',

        ), 0, $previous );

    }

    /**
     * @return ExpectationInterface
     */
    public function getExpectation(): ExpectationInterface {

        return $this->expectation;

    }

    /**
     * @param ExpectationInterface $expectation
     *
     * @return $this
     */
    public function setExpectation( ExpectationInterface $expectation ) {

        $this->expectation = $expectation;
        return $this;

    }

    /**
     * @return string
     */
    public function getExpected(): string {

        return $this->expected;

    }

    /**
     * @param string $expected
     *
     * @return $this
     */
    public function setExpected( string $expected ) {

        $this->expected = $expected;
        return $this;

    }

    /**
     * @return string
     */
    public function getActual(): string {

        return $this->actual;

    }

    /**
     * @param string $actual
     *
     * @return $this
     */
    public function setActual( string $actual ) {

        $this->actual = $actual;
        return $this;

    }

    /**
     * @return bool
     */
    public function hasAt(): bool {

        return isset( $this->at );

    }

    /**
     * @return string|null
     */
    public function getAt(): ?string {

        return $this->at;
    }

    /**
     * @param string|null $at
     *
     * @return $this
     */
    public function setAt( string $at = null ) {

        $this->at = $at;
        return $this;

    }

}
