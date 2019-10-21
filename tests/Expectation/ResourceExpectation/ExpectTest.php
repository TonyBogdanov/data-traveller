<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\ResourceExpectation;

use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\ResourceExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\ResourceExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new ResourceExpectation();
        $resource = imagecreate( 1, 1 );

        $this->assertEquals( $expectation, $expectation->expect( $resource ) );

        imagedestroy( $resource );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new ResourceExpectation() )->expect( 'string' );

    }

}
