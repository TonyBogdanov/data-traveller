<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\GreaterThanOrEqualExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\GreaterThanOrEqualExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\GreaterThanOrEqualExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ 122 ],
            [ 0 ],
            [ -123 ],
            [ 122.45 ],
            [ -123.45 ],

        ];

    }

    public function testValid() {

        $expectation = new GreaterThanOrEqualExpectation( 123 );

        $this->assertSame( $expectation, $expectation->expect( 123 ) );
        $this->assertSame( $expectation, $expectation->expect( 124 ) );
        $this->assertSame( $expectation, $expectation->expect( 999 ) );

        $expectation = new GreaterThanOrEqualExpectation( 123.45 );

        $this->assertSame( $expectation, $expectation->expect( 123.45 ) );
        $this->assertSame( $expectation, $expectation->expect( 123.46 ) );
        $this->assertSame( $expectation, $expectation->expect( 999.99 ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new GreaterThanOrEqualExpectation( 123 ) )->expect( $value );

    }

}
