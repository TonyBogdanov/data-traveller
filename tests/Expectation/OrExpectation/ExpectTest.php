<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\OrExpectation;

use DataTraveller\Expectation\BooleanExpectation;
use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\IntegerExpectation;
use DataTraveller\Expectation\OrExpectation;
use DataTraveller\Expectation\StringExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\OrExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ 123.456 ],
            [ null ],
            [ [ new \stdClass() ] ],
            [ [ 'one', 'two', 'three' ] ],

        ];

    }

    public function testValid() {

        $expectation = new OrExpectation(

            new BooleanExpectation(),
            new IntegerExpectation(),
            new StringExpectation()

        );

        $this->assertSame( $expectation, $expectation->expect( true ) );
        $this->assertSame( $expectation, $expectation->expect( 123 ) );
        $this->assertSame( $expectation, $expectation->expect( 'string' ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new OrExpectation(

            new BooleanExpectation(),
            new IntegerExpectation(),
            new StringExpectation()

        ) )->expect( $value );

    }

}
