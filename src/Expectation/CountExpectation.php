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
 * Class CountExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class CountExpectation implements ExpectationInterface {

    use IndentTrait;

    /**
     * @var ExpectationInterface
     */
    protected $expectation;

    /**
     * CountExpectation constructor.
     *
     * @param ExpectationInterface $expectation
     */
    public function __construct( ExpectationInterface $expectation ) {

        $this->expectation = $expectation;

    }

    /**
     * @return string
     */
    public function getType(): string {

        return
            "count (\n" .
            $this->indent( $this->expectation->getType() ) . "\n" .
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

            $this->expectation->expect( count( $data ), $path );

        } catch ( UnexpectedDataException $e ) {

            throw new UnexpectedDataException( $data, $this, $path, $e );

        }

        return $this;

    }

}
