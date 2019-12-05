<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller\Path;

use DataTraveller\Path\Step\LiteralStep;
use DataTraveller\Path\Step\RegexStep;
use DataTraveller\Path\Step\StepInterface;
use Nette\Tokenizer\Exception;
use Nette\Tokenizer\Stream;
use Nette\Tokenizer\Tokenizer;

/**
 * Class Parser
 *
 * @package DataTraveller\Path
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class Parser {

    const T_DOT     = 1;
    const T_REGEX   = 2;
    const T_LITERAL = 3;

    /**
     * @var Tokenizer
     */
    protected $tokenizer;

    /**
     * @param Stream $stream
     *
     * @return StepInterface
     * @throws Exception
     */
    protected function parseStep( Stream $stream ): StepInterface {

        $token = $stream->consumeToken( static::T_REGEX, static::T_LITERAL );

        return static::T_LITERAL === $token->type ?
            new LiteralStep( str_replace( '\\.', '.', $token->value ) ) :
            new RegexStep( $token->value );

    }

    /**
     * Parser constructor.
     *
     * @param bool $disableRegex
     */
    public function __construct( bool $disableRegex = false ) {

        $tokens = [

            static::T_DOT => '\.',

        ];

        if ( ! $disableRegex ) {

            $tokens[ static::T_REGEX ] = '\/[^\/\\\\]*(?:\\\\.[^\/\\\\]*)*\/[a-z]*';

        }

        $tokens[ static::T_LITERAL ] = '[^\.\\\\]*(?:\\\\.[^\.\\\\]*)*';

        $this->tokenizer = new Tokenizer( $tokens );

    }

    /**
     * @param string $value
     *
     * @return StepInterface[]
     * @throws Exception
     */
    public function parse( string $value ): array {

        $stream = $this->tokenizer->tokenize( $value );
        $steps = [];

        while ( ! $stream->isNext( null ) ) {

            $steps[] = $this->parseStep( $stream );
            if ( $stream->isNext( null ) ) {

                break;

            }

            $stream->consumeToken( static::T_DOT );
            if ( $stream->isNext( null ) ) {

                throw new Exception( 'Unexpected end of string' );

            }

        }

        return $steps;

    }

}
