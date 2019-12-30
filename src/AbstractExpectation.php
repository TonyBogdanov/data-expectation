<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataExpectation;

/**
 * Class AbstractExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
abstract class AbstractExpectation implements ExpectationInterface {

    /**
     * @return array
     */
    public function jsonSerialize(): array {

        return [

            'expectationName' => array_slice( explode( '\\', static::class ), -1 )[0],
            'expectationArguments' => [],

        ];

    }

}
