<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\Traits\IndentTrait;

/**
 * Class EnumExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class EnumExpectation implements ExpectationInterface {

    use IndentTrait;

    /**
     * @var array
     */
    protected $options;

    /**
     * EnumExpectation constructor.
     *
     * @param array $options
     */
    public function __construct( array $options ) {

        $this->setOptions( array_values( $options ) );

    }

    /**
     * @return string
     */
    public function getType(): string {

        $result = "enum (\n";

        foreach ( $this->getOptions() as $option ) {

            $result .= $this->indent( json_encode( $option ) . ";\n" );

        }

        return $result . ')';

    }

    /**
     * @param $data
     * @param string|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, string $path = null ) {

        if ( ! in_array( $data, $this->getOptions(), true ) ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

    /**
     * @return array
     */
    public function getOptions(): array {

        return $this->options;

    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function setOptions( array $options ) {

        $this->options = $options;
        return $this;

    }

}
