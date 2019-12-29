<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller\Exceptions;

use DataTraveller\Path\Path;

/**
 * Class MissingDataException
 *
 * @package DataTraveller\Exceptions
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class MissingDataException extends \Exception {

    /**
     * MissingDataException constructor.
     *
     * @param Path|null $path
     */
    public function __construct( Path $path = null ) {

        parent::__construct( sprintf(

            'Missing data%1$s.',
            $path && 0 < count( $path ) ? sprintf( ' at: %1$s', $path ) : ''

        ) );

    }

}
