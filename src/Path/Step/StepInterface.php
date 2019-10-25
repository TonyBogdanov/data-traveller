<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace DataTraveller\Path\Step;

/**
 * Interface StepInterface
 *
 * @package DataTraveller\Path\Step
 * @author TonyBogdanov <tonybogdanov@gmail.com>
 */
interface StepInterface {

    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * @param string $key
     *
     * @return bool
     */
    public function expect( string $key ): bool;

}
