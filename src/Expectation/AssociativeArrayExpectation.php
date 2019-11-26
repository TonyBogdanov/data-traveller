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
 * Class AssociativeArrayExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class AssociativeArrayExpectation extends ArrayExpectation {

    /**
     * @return string
     */
    public function getType(): string {

        return 'array<associative>';

    }

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        parent::expect( $data, $path );

        $count = count( $data );
        if ( 0 === $count ) {

            return $this;

        }

        $keys = array_keys( $data );
        sort( $keys );

        if ( range( 0, $count - 1 ) === $keys ) {

            throw new UnexpectedDataException( $data, $this->getType(), $path );

        }

        return $this;

    }

}
