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
use DataTraveller\Path\Step\RegexStep;
use PHPUnit\Framework\TestCase;

/**
 * Class GetSetStepsTest
 *
 * @package Tests\DataTraveller\Path\Path
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class GetSetStepsTest extends TestCase {

    public function testEmptyPath() {

        $path = Path::parse( '' );
        $steps = $path->getSteps();

        $this->assertCount( 0, $steps );

        $path->setSteps( [ new LiteralStep( 'foo' ) ] );
        $steps = $path->getSteps();

        $this->assertCount( 1, $steps );

        $this->assertInstanceOf( LiteralStep::class, $steps[0] );
        $this->assertEquals( 'foo', (string) $steps[0] );

    }

    public function testValid() {

        $path = Path::parse( 'foo./bar/.baz' );
        $steps = $path->getSteps();

        $this->assertCount( 3, $steps );

        $this->assertInstanceOf( LiteralStep::class, $steps[0] );
        $this->assertEquals( 'foo', (string) $steps[0] );

        $this->assertInstanceOf( RegexStep::class, $steps[1] );
        $this->assertEquals( '/bar/', (string) $steps[1] );

        $this->assertInstanceOf( LiteralStep::class, $steps[2] );
        $this->assertEquals( 'baz', (string) $steps[2] );

    }

}
