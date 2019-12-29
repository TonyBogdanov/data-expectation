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
 * Class RegexPatternExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class RegexPatternExpectation implements ExpectationInterface {

    /**
     * @return string
     */
    public function getType(): string {

        return 'regexPattern';

    }

    /**
     * @param $data
     * @param string|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, string $path = null ) {

        @preg_match( $data, '' );

        if ( PREG_NO_ERROR !== preg_last_error() ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

}
