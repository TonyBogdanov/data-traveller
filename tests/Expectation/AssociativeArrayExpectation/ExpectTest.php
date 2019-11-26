<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\AssociativeArrayExpectation;

use DataTraveller\Expectation\AssociativeArrayExpectation;
use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\AssociativeArrayExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ [ new \stdClass() ] ],
            [ [ 'one', 'two', 'three' ] ],
            [ [ 0 => 'one', 1 => 'two', 2 => 'three' ] ],
            [ [ 0 => 'one', 2 => 'two', 1 => 'three' ] ],

        ];

    }

    public function testValid() {

        $expectation = new AssociativeArrayExpectation();

        $this->assertEquals( $expectation, $expectation->expect( [] ) );
        $this->assertEquals( $expectation, $expectation->expect( [ 0 => 'one', 2 => 'two', 3 => 'three' ] ) );
        $this->assertEquals( $expectation, $expectation->expect( [ 'one' => 'one', 'two' => 'two', 'three' => 'three' ] ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new AssociativeArrayExpectation() )->expect( $value );

    }

}
