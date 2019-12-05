<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Path\Step\RegexStep;

use DataTraveller\Path\Step\RegexStep;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Path\Step\RegexStep
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function test() {

        $step = new RegexStep( '/^t.st$/i' );

        $this->assertTrue( $step->expect( 'test' ) );
        $this->assertTrue( $step->expect( 'tost' ) );
        $this->assertTrue( $step->expect( 'tOst' ) );

        $this->assertFalse( $step->expect( 'teeest' ) );
        $this->assertFalse( $step->expect( 'toast' ) );

        $this->assertFalse( $step->expect( '1' ) );
        $this->assertFalse( $step->expect( 1 ) );

    }

}
