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
 * Class GreaterThanExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class GreaterThanExpectation implements ExpectationInterface {

    /**
     * @var int|float
     */
    protected $value;

    /**
     * GreaterThanExpectation constructor.
     *
     * @param float|int $value
     */
    public function __construct( $value ) {

        $this->setValue( $value );

    }

    /**
     * @return string
     */
    public function getType(): string {

        return 'gt( ' . $this->getValue() . ' )';

    }

    /**
     * @param $data
     * @param string|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, string $path = null ) {

        if ( $data <= $this->getValue() ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

    /**
     * @return float|int
     */
    public function getValue() {

        return $this->value;

    }

    /**
     * @param float|int $value
     *
     * @return $this
     */
    public function setValue( $value ) {

        $this->value = $value;
        return $this;

    }

}
