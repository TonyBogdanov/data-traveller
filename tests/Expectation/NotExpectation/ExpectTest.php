<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\NotExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\IntegerExpectation;
use DataTraveller\Expectation\NotExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\NotExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new NotExpectation( new IntegerExpectation() );

        $this->assertEquals( $expectation, $expectation->expect( 1.1 ) );
        $this->assertEquals( $expectation, $expectation->expect( 'string' ) );
        $this->assertEquals( $expectation, $expectation->expect( true ) );
        $this->assertEquals( $expectation, $expectation->expect( [] ) );
        $this->assertEquals( $expectation, $expectation->expect( imagecreate( 1, 1 ) ) );
        $this->assertEquals( $expectation, $expectation->expect( new \stdClass() ) );
        $this->assertEquals( $expectation, $expectation->expect( function () {} ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new NotExpectation( new IntegerExpectation() ) )->expect( 1 );

    }

}
