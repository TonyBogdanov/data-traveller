<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\RegexPatternExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\RegexPatternExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\RegexPatternExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new RegexPatternExpectation();

        $this->assertSame( $expectation, $expectation->expect( '/^\d+$/' ) );

    }

    public function testInvalidDelimiter() {

        $this->expectException( UnexpectedDataException::class );

        ( new RegexPatternExpectation() )->expect( '/^\d+$' );

    }

}
