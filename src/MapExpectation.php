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
 * Class MapExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class MapExpectation extends AbstractExpectation {

    use IndentTrait;

    /**
     * @var ExpectationInterface[]
     */
    protected $expectations;

    /**
     * MapExpectation constructor.
     *
     * @param ExpectationInterface[] $expectations
     */
    public function __construct( array $expectations ) {

        $this->setExpectations( $expectations );

    }

    /**
     * @return array
     */
    public function jsonSerialize(): array {

        return array_replace( parent::jsonSerialize(), [

            'expectationArguments' => [ $this->expectations ],

        ] );

    }

    /**
     * @return string
     */
    public function getType(): string {

        $result = "map {\n";

        foreach ( $this->getExpectations() as $key => $expectation ) {

            $result .= $this->indent( $key . ' = ' . $expectation->getType() . ";\n" );

        }

        return $result . '}';

    }

    /**
     * @param $data
     * @param string|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, string $path = null ) {

        foreach ( $this->getExpectations() as $key => $expectation ) {

            try {

                $expectation->expect(

                    $data[ $key ],
                    $path ? $path . '.' . $key : null

                );

            } catch ( UnexpectedDataException $e ) {

                throw new UnexpectedDataException( $data, $this, $path, $e );

            }

        }

        return $this;

    }

    /**
     * @return ExpectationInterface[]
     */
    public function getExpectations(): array {

        return $this->expectations;

    }

    /**
     * @param ExpectationInterface[] $expectations
     *
     * @return $this
     */
    public function setExpectations( array $expectations ) {

        $this->expectations = $expectations;
        return $this;

    }

}
