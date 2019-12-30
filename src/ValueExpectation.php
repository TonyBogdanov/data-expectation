<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataExpectation;

use DataComparator\Comparator;
use DataExpectation\Exceptions\UnexpectedDataException;

/**
 * Class ValueExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ValueExpectation extends AbstractExpectation {

    /**
     * @var mixed
     */
    public $value;

    /**
     * ValueExpectation constructor.
     *
     * @param mixed $value
     */
    public function __construct( $value ) {

        $this->setValue( $value );

    }

    /**
     * @return array
     */
    public function jsonSerialize(): array {

        return array_replace( parent::jsonSerialize(), [

            'expectationArguments' => [ $this->value ],

        ] );

    }

    /**
     * @return string
     */
    public function getType(): string {

        switch ( true ) {

            case is_float( $this->getValue() ) && is_infinite( $this->getValue() ):
                $expression = 'INF';
                break;

            case $this->getValue() instanceof \Closure:
                $expression = \Closure::class;
                break;

            default:
                $expression = json_encode( $this->getValue() );

        }

        if ( 200 < strlen( $expression ) ) {

            $expression = substr( $expression, 0, 200 ) . '...';

        }

        return 'value = ' . $expression;

    }

    /**
     * @param $data
     * @param string|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, string $path = null ) {

        try {

            Comparator::compare( $this->getValue(), $data );

        } catch ( \Exception $e ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

    /**
     * @return mixed
     */
    public function getValue() {

        return $this->value;

    }

    /**
     * @param mixed $value
     *
     * @return $this
     */
    public function setValue( $value ) {

        $this->value = $value;
        return $this;

    }

}
