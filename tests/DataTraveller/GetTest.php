<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\DataTraveller\DataTraveller;

use DataTraveller\DataTraveller;
use DataTraveller\Expectation\ArrayExpectation;
use DataTraveller\Expectation\BooleanExpectation;
use DataTraveller\Expectation\CallableExpectation;
use DataTraveller\Expectation\ClassExpectation;
use DataTraveller\Expectation\ClosureExpectation;
use DataTraveller\Expectation\CountableExpectation;
use DataTraveller\Expectation\Exceptions\MissingDataException;
use DataTraveller\Expectation\Exceptions\UnexpectedDataException;
use DataTraveller\Expectation\FloatExpectation;
use DataTraveller\Expectation\IntegerExpectation;
use DataTraveller\Expectation\IterableExpectation;
use DataTraveller\Expectation\NullExpectation;
use DataTraveller\Expectation\NumericExpectation;
use DataTraveller\Expectation\ObjectExpectation;
use DataTraveller\Expectation\ResourceExpectation;
use DataTraveller\Expectation\ScalarExpectation;
use DataTraveller\Expectation\StringExpectation;
use DataTraveller\Path\Exceptions\InvalidPathException;
use PHPUnit\Framework\TestCase;

/**
 * Class GetTest
 *
 * @package Tests\DataTraveller\DataTraveller
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class GetTest extends TestCase {

    public function getData(): array {

        $resource = imagecreate( 1, 1 );

        return [

            [ NullExpectation::class, null ],
            [ BooleanExpectation::class, true ],
            [ IntegerExpectation::class, 1 ],
            [ FloatExpectation::class, 1.1 ],
            [ NumericExpectation::class, 1 ],
            [ NumericExpectation::class, 1.1 ],
            [ NumericExpectation::class, '1.23' ],
            [ StringExpectation::class, 'string' ],
            [ ScalarExpectation::class, 1 ],
            [ ScalarExpectation::class, 1.1 ],
            [ ScalarExpectation::class, 'string' ],
            [ ScalarExpectation::class, true ],
            [ ArrayExpectation::class, [] ],
            [ ResourceExpectation::class, $resource ],
            [ CallableExpectation::class, function () {} ],
            [ CallableExpectation::class, [ $this, 'getData' ] ],
            [ ClosureExpectation::class, function () {} ],
            [ ClassExpectation::class, new \stdClass(), \stdClass::class ],
            [ ObjectExpectation::class, new \stdClass() ],
            [ CountableExpectation::class, [] ],
            [ CountableExpectation::class, new class implements \Countable {

                public function count() {

                    return 0;

                }

            } ],
            [ IterableExpectation::class, new class implements \IteratorAggregate {

                public function getIterator() {

                    return new \ArrayIterator( [] );

                }

            } ],

        ];

    }

    /**
     * @param string $expectation
     * @param $data
     * @param mixed ...$arguments
     *
     * @throws MissingDataException
     * @throws UnexpectedDataException
     * @throws InvalidPathException
     *
     * @dataProvider getData
     */
    public function testValid( string $expectation, $data, ...$arguments ) {

        $traveller = new DataTraveller();

        $this->assertSame(

            $data,
            $traveller->get(

                'foo.bar',
                [ 'foo' => [ 'bar' => $data ] ],
                new $expectation( ...$arguments )

            )

        );

    }

    public function testMissingDataException() {

        $this->expectException( MissingDataException::class );

        ( new DataTraveller() )->get( 'foo', [] );

    }

    public function testUnexpectedDataException() {

        $this->expectException( UnexpectedDataException::class );

        ( new DataTraveller() )->get( 'foo', [ 'foo' => true ], new StringExpectation() );

    }

    public function testInvalidPathException() {

        $this->expectException( InvalidPathException::class );

        ( new DataTraveller() )->get( '.foo', [] );

    }

}
