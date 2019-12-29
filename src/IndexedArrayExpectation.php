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
 * Class IndexedArrayExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class IndexedArrayExpectation implements ExpectationInterface {

    /**
     * @return string
     */
    public function getType(): string {

        return 'indexedArray';

    }

    /**
     * @param $data
     * @param string|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, string $path = null ) {

        $count = count( $data );
        if ( 0 === $count ) {

            return $this;

        }

        $keys = array_keys( $data );
        sort( $keys );

        if ( range( 0, $count - 1 ) !== $keys ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

}
