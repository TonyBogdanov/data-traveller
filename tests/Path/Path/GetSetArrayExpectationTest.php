<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Path\Path;

use DataTraveller\Expectation\ArrayExpectation;
use DataTraveller\Path\Path;
use PHPUnit\Framework\TestCase;

/**
 * Class GetSetArrayExpectationTest
 *
 * @package Tests\DataTraveller\Path\Path
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class GetSetArrayExpectationTest extends TestCase {

    public function testGet() {

        $path = Path::parse( '' );
        $expectation = $path->getArrayExpectation();

        $this->assertInstanceOf( ArrayExpectation::class, $expectation );

    }

    public function testSet() {

        $path = Path::parse( '' );

        $newExpectation = new ArrayExpectation();
        $path->setArrayExpectation( $newExpectation );

        $expectation = $path->getArrayExpectation();

        $this->assertInstanceOf( ArrayExpectation::class, $expectation );
        $this->assertSame( $newExpectation, $expectation );

    }

}
