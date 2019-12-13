<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller\Expectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\Traits\IndentTrait;
use DataTraveller\Path\Path;

/**
 * Class EnumExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class EnumExpectation implements ExpectationInterface {

    use IndentTrait;

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

        $result = "enum (\n";

        foreach ( $this->options as $option ) {

            $result .= $this->indent( json_encode( $option ) . ";\n" );

        }

        return $result . ')';

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

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

}
