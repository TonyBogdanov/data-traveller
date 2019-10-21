<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Path\Path;

use DataTraveller\Path\Exceptions\InvalidPathException;
use DataTraveller\Path\Path;

/**
 * Class ParseTest
 *
 * @package Tests\DataTraveller\Path\Path
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ParseTest extends \Tests\DataTraveller\Path\Parser\ParseTest {

    public function testValid() {

        $path = Path::parse( $this->getValidPath() );

        $reflection = new \ReflectionProperty( $path, 'steps' );
        $reflection->setAccessible( true );

        $this->verify( $reflection->getValue( $path ), $this->getExpected() );

    }

    /**
     * @param string $path
     *
     * @throws InvalidPathException
     *
     * @dataProvider getInvalidPaths
     */
    public function testInvalid( string $path ) {

        $this->expectException( InvalidPathException::class );

        Path::parse( $path );

    }

}
