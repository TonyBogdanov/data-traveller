<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Path\Path;

use DataTraveller\Path\Path;

/**
 * Class CloneTest
 *
 * @package Tests\DataTraveller\Path\Path
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class CloneTest extends \Tests\DataTraveller\Path\Parser\ParseTest {

    public function test() {

        $original = Path::parse( $this->getValidPath() );
        $cloned = clone $original;

        $this->assertNotSame( $original, $cloned );

        $originalReflection = new \ReflectionClass( $original );
        $clonedReflection = new \ReflectionClass( $cloned );

        $originalStepsProperty = $originalReflection->getProperty( 'steps' );
        $originalStepsProperty->setAccessible( true );

        $clonedStepsProperty = $clonedReflection->getProperty( 'steps' );
        $clonedStepsProperty->setAccessible( true );

        $originalSteps = $originalStepsProperty->getValue( $original );
        $clonedSteps = $clonedStepsProperty->getValue( $cloned );

        $this->assertNotSame( $originalSteps, $clonedSteps );

        $originalArrayExpectationProperty = $originalReflection->getProperty( 'arrayExpectation' );
        $originalArrayExpectationProperty->setAccessible( true );

        $clonedArrayExpectationProperty = $clonedReflection->getProperty( 'arrayExpectation' );
        $clonedArrayExpectationProperty->setAccessible( true );

        $originalArrayExpectation = $originalArrayExpectationProperty->getValue( $original );
        $clonedArrayExpectation = $clonedArrayExpectationProperty->getValue( $cloned );

        $this->assertNotSame( $originalArrayExpectation, $clonedArrayExpectation );

    }

}
