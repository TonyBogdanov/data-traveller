<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Path\Path;

use DataTraveller\Expectation\Exceptions\MissingDataException;
use DataTraveller\Path\Path;
use PHPUnit\Framework\TestCase;

/**
 * Class GetTest
 *
 * @package Tests\DataTraveller\Path\Path
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class GetTest extends TestCase {

    public function testEmptyPath() {

        $path = Path::parse( '' );
        $data = [ 'foo' => 'bar' ];

        $this->assertEquals( $data, $path->get( $data ) );

    }

    public function testEmptyTrail() {

        $path = Path::parse( 'foo' );
        $data = [ 'foo' => 'bar' ];

        $this->assertEquals( 'bar', $path->get( $data ) );

    }

    public function testWithTrail() {

        $this->expectException( MissingDataException::class );

        $path = Path::parse( 'foo2' );
        $data = [ 'foo' => 'bar' ];

        $path->get( $data );

    }

}
