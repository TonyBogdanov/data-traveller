<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\RegexMatchExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\RegexMatchExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\RegexMatchExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function provider(): array {

        return [

            [ 'hello' ],
            [ 123.45 ],
            [ null ],
            [ [] ],
            [ new \stdClass() ],

        ];

    }

    public function testValidIP() {

        $expectation = new RegexMatchExpectation(

            '/^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/'

        );

        $this->assertSame( $expectation, $expectation->expect( '127.0.0.1' ) );

    }

    public function testValidNumber() {

        $expectation = new RegexMatchExpectation( '/^\d+$/' );

        $this->assertSame( $expectation, $expectation->expect( '123' ) );

    }

    /**
     * @dataProvider provider
     */
    public function testInvalid( $data ) {

        $this->expectException( UnexpectedDataException::class );

        ( new RegexMatchExpectation( '/^\d+$/' ) )->expect( $data );

    }

}
