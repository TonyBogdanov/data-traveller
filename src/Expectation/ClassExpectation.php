<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller\Expectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Path\Path;

/**
 * Class ClassExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ClassExpectation implements ExpectationInterface {

    /**
     * @var string
     */
    protected $name;

    /**
     * ClassExpectation constructor.
     *
     * @param string $name
     */
    public function __construct( string $name ) {

        $this->name = $name;

    }

    /**
     * @return string
     */
    public function getType(): string {

        return $this->name;

    }

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        if ( ! is_object( $data ) || ! is_a( $data, $this->name, false ) ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

}
