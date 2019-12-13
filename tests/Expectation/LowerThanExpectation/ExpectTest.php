<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\LowerThanExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\LowerThanExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\LowerThanExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ 123 ],
            [ 124 ],
            [ 123.45 ],
            [ 123.46 ],

        ];

    }

    public function testValid() {

        $expectation = new LowerThanExpectation( 123 );

        $this->assertSame( $expectation, $expectation->expect( 121 ) );
        $this->assertSame( $expectation, $expectation->expect( 0 ) );
        $this->assertSame( $expectation, $expectation->expect( -123 ) );

        $expectation = new LowerThanExpectation( 123.45 );

        $this->assertSame( $expectation, $expectation->expect( 123.44 ) );
        $this->assertSame( $expectation, $expectation->expect( 0 ) );
        $this->assertSame( $expectation, $expectation->expect( -123.45 ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new LowerThanExpectation( 123 ) )->expect( $value );

    }

}
