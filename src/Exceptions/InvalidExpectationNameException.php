<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataExpectation\Exceptions;

/**
 * Class InvalidExpectationNameException
 *
 * @package DataExpectation\Exceptions
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class InvalidExpectationNameException extends \Exception {

    /**
     * InvalidExpectationNameException constructor.
     *
     * @param string $name
     */
    public function __construct( string $name ) {

        parent::__construct( sprintf( 'Invalid or unsupported expectation name: %1$s.', $name ) );

    }

}
