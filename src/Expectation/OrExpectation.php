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

        $this->setExpectations( array_merge( [ $left, $right ], $extra ) );

    }

    /**
     * @return string
     */
    public function getType(): string {

        $result = "or (\n";

        foreach ( $this->getExpectations() as $expectation ) {

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

        foreach ( $this->getExpectations() as $expectation ) {

            try {

                $expectation->expect( $data, $path );
                return $this;

            } catch ( UnexpectedDataException $e ) {}

        }

        throw new UnexpectedDataException( $data, $this, $path );

    }

    /**
     * @return ExpectationInterface[]
     */
    public function getExpectations(): array {

        return $this->expectations;

    }

    /**
     * @param ExpectationInterface[] $expectations
     *
     * @return $this
     */
    public function setExpectations( array $expectations ) {

        $this->expectations = $expectations;
        return $this;

    }

}
