<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataTraveller\Expectation\Traits;

/**
 * Trait IndentTrait
 *
 * @package DataTraveller\Expectation\Traits
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
trait IndentTrait {

    /**
     * @param string $data
     *
     * @return string
     */
    protected function indent( string $data ): string {

        return preg_replace( '/^(.*)$/m', '    $1', $data );

    }

}