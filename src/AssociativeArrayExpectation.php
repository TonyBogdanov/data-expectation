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
 * Class AssociativeArrayExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class AssociativeArrayExpectation extends AbstractExpectation {

    /**
     * @return string
     */
    public function getType(): string {

        return 'associativeArray';

    }

    /**
     * @param $data
     * @param string|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, string $path = null ) {

        if ( ! is_array( $data ) ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        $count = count( $data );
        if ( 0 === $count ) {

            return $this;

        }

        $keys = array_keys( $data );
        sort( $keys );

        if ( range( 0, $count - 1 ) === $keys ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

}
