<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\ArrayDiffExpectation;

use DataTraveller\Expectation\ArrayDiffExpectation;
use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\ValueExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\ArrayDiffExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ [ 'a', 'b', 'c' ] ],
            [ 'string' ],

        ];

    }

    public function testValid() {

        $expectation = new ArrayDiffExpectation( [ 'a', 'b' ], new ValueExpectation( [ 'c' ] ) );
        $this->assertSame( $expectation, $expectation->expect( [ 'a', 'b', 'c' ] ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        $expectation = new ArrayDiffExpectation( [ 'a', 'b' ], new ValueExpectation( [ 'c', 'd' ] ) );
        $this->assertSame( $expectation, $expectation->expect( $value ) );

    }

}
