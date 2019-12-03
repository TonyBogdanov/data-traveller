<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\ClassExistsExpectation;

use DataTraveller\Expectation\ClassExistsExpectation;
use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\ClassExistsExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new ClassExistsExpectation();

        $this->assertSame( $expectation, $expectation->expect( static::class ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new ClassExistsExpectation() )->expect( static::class . '_' );

    }

}
