<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\NumericExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\NumericExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\NumericExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new NumericExpectation();

        $this->assertSame( $expectation, $expectation->expect( 1 ) );
        $this->assertSame( $expectation, $expectation->expect( 1.1 ) );
        $this->assertSame( $expectation, $expectation->expect( '1.23' ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new NumericExpectation() )->expect( 'string' );

    }

}
