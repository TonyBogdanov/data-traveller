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
 * Class LowerThanOrEqualExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class LowerThanOrEqualExpectation implements ExpectationInterface {

    /**
     * @var int|float
     */
    protected $value;

    /**
     * LowerThanOrEqualExpectation constructor.
     *
     * @param float|int $value
     */
    public function __construct( $value ) {

        $this->value = $value;

    }

    /**
     * @return string
     */
    public function getType(): string {

        return 'lte( ' . $this->value . ' )';

    }

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        if ( $data > $this->value ) {

            throw new UnexpectedDataException( $data, $this->getType(), $path );

        }

        return $this;

    }

}
