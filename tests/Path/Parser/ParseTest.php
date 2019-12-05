<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataTraveller\Path\Parser;

use DataTraveller\Path\Parser;
use DataTraveller\Path\Step\LiteralStep;
use DataTraveller\Path\Step\RegexStep;
use Nette\Tokenizer\Exception;
use PHPUnit\Framework\TestCase;

/**
 * Class ParseTest
 *
 * @package Tests\DataTraveller\Path\Parser
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ParseTest extends TestCase {

    public function getValidPath(): string {

        return 'literal.literal\.escape./regex/./^mod.f\/ier$/i';

    }

    public function getInvalidPaths(): array {

        return [

            [ '.' ],
            [ '.literal' ],
            [ 'literal.' ],
            [ 'lite..ral' ],

        ];

    }

    public function getExpected(): array {

        return [

            new LiteralStep( 'literal' ),
            new LiteralStep( 'literal.escape' ),
            new RegexStep( '/regex/' ),
            new RegexStep( '/^mod.f\/ier$/i' ),

        ];

    }

    public function verify( $steps, array $expected ) {

        $this->assertIsArray( $steps );
        $this->assertCount( count( $expected ), $steps );

        foreach ( $steps as $index => $step ) {

            $this->assertInstanceOf( get_class( $expected[ $index ] ), $step );
            $this->assertEquals( $expected[ $index ], $step );

        }

    }

    public function testEmpty() {

        $parser = new Parser();

        $this->verify( $parser->parse( '' ), [] );

    }

    public function testValid() {

        $parser = new Parser();

        $this->verify( $parser->parse( $this->getValidPath() ), $this->getExpected() );

    }

    /**
     * @param string $path
     *
     * @throws Exception
     *
     * @dataProvider getInvalidPaths
     */
    public function testInvalid( string $path ) {

        $this->expectException( Exception::class );

        ( new Parser() )->parse( $path );

    }

}
