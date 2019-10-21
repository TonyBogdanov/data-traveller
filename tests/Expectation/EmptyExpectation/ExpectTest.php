<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\EmptyExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\EmptyExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\EmptyExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new EmptyExpectation();

        $this->assertEquals( $expectation, $expectation->expect( '' ) );
        $this->assertEquals( $expectation, $expectation->expect( 0 ) );
        $this->assertEquals( $expectation, $expectation->expect( 0.0 ) );
        $this->assertEquals( $expectation, $expectation->expect( '0' ) );
        $this->assertEquals( $expectation, $expectation->expect( null ) );
        $this->assertEquals( $expectation, $expectation->expect( false ) );
        $this->assertEquals( $expectation, $expectation->expect( [] ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new EmptyExpectation() )->expect( 'string' );

    }

}
