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
 * Class NotExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class NotExpectation extends AbstractExpectation {

    /**
     * @var ExpectationInterface
     */
    protected $expectation;

    /**
     * NotExpectation constructor.
     *
     * @param ExpectationInterface $expectation
     */
    public function __construct( ExpectationInterface $expectation ) {

        $this->setExpectation( $expectation );

    }

    /**
     * @return array
     */
    public function jsonSerialize(): array {

        return array_replace( parent::jsonSerialize(), [

            'expectationArguments' => [ $this->expectation ],

        ] );

    }

    /**
     * @return string
     */
    public function getType(): string {

        return sprintf( 'not ( %s )', $this->getExpectation()->getType() );

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

            $this->getExpectation()->expect( $data, $path );

        } catch ( UnexpectedDataException $e ) {

            return $this;

        }

        throw new UnexpectedDataException( $data, $this, $path );

    }

    /**
     * @return ExpectationInterface
     */
    public function getExpectation(): ExpectationInterface {

        return $this->expectation;

    }

    /**
     * @param ExpectationInterface $expectation
     *
     * @return $this
     */
    public function setExpectation( ExpectationInterface $expectation ) {

        $this->expectation = $expectation;
        return $this;

    }

}
