<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\IndexedArrayExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\IndexedArrayExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\IndexedArrayExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ new \stdClass() ],
            [ [ 0 => 'one', 2 => 'two', 3 => 'three' ] ],
            [ [ 'one' => 'one', 'two' => 'two', 'three' => 'three' ] ],

        ];

    }

    public function testValid() {

        $expectation = new IndexedArrayExpectation();

        $this->assertEquals( $expectation, $expectation->expect( [] ) );
        $this->assertEquals( $expectation, $expectation->expect( [ 'one', 'two', 'three' ] ) );
        $this->assertEquals( $expectation, $expectation->expect( [ 0 => 'one', 1 => 'two', 2 => 'three' ] ) );
        $this->assertEquals( $expectation, $expectation->expect( [ 0 => 'one', 2 => 'two', 1 => 'three' ] ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new IndexedArrayExpectation() )->expect( $value );

    }

}
