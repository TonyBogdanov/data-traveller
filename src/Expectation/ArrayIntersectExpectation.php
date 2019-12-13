<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller\Expectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\Traits\IndentTrait;
use DataTraveller\Path\Path;

/**
 * Class ArrayIntersectExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ArrayIntersectExpectation implements ExpectationInterface {

    use IndentTrait;

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

        $this
            ->setCompare( array_values( $compare ) )
            ->setExpectation( $expectation );

    }

    /**
     * @return string
     */
    public function getType(): string {

        return
            "arrayIntersect (\n" .
            $this->indent( json_encode( $this->getCompare() ) ) . ";\n" .
            $this->indent( $this->getExpectation()->getType() ) . ";\n" .
            ')';

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

            $this->getExpectation()->expect( array_values( array_intersect( $data, $this->getCompare() ) ), $path );

        } catch ( UnexpectedDataException $e ) {

            throw new UnexpectedDataException( $data, $this, $path, $e );

        }

        return $this;

    }

    /**
     * @return array
     */
    public function getCompare(): array {

        return $this->compare;

    }

    /**
     * @param array $compare
     *
     * @return $this
     */
    public function setCompare( array $compare ) {

        $this->compare = $compare;
        return $this;

    }

    /**
     * @return ExpectationInterface
     */
    public function getExpectation(): ExpectationInterface {

        return $this->expectation;

    }

    /**
     * @param ExpectationInterface $expectation
     *
     * @return $this
     */
    public function setExpectation( ExpectationInterface $expectation ) {

        $this->expectation = $expectation;
        return $this;

    }

}
