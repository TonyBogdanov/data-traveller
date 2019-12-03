<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\ValueExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\ValueExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\ValueExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ new \stdClass() ],
            [ 'string' ],
            [ 123.456 ],
            [ null ],
            [ [ 1, false, 'two' ] ],

        ];

    }

    public function testValid() {

        $stringExpectation = new ValueExpectation( 'hello' );
        $this->assertEquals( $stringExpectation, $stringExpectation->expect( 'hello' ) );

        $integerExpectation = new ValueExpectation( 123 );
        $this->assertEquals( $integerExpectation, $integerExpectation->expect( 123 ) );

        $arrayExpectation = new ValueExpectation( [ 1, 'two', false ] );
        $this->assertEquals( $arrayExpectation, $arrayExpectation->expect( [ 1, 'two', false ] ) );

        $largeData = explode( ' ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor' .
            ' incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation' .
            ' ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit' .
            ' in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat' .
            ' non proident, sunt in culpa qui officia deserunt mollit anim id est laborum' );

        $largeExpectation = new ValueExpectation( $largeData );
        $this->assertEquals( $largeExpectation, $largeExpectation->expect( $largeData ) );

    }

    public function testINF() {

        $expectation = new ValueExpectation( INF );
        $this->assertSame( $expectation, $expectation->expect( INF ) );

    }

    public function testClosure() {

        $expectation = new ValueExpectation( $closure = function () {} );
        $this->assertSame( $expectation, $expectation->expect( $closure ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new ValueExpectation( explode( ' ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do' .
            ' eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud' .
            ' exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in' .
            ' reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat' .
            ' cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum' ) ) )
            ->expect( $value );

    }

    public function testInvalidINF() {

        $this->expectException( UnexpectedDataException::class );

        $expectation = new ValueExpectation( INF );
        $this->assertSame( $expectation, $expectation->expect( 123 ) );

    }

    public function testInvalidClosure() {

        $this->expectException( UnexpectedDataException::class );

        $expectation = new ValueExpectation( function () {} );
        $this->assertSame( $expectation, $expectation->expect( function () {} ) );

    }

}
