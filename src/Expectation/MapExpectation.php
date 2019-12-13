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
use DataTraveller\Path\Step\LiteralStep;

/**
 * Class MapExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class MapExpectation implements ExpectationInterface {

    use IndentTrait;

    /**
     * @var ExpectationInterface[]
     */
    protected $expectations;

    /**
     * MapExpectation constructor.
     *
     * @param ExpectationInterface[] $expectations
     */
    public function __construct( array $expectations ) {

        ksort( $expectations );
        $this->setExpectations( $expectations );

    }

    /**
     * @return string
     */
    public function getType(): string {

        $result = "map {\n";

        foreach ( $this->getExpectations() as $key => $expectation ) {

            $result .= $this->indent( $key . ' = ' . $expectation->getType() . ";\n" );

        }

        return $result . '}';

    }

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        $keys = array_keys( $data );
        sort( $keys );

        foreach ( $this->getExpectations() as $key => $expectation ) {

            try {

                $expectation->expect(

                    $data[ $key ],
                    $path ? ( clone $path )->push( new LiteralStep( $key ) ) : null

                );

            } catch ( UnexpectedDataException $e ) {

                throw new UnexpectedDataException( $data, $this, $path, $e );

            }

        }

        return $this;

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
