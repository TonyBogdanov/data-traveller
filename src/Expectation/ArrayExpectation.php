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
 * Class ArrayExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ArrayExpectation implements ExpectationInterface {

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        if ( ! is_array( $data ) ) {

            throw new UnexpectedDataException( $data, 'array', $path );

        }

        return $this;

    }

}
