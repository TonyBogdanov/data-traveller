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
 * Class ArrayDiffExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ArrayDiffExpectation implements ExpectationInterface {

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
     * ArrayDiffExpectation constructor.
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

        return
            "arrayDiff (\n" .
            $this->indent( json_encode( $this->compare ) ) . ";\n" .
            $this->indent( $this->expectation->getType() ) . ";\n" .
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

            $this->expectation->expect( array_values( array_diff( $data, $this->compare ) ), $path );

        } catch ( UnexpectedDataException $e ) {

            throw new UnexpectedDataException( $data, $this, $path, $e );

        }

        return $this;

    }

}
