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
 * Class ClosureExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ClosureExpectation extends AbstractExpectation {

    /**
     * @return string
     */
    public function getType(): string {

        return \Closure::class;

    }

    /**
     * @param $data
     * @param string|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, string $path = null ) {

        if ( ! is_object( $data ) || ! ( $data instanceof \Closure) ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

}
