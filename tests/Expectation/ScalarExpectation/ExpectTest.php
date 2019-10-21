<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\ScalarExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\ScalarExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\ScalarExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new ScalarExpectation();

        $this->assertEquals( $expectation, $expectation->expect( 1 ) );
        $this->assertEquals( $expectation, $expectation->expect( 1.1 ) );
        $this->assertEquals( $expectation, $expectation->expect( 'string' ) );
        $this->assertEquals( $expectation, $expectation->expect( true ) );

    }

    public function testInvalidArray() {

        $this->expectException( UnexpectedDataException::class );

        ( new ScalarExpectation() )->expect( [] );

    }

    public function testInvalidObject() {

        $this->expectException( UnexpectedDataException::class );

        ( new ScalarExpectation() )->expect( new \stdClass() );

    }

    public function testInvalidResource() {

        $this->expectException( UnexpectedDataException::class );

        $resource = imagecreate( 1, 1 );

        ( new ScalarExpectation() )->expect( $resource );

        imagedestroy( $resource );

    }

}
