<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\FunctionExistsExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\FunctionExistsExpectation;
use DataTraveller\Expectation\ObjectExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\FunctionExistsExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new FunctionExistsExpectation();

        $this->assertSame( $expectation, $expectation->expect( 'substr' ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new FunctionExistsExpectation() )->expect( 'substr_' );

    }

}
