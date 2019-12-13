<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller\Expectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Path\Path;
use DataTraveller\Path\Step\LiteralStep;

/**
 * Class ListExpectation
 *
 * @package DataTraveller\Expectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ListExpectation implements ExpectationInterface {

    /**
     * @var ExpectationInterface
     */
    protected $expectation;

    /**
     * ListExpectation constructor.
     *
     * @param ExpectationInterface $expectation
     */
    public function __construct( ExpectationInterface $expectation ) {

        $this->setExpectation( $expectation );

    }

    /**
     * @return string
     */
    public function getType(): string {

        return 'list ( ' . $this->getExpectation()->getType() . ' )';

    }

    /**
     * @param $data
     * @param Path|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, Path $path = null ) {

        foreach ( $data as $key => $item ) {

            try {

                $this->getExpectation()->expect(

                    $item,
                    $path ? ( clone $path )->push( new LiteralStep( $key ) ) : null

                );

            } catch ( UnexpectedDataException $e ) {

                throw new UnexpectedDataException( $data, $this, $path, $e );

            }

        }

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
