<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller\Expectation\Exceptions;

use DataTraveller\Path\Path;

/**
 * Class UnexpectedDataException
 *
 * @package DataTraveller\Expectation\Exceptions
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class UnexpectedDataException extends \Exception {

    /**
     * @var string
     */
    protected $actual;

    /**
     * @var string
     */
    protected $expected;

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
     * @param string $expected
     * @param Path|null $path
     * @param UnexpectedDataException|null $previous
     */
    public function __construct(

        $data,
        string $expected,
        Path $path = null,
        UnexpectedDataException $previous = null

    ) {

        $this
            ->setActual( $this->format( $data ) )
            ->setExpected( $expected )
            ->setAt( $path && 0 < count( $path ) ? (string) $path : null );

        parent::__construct( sprintf(

            "Unexpected data: %1\$s, expected:\n%2\$s%3\$s.",
            $this->getActual(),
            $this->getExpected(),
            $this->hasAt() ? sprintf( "\nat: %1\$s", $this->getAt() ) : '',

        ), 0, $previous );

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
