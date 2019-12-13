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
 * Class ValueExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ValueExpectation implements ExpectationInterface {

    /**
     * @var mixed
     */
    public $value;

    /**
     * ValueExpectation constructor.
     *
     * @param mixed $value
     */
    public function __construct( $value ) {

        $this->setValue( $value );

    }

    /**
     * @return string
     */
    public function getType(): string {

        switch ( true ) {

            case is_float( $this->getValue() ) && is_infinite( $this->getValue() ):
                $expression = 'INF';
                break;

            case $this->getValue() instanceof \Closure:
                $expression = \Closure::class;
                break;

            default:
                $expression = json_encode( $this->getValue() );

        }

        if ( 200 < strlen( $expression ) ) {

            $expression = substr( $expression, 0, 200 ) . '...';

        }

        return 'value = ' . $expression;

    }

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        if ( $this->getValue() !== $data ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

    /**
     * @return mixed
     */
    public function getValue() {

        return $this->value;

    }

    /**
     * @param mixed $value
     *
     * @return $this
     */
    public function setValue( $value ) {

        $this->value = $value;
        return $this;

    }

}
