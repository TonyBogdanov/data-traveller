<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller\Path;

use DataTraveller\Expectation\ArrayExpectation;
use DataTraveller\Expectation\Exceptions\MissingDataException;
use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Path\Exceptions\InvalidPathException;
use DataTraveller\Path\Step\LiteralStep;
use DataTraveller\Path\Step\StepInterface;
use Nette\Tokenizer\Exception;

/**
 * Class Path
 *
 * @package DataTraveller\Path
 * @author TonyBogdanov <tonybogdanov@gmail.com>
 */
class Path implements \Countable {

    /**
     * @var StepInterface[]
     */
    protected $steps;

    /**
     * @var ArrayExpectation
     */
    protected $arrayExpectation;

    /**
     * @param string $value
     * @param bool $disableRegex
     *
     * @return Path
     * @throws InvalidPathException
     */
    public static function parse( string $value, bool $disableRegex = false ): Path {

        try {

            return new static( ( new Parser( $disableRegex ) )->parse( $value ) );

        } catch ( Exception $e ) {

            throw new InvalidPathException( sprintf( 'Invalid path: %s', $value ), 0, $e );

        }

    }

    /**
     * Path constructor.
     *
     * @param StepInterface[] $steps
     */
    public function __construct( array $steps = [] ) {

        $this->steps = $steps;
        $this->arrayExpectation = new ArrayExpectation();

    }

    /**
     * @return string
     */
    public function __toString(): string {

        return implode( '.', array_map( function ( StepInterface $step ) {

            return $step instanceof LiteralStep ? str_replace( '.', '\\.', $step ) : $step;

        }, $this->steps ) );

    }

    public function __clone() {

        $this->steps = array_map( function ( StepInterface $step ) {

            return clone $step;

        }, $this->steps );

        $this->arrayExpectation = clone $this->arrayExpectation;

    }

    /**
     * @return int
     */
    public function count(): int {

        return count( $this->steps );

    }

    /**
     * @param $data
     * @param Path|null $trail
     *
     * @return mixed
     * @throws MissingDataException
     * @throws UnexpectedDataException
     */
    public function get( $data, Path $trail = null ) {

        if ( 0 === count( $this->steps ) ) {

            return $data;

        }

        if ( ! isset( $trail ) ) {

            $trail = new static();

        }

        $this->arrayExpectation->expect( $data, $trail );

        $step = $this->steps[0];
        $trail->push( $step );

        foreach ( $data as $key => $value ) {

            if ( $step->expect( $key ) ) {

                return ( new Path( array_slice( $this->steps, 1 ) ) )->get( $value, $trail );

            }

        }

        throw new MissingDataException( $trail );

    }

    /**
     * @param StepInterface $step
     *
     * @return Path
     */
    public function push( StepInterface $step ): Path {

        $this->steps[] = $step;
        return $this;

    }

    /**
     * @return StepInterface[]
     */
    public function getSteps(): array {

        return $this->steps;

    }

    /**
     * @param StepInterface[] $steps
     *
     * @return $this
     */
    public function setSteps( array $steps ) {

        $this->steps = $steps;
        return $this;

    }

    /**
     * @return ArrayExpectation
     */
    public function getArrayExpectation(): ArrayExpectation {

        return $this->arrayExpectation;

    }

    /**
     * @param ArrayExpectation $arrayExpectation
     *
     * @return $this
     */
    public function setArrayExpectation( ArrayExpectation $arrayExpectation ) {

        $this->arrayExpectation = $arrayExpectation;
        return $this;

    }

}
