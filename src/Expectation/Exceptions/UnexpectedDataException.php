<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
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

        parent::__construct( sprintf(

            'Unexpected data: %1$s, expected: %2$s%3$s.',
            $this->format( $data ),
            $expected,
            $path ? sprintf( ' at: %1$s', $path ) : '',

        ), 0, $previous );

    }

}

