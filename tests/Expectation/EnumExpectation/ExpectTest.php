<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\EnumExpectation;

use DataTraveller\Expectation\EnumExpectation;
use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\EnumExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ false ],
            [ 124 ],
            [ [] ],
            [ 'hell' ],

        ];

    }

    public function testValid() {

        $expectation = new EnumExpectation( [ true, 123, null, 'hello' ] );

        $this->assertSame( $expectation, $expectation->expect( true ) );
        $this->assertSame( $expectation, $expectation->expect( 123 ) );
        $this->assertSame( $expectation, $expectation->expect( null ) );
        $this->assertSame( $expectation, $expectation->expect( 'hello' ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new EnumExpectation( [ true, 123, null, 'hello' ] ) )->expect( $value );

    }

}
