<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Path\Step\RegexStep;

use DataTraveller\Path\Step\RegexStep;
use PHPUnit\Framework\TestCase;

/**
 * Class ToStringTest
 *
 * @package Tests\DataTraveller\Path\Step\RegexStep
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ToStringTest extends TestCase {

    public function test() {

        $step = new RegexStep( '/^t.st$/i' );

        $this->assertEquals( '/^t.st$/i', (string) $step );

    }

}
