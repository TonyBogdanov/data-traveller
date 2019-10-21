<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\ClosureExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\ClosureExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\ClosureExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new ClosureExpectation();

        $this->assertEquals( $expectation, $expectation->expect( function () {} ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new ClosureExpectation() )->expect( 'string' );

    }

    public function testInvalidCallable() {

        $this->expectException( UnexpectedDataException::class );

        ( new ClosureExpectation() )->expect( [ $this, 'testValid' ] );

    }

}
