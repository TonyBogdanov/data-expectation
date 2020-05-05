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
 * Class DateTimeExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class DateTimeExpectation extends AbstractExpectation {

    /**
     * @var string
     */
    protected $format;

    /**
     * DateTimeExpectation constructor.
     *
     * @param string $format
     */
    public function __construct( string $format ) {

        $this->setFormat( $format );

    }

    /**
     * @return array
     */
    public function jsonSerialize(): array {

        return array_replace( parent::jsonSerialize(), [

            'expectationArguments' => [ $this->format ],

        ] );

    }

    /**
     * @return string
     */
    public function getType(): string {

        return 'dateTime = ' . $this->getFormat();

    }

    /**
     * @param $data
     * @param string|null $path
     *
     * @return $this
     * @throws UnexpectedDataException
     */
    public function expect( $data, string $path = null ) {

        if ( false === date_create_from_format( $this->format, $data ) ) {

            throw new UnexpectedDataException( $data, $this, $path );

        }

        return $this;

    }

    /**
     * @return string
     */
    public function getFormat(): string {

        return $this->format;

    }

    /**
     * @param string $format
     *
     * @return $this
     */
    public function setFormat( string $format ): self {

        $this->format = $format;
        return $this;

    }

}
