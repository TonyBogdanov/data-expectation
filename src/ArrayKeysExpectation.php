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
 * Class ArrayKeysExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ArrayKeysExpectation extends AbstractExpectation {

    /**
     * @var ExpectationInterface
     */
    protected $expectation;

    /**
     * @var bool
     */
    protected $sort;

    /**
     * ArrayKeysExpectation constructor.
     *
     * @param ExpectationInterface $expectation
     * @param bool $sort
     */
    public function __construct( ExpectationInterface $expectation, bool $sort = false ) {

        $this
            ->setExpectation( $expectation )
            ->setSort( $sort );

    }

    /**
     * @return array
     */
    public function jsonSerialize(): array {

        return array_replace( parent::jsonSerialize(), [

            'expectationArguments' => [ $this->expectation, $this->sort ],

        ] );

    }

    /**
     * @return string
     */
    public function getType(): string {

        return 'arrayKeys ( ' . $this->getExpectation()->getType() . ' )';

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

            $keys = array_keys( $data );
            if ( $this->isSort() ) {

                sort( $keys );

            }

            $this->getExpectation()->expect( $keys, $path );

        } catch ( UnexpectedDataException $e ) {

            throw new UnexpectedDataException( $data, $this, $path, $e );

        }

        return $this;

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

    /**
     * @return bool
     */
    public function isSort(): bool {

        return $this->sort;

    }

    /**
     * @param bool $sort
     *
     * @return $this
     */
    public function setSort( bool $sort ) {

        $this->sort = $sort;
        return $this;

    }

}
