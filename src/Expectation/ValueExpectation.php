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
 * Class ValueExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ValueExpectation implements ExpectationInterface {

    /**
     * @var mixed
     */
    protected $value;

    /**
     * ValueExpectation constructor.
     *
     * @param mixed $value
     */
    public function __construct( $value ) {

        $this->value = $value;

    }

    /**
     * @return string
     */
    public function getType(): string {

        $expression = serialize( $this->value );
        if ( 50 < strlen( $expression ) ) {

            $expression = substr( $expression, 0, 50 ) . '...';

        }

        return 'value<' . $expression . '>';

    }

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        if ( $this->value !== $data ) {

            throw new UnexpectedDataException( $data, $this->getType(), $path );

        }

        return $this;

    }

}
