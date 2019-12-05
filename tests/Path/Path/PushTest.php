<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Path\Path;

use DataTraveller\Path\Path;
use DataTraveller\Path\Step\LiteralStep;

/**
 * Class PushTest
 *
 * @package Tests\DataTraveller\Path\Path
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class PushTest extends \Tests\DataTraveller\Path\Parser\ParseTest {

    public function test() {

        $path = Path::parse( $this->getValidPath() );
        $pushed = new LiteralStep( 'pushed' );

        $path->push( $pushed );

        $reflection = new \ReflectionProperty( $path, 'steps' );
        $reflection->setAccessible( true );

        $this->verify( $reflection->getValue( $path ), array_merge( $this->getExpected(), [ $pushed ] ) );

    }

}
