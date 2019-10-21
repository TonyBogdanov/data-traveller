<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace DataTraveller;

use DataTraveller\Expectation\Exceptions\MissingDataException;
use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\ExpectationInterface;
use DataTraveller\Path\Exceptions\InvalidPathException;
use DataTraveller\Path\Path;

/**
 * Class DataTraveller
 *
 * @package DataTraveller
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class DataTraveller {

    /**
     * @param string $path
     * @param $data
     * @param ExpectationInterface ...$expectations
     *
     * @return mixed
     * @throws InvalidPathException
     * @throws MissingDataException
     * @throws UnexpectedDataException
     */
    public function get( string $path, $data, ExpectationInterface ...$expectations ) {

        $path = Path::parse( $path );
        $value = $path->get( $data, new Path() );

        foreach ( $expectations as $expectation ) {

            $expectation->expect( $value, $path );

        }

        return $value;

    }

}
