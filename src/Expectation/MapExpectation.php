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
use DataTraveller\Path\Step\LiteralStep;

/**
 * Class MapExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class MapExpectation extends AssociativeArrayExpectation {

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
        $this->expectations = $expectations;

    }

    /**
     * @return string
     */
    public function getType(): string {

        return 'map<' .
            implode( ',', array_map( function ( string $key, ExpectationInterface $expectation ) {

                return $key . '=' . $expectation->getType();

            }, array_keys( $this->expectations ), array_values( $this->expectations ) ) ) .
            '>';

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

        if ( count( $data ) !== count( $this->expectations ) ) {

            throw new UnexpectedDataException( $data, $this->getType(), $path );

        }

        $keys = array_keys( $data );
        sort( $keys );

        if ( array_keys( $this->expectations ) !== $keys ) {

            throw new UnexpectedDataException( $data, $this->getType(), $path );

        }

        foreach ( $data as $key => $item ) {

            try {

                $this->expectations[ $key ]->expect(

                    $item,
                    $path ? ( clone $path )->push( new LiteralStep( $key ) ) : null

                );

            } catch ( UnexpectedDataException $e ) {

                throw new UnexpectedDataException( $data, $this->getType(), $path, $e );

            }

        }

        return $this;

    }

}
