<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\ListExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\IntegerExpectation;
use DataTraveller\Expectation\ListExpectation;
use DataTraveller\Expectation\StringExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\ListExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ [ new \stdClass() ] ],
            [ [ 'string' ] ],
            [ [ 123.456 ] ],
            [ [ null ] ],
            [ [ [] ] ],

        ];

    }

    public function testValid() {

        $expectation = new ListExpectation( new StringExpectation() );

        $this->assertSame( $expectation, $expectation->expect( [] ) );
        $this->assertSame( $expectation, $expectation->expect( [ 'string', 'another string' ] ) );

    }

    public function testValidCompound() {

        $expectation = new ListExpectation( new ListExpectation( new StringExpectation() ) );

        $this->assertSame( $expectation, $expectation->expect( [] ) );
        $this->assertSame( $expectation, $expectation->expect( [ [ 'string', ], [ 'another string' ] ] ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new ListExpectation( new IntegerExpectation() ) )->expect( $value );

    }

}
