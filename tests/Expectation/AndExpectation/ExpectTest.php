<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Expectation\AndExpectation;

use DataTraveller\Expectation\AndExpectation;
use DataTraveller\Expectation\EmptyExpectation;
use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\NotExpectation;
use DataTraveller\Expectation\StringExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataTraveller\Expectation\AndExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ '' ],
            [ null ],
            [ 0 ],

        ];

    }

    public function testValid() {

        $nonEmptyStringExpectation = new AndExpectation(

            new NotExpectation( new EmptyExpectation() ),
            new StringExpectation()

        );

        $emptyStringExpectation = new AndExpectation(

            new EmptyExpectation(),
            new StringExpectation()

        );

        $this->assertEquals( $nonEmptyStringExpectation, $nonEmptyStringExpectation->expect( 'string' ) );
        $this->assertEquals( $emptyStringExpectation, $emptyStringExpectation->expect( '' ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new AndExpectation(

            new NotExpectation( new EmptyExpectation() ),
            new StringExpectation()

        ) )->expect( $value );

    }

}
