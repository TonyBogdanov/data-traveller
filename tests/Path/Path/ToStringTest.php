<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Path\Path;

use DataTraveller\Path\Path;

/**
 * Class ToStringTest
 *
 * @package Tests\DataTraveller\Path\Path
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ToStringTest extends \Tests\DataTraveller\Path\Parser\ParseTest {

    public function test() {

        $path = Path::parse( $this->getValidPath() );

        $this->assertEquals( $this->getValidPath(), (string) $path );

    }

}
