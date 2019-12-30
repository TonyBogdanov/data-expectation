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
 * Class AndExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class AndExpectation extends AbstractExpectation {

    use IndentTrait;

    /**
     * @var ExpectationInterface[]
     */
    protected $expectations;

    /**
     * AndExpectation constructor.
     *
     * @param ExpectationInterface $left
     * @param ExpectationInterface $right
     * @param ExpectationInterface ...$extra
     */
    public function __construct(

        ExpectationInterface $left,
        ExpectationInterface $right,
        ExpectationInterface ...$extra

    ) {

        $this->setExpectations( array_merge( [ $left, $right ], $extra ) );

    }

    /**
     * @return array
     */
    public function jsonSerialize(): array {

        return array_replace( parent::jsonSerialize(), [

            'expectationArguments' => $this->expectations,

        ] );

    }

    /**
     * @return string
     */
    public function getType(): string {

        $result = "and (\n";

        foreach ( $this->getExpectations() as $expectation ) {

            $result .= $this->indent( $expectation->getType() . ";\n" );

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

        foreach ( $this->expectations as $expectation ) {

            try {

                $expectation->expect( $data, $path );

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
