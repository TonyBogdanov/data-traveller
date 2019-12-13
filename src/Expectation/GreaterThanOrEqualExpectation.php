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
 * Class GreaterThanOrEqualExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class GreaterThanOrEqualExpectation implements ExpectationInterface {

    /**
     * @var int|float
     */
    protected $value;

    /**
     * GreaterThanOrEqualExpectation constructor.
     *
     * @param float|int $value
     */
    public function __construct( $value ) {

        $this->setValue( $value );

    }

    /**
     * @return string
     */
    public function getType(): string {

        return 'gte( ' . $this->getValue() . ' )';

    }

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        if ( $data < $this->getValue() ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

    /**
     * @return float|int
     */
    public function getValue() {

        return $this->value;

    }

    /**
     * @param float|int $value
     *
     * @return $this
     */
    public function setValue( $value ) {

        $this->value = $value;
        return $this;

    }

}
