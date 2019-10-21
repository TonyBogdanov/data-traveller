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
 * Class NotExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class NotExpectation implements ExpectationInterface {

    /**
     * @var ExpectationInterface
     */
    protected $expectation;

    /**
     * NotExpectation constructor.
     *
     * @param ExpectationInterface $expectation
     */
    public function __construct( ExpectationInterface $expectation ) {

        $this->expectation = $expectation;

    }

    /**
     * @return string
     */
    public function getType(): string {

        return sprintf( 'not(%s)', $this->expectation->getType() );

    }

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        try {

            $this->expectation->expect( $data, $path );

        } catch ( UnexpectedDataException $e ) {

            return $this;

        }

        throw new UnexpectedDataException( $data, $this->getType(), $path );

    }

}
