<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\CountableExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\CountableExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\CountableExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new CountableExpectation();
        $countable = new class implements \Countable {

            public function count() {

                return 0;

            }

        };

        $this->assertSame( $expectation, $expectation->expect( [] ) );
        $this->assertSame( $expectation, $expectation->expect( $countable ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new CountableExpectation() )->expect( 'string' );

    }

    public function testInvalidObject() {

        $this->expectException( UnexpectedDataException::class );

        ( new CountableExpectation() )->expect( new \stdClass() );

    }

}
