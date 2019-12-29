<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;

/**
 * Class BooleanExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class BooleanExpectation implements ExpectationInterface {

    /**
     * @return string
     */
    public function getType(): string {

        return 'boolean';

    }

    /**
     * @param $data
     * @param string|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, string $path = null ) {

        if ( ! is_bool( $data ) ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

}
