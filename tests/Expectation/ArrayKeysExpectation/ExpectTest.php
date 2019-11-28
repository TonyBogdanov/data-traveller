<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\ArrayKeysExpectation;

use DataTraveller\Expectation\ArrayKeysExpectation;
use DataTraveller\Expectation\EnumExpectation;
use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\IntegerExpectation;
use DataTraveller\Expectation\ListExpectation;
use DataTraveller\Expectation\StringExpectation;
use DataTraveller\Expectation\ValueExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\ArrayKeysExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ [ new \stdClass() ] ],
            [ [ 1 => 'string' ] ],

        ];

    }

    public function testValid() {

        $stringExpectation = new ArrayKeysExpectation( new ListExpectation( new StringExpectation() ) );

        $this->assertEquals( $stringExpectation, $stringExpectation->expect( [] ) );
        $this->assertEquals( $stringExpectation, $stringExpectation->expect( [ 'key1' => 1, 'key2' => 'string' ] ) );

        $integerExpectation = new ArrayKeysExpectation( new ListExpectation( new IntegerExpectation() ) );

        $this->assertEquals( $integerExpectation, $integerExpectation->expect( [] ) );
        $this->assertEquals( $integerExpectation, $integerExpectation->expect( [ 'one', 'two', 5 => 'three' ] ) );

        $enumExpectation = new ArrayKeysExpectation( new ListExpectation( new EnumExpectation( [ 'a', 'b', 'c' ] ) ) );

        $this->assertEquals( $enumExpectation, $enumExpectation->expect( [] ) );
        $this->assertEquals( $enumExpectation, $enumExpectation->expect( [ 'a' => 'this is a', 'c' => 'this is c' ] ) );

        $valueExpectation = new ArrayKeysExpectation( new ValueExpectation( [ 'foo', 'bar' ] ) );
        $this->assertEquals( $valueExpectation, $valueExpectation->expect( [ 'foo' => 'hello', 'bar' => 'world' ] ) );

        $sortedExpectation = new ArrayKeysExpectation( new ValueExpectation( [ 'a', 'b', 'c' ] ), true );
        $this->assertEquals( $sortedExpectation, $sortedExpectation->expect( [ 'b' => 'b', 'c' => 'c', 'a' => 'a' ] ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new ArrayKeysExpectation( new ListExpectation( new StringExpectation() ) ) )->expect( $value );

    }

}
