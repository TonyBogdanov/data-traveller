<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\IterableExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\IterableExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\IterableExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new IterableExpectation();
        $iterable = new class implements \IteratorAggregate {

            public function getIterator() {

                return new \ArrayIterator( [] );

            }

        };

        $this->assertSame( $expectation, $expectation->expect( [] ) );
        $this->assertSame( $expectation, $expectation->expect( $iterable ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new IterableExpectation() )->expect( 'string' );

    }

    public function testInvalidObject() {

        $this->expectException( UnexpectedDataException::class );

        ( new IterableExpectation() )->expect( new \stdClass() );

    }

}
