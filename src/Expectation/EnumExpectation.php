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
 * Class EnumExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class EnumExpectation implements ExpectationInterface {

    /**
     * @var array
     */
    protected $options;

    /**
     * EnumExpectation constructor.
     *
     * @param array $options
     */
    public function __construct( array $options ) {

        $this->options = array_values( $options );

    }

    /**
     * @return string
     */
    public function getType(): string {

        return 'enum<' .
            implode( ',', array_map( function ( $value ) {

                return json_encode( $value );

            }, $this->options ) ) .
            '>';

    }

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        if ( ! in_array( $data, $this->options, true ) ) {

            throw new UnexpectedDataException( $data, $this->getType(), $path );

        }

        return $this;

    }

}
