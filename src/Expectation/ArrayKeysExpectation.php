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
 * Class ArrayKeysExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ArrayKeysExpectation extends ArrayExpectation {

    /**
     * @var ExpectationInterface
     */
    protected $expectation;

    /**
     * ArrayKeysExpectation constructor.
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

        return 'arrayKeys<' . $this->expectation->getType() . '>';

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

            $this->expectation->expect( array_keys( $data ), $path );

        } catch ( UnexpectedDataException $e ) {

            throw new UnexpectedDataException( $data, $this->getType(), $path, $e );

        }

        return $this;

    }

}
