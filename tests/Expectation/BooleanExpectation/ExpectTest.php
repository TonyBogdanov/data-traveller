<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\BooleanExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\BooleanExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\BooleanExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new BooleanExpectation();

        $this->assertEquals( $expectation, $expectation->expect( true ) );
        $this->assertEquals( $expectation, $expectation->expect( false ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new BooleanExpectation() )->expect( 'string' );

    }

}
