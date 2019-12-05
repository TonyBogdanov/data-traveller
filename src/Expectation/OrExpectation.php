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
 * Class OrExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class OrExpectation implements ExpectationInterface {

    use IndentTrait;

    /**
     * @var ExpectationInterface[]
     */
    protected $expectations;

    /**
     * OrExpectation constructor.
     *
     * @param ExpectationInterface $left
     * @param ExpectationInterface $right
     * @param ExpectationInterface ...$extra
     */
    public function __construct(

        ExpectationInterface $left,
        ExpectationInterface $right,
        ExpectationInterface ...$extra

    ) {

        $this->expectations = array_merge( [ $left, $right ], $extra );

    }

    /**
     * @return string
     */
    public function getType(): string {

        $result = "or (\n";

        foreach ( $this->expectations as $expectation ) {

            $result .= $this->indent( $expectation->getType() . ";\n" );

        }

        return $result . ')';

    }

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        foreach ( $this->expectations as $expectation ) {

            try {

                $expectation->expect( $data, $path );
                return $this;

            } catch ( UnexpectedDataException $e ) {}

        }

        throw new UnexpectedDataException( $data, $this->getType(), $path );

    }

}
