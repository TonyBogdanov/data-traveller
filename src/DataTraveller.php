<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\ExpectationInterface;
use DataTraveller\Exceptions\MissingDataException;
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
     * @var bool
     */
    protected $disableRegexSteps = false;

    /**
     * @param string $path
     * @param $data
     * @param ExpectationInterface $expectation
     *
     * @return mixed
     * @throws InvalidPathException
     * @throws MissingDataException
     * @throws UnexpectedDataException
     */
    public function get( string $path, $data, ExpectationInterface $expectation = null ) {

        $path = Path::parse( $path, $this->isDisableRegexSteps() );
        $value = $path->get( $data );

        if ( isset( $expectation ) ) {

            $expectation->expect( $value, $path );
            
        }

        return $value;

    }

    /**
     * @return bool
     */
    public function isDisableRegexSteps(): bool {

        return $this->disableRegexSteps;

    }

    /**
     * @param bool $disableRegexSteps
     *
     * @return $this
     */
    public function setDisableRegexSteps( bool $disableRegexSteps ) {

        $this->disableRegexSteps = $disableRegexSteps;
        return $this;

    }

}
