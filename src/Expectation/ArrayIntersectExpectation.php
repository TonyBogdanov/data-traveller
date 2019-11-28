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
 * Class ArrayIntersectExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ArrayIntersectExpectation extends ArrayExpectation {

    /**
     * @var array
     */
    protected $compare;

    /**
     * @var ExpectationInterface
     */
    protected $expectation;

    /**
     * ArrayIntersectExpectation constructor.
     *
     * @param array $compare
     * @param ExpectationInterface $expectation
     */
    public function __construct( array $compare, ExpectationInterface $expectation ) {

        $this->compare = array_values( $compare );
        $this->expectation = $expectation;

    }

    /**
     * @return string
     */
    public function getType(): string {

        return 'arrayIntersect<' . json_encode( $this->compare ) . ',' . $this->expectation->getType() . '>';

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

        try {

            $this->expectation->expect( array_values( array_intersect( $data, $this->compare ) ), $path );

        } catch ( UnexpectedDataException $e ) {

            throw new UnexpectedDataException( $data, $this->getType(), $path, $e );

        }

        return $this;

    }

}
