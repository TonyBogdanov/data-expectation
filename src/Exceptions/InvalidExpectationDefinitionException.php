<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataExpectation\Exceptions;

/**
 * Class InvalidExpectationDefinitionException
 *
 * @package DataExpectation\Exceptions
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class InvalidExpectationDefinitionException extends \Exception {

    /**
     * InvalidExpectationDefinitionException constructor.
     *
     * @param $definition
     */
    public function __construct( $definition ) {

        parent::__construct( sprintf(

            'Invalid expectation definition: %1$s.',
            is_object( $definition ) ? get_class( $definition ) : gettype( $definition )

        ) );

    }

}
