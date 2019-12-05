<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\MapExpectation;

use DataTraveller\Expectation\AndExpectation;
use DataTraveller\Expectation\ArrayExpectation;
use DataTraveller\Expectation\BooleanExpectation;
use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\IntegerExpectation;
use DataTraveller\Expectation\ListExpectation;
use DataTraveller\Expectation\MapExpectation;
use DataTraveller\Expectation\StringExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\MapExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ [

                'string' => 123,
                'integer' => 123,
                'array' => [ 'test', 'foo' => 'bar' ],
                'list' => [ true, false ],
                'map' => [

                    'string' => 'string',
                    'integer' => 123,
                    'array' => [ 'test', 'foo' => 'bar' ],
                    'list' => [ true, false ],

                ],

            ] ],
            [ [

                'string' => 'string',
                'integer' => 'string',
                'array' => [ 'test', 'foo' => 'bar' ],
                'list' => [ true, false ],
                'map' => [

                    'string' => 'string',
                    'integer' => 123,
                    'array' => [ 'test', 'foo' => 'bar' ],
                    'list' => [ true, false ],

                ],

            ] ],

            [ [

                'string' => 'string',
                'integer' => 123,
                'array' => 'string',
                'list' => [ true, false ],
                'map' => [

                    'string' => 'string',
                    'integer' => 123,
                    'array' => [ 'test', 'foo' => 'bar' ],
                    'list' => [ true, false ],

                ],

            ] ],

            [ [

                'string' => 'string',
                'integer' => 123,
                'array' => [ 'test', 'foo' => 'bar' ],
                'list' => 'string',
                'map' => [

                    'string' => 'string',
                    'integer' => 123,
                    'array' => [ 'test', 'foo' => 'bar' ],
                    'list' => [ true, false ],

                ],

            ] ],

            [ [

                'string' => 'string',
                'integer' => 123,
                'array' => [ 'test', 'foo' => 'bar' ],
                'list' => [ true, false ],
                'map' => [

                    'string' => 123,
                    'integer' => 123,
                    'array' => [ 'test', 'foo' => 'bar' ],
                    'list' => [ true, false ],

                ],

            ] ],

            [ [

                'string' => 'string',
                'integer' => 123,
                'array' => [ 'test', 'foo' => 'bar' ],
                'list' => [ true, false ],
                'map' => [

                    'string' => 'string',
                    'integer' => 'string',
                    'array' => [ 'test', 'foo' => 'bar' ],
                    'list' => [ true, false ],

                ],

            ] ],

            [ [

                'string' => 'string',
                'integer' => 123,
                'array' => [ 'test', 'foo' => 'bar' ],
                'list' => [ true, false ],
                'map' => [

                    'string' => 'string',
                    'integer' => 123,
                    'array' => 'string',
                    'list' => [ true, false ],

                ],

            ] ],

            [ [

                'string' => 'string',
                'integer' => 123,
                'array' => [ 'test', 'foo' => 'bar' ],
                'list' => [ true, false ],
                'map' => [

                    'string' => 'string',
                    'integer' => 123,
                    'array' => [ 'test', 'foo' => 'bar' ],
                    'list' => 'string',

                ],

            ] ],

        ];

    }

    public function testValid() {

        $expectation = new MapExpectation( [

            'string' => new StringExpectation(),
            'integer' => new IntegerExpectation(),
            'array' => new ArrayExpectation(),
            'list' => new ListExpectation( new BooleanExpectation() ),
            'map' => new MapExpectation( [

                'string' => new StringExpectation(),
                'integer' => new IntegerExpectation(),
                'array' => new ArrayExpectation(),
                'list' => new ListExpectation( new BooleanExpectation() ),

            ] ),

        ] );

        $this->assertSame( $expectation, $expectation->expect( [

            'string' => 'string',
            'integer' => 123,
            'array' => [ 'test', 'foo' => 'bar' ],
            'list' => [ true, false ],
            'map' => [

                'string' => 'string',
                'integer' => 123,
                'array' => [ 'test', 'foo' => 'bar' ],
                'list' => [ true, false ],

            ],

        ] ) );

    }

    public function testValidExtraKeys() {

        $expectation = new MapExpectation( [

            'integer' => new IntegerExpectation(),
            'array' => new ArrayExpectation(),
            'list' => new ListExpectation( new BooleanExpectation() ),
            'map' => new MapExpectation( [

                'integer' => new IntegerExpectation(),
                'array' => new ArrayExpectation(),
                'list' => new ListExpectation( new BooleanExpectation() ),

            ] ),

        ] );

        $this->assertSame( $expectation, $expectation->expect( [

            'string' => 'string',
            'integer' => 123,
            'array' => [ 'test', 'foo' => 'bar' ],
            'list' => [ true, false ],
            'map' => [

                'string' => 'string',
                'integer' => 123,
                'array' => [ 'test', 'foo' => 'bar' ],
                'list' => [ true, false ],

            ],

        ] ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new MapExpectation( [

            'string' => new StringExpectation(),
            'integer' => new IntegerExpectation(),
            'array' => new ArrayExpectation(),
            'list' => new AndExpectation(

                new ArrayExpectation(),
                new ListExpectation( new BooleanExpectation() )

            ),
            'map' => new MapExpectation( [

                'string' => new StringExpectation(),
                'integer' => new IntegerExpectation(),
                'array' => new ArrayExpectation(),
                'list' => new AndExpectation(

                    new ArrayExpectation(),
                    new ListExpectation( new BooleanExpectation() )

                ),

            ] ),

        ] ) )->expect( $value );

    }

}
