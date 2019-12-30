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
 * Class ClassExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ClassExpectation extends AbstractExpectation {

    /**
     * @var string
     */
    protected $name;

    /**
     * ClassExpectation constructor.
     *
     * @param string $name
     */
    public function __construct( string $name ) {

        $this->setName( $name );

    }

    /**
     * @return array
     */
    public function jsonSerialize(): array {

        return array_replace( parent::jsonSerialize(), [

            'expectationArguments' => [ $this->name ],

        ] );

    }

    /**
     * @return string
     */
    public function getType(): string {

        return $this->getName();

    }

    /**
     * @param $data
     * @param string|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, string $path = null ) {

        if ( ! is_object( $data ) || ! is_a( $data, $this->getName(), false ) ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

    /**
     * @return string
     */
    public function getName(): string {

        return $this->name;

    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName( string $name ) {

        $this->name = $name;
        return $this;

    }

}
