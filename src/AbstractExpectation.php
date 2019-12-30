<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataExpectation;

use DataExpectation\Exceptions\InvalidExpectationDefinitionException;
use DataExpectation\Exceptions\InvalidExpectationNameException;

/**
 * Class AbstractExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
abstract class AbstractExpectation implements ExpectationInterface {

    /**
     * @var string
     */
    protected static $namespace;

    /**
     * @param $data
     *
     * @return mixed
     * @throws InvalidExpectationNameException
     */
    protected static function filterDefinition( $data ) {

        if (

            ! is_array( $data ) || 2 !== count( $data ) ||
            ! isset( $data['expectationName'] ) || ! is_string( $data['expectationName'] ) ||
            ! isset( $data['expectationArguments'] ) || ! is_array( $data['expectationArguments'] )

        ) {

            if ( is_array( $data ) ) {

                return array_combine( array_keys( $data ), array_map( function ( $argument ) {

                    return static::filterDefinition( $argument );

                }, $data ) );

            }

            return $data;

        }

        if ( ! isset( static::$namespace ) ) {

            static::$namespace = implode( '\\', array_slice( explode( '\\', static::class ), 0, -1 ) );

        }

        $className = static::$namespace . '\\' . $data['expectationName'];
        if ( ! class_exists( $className ) || ! is_a( $className, ExpectationInterface::class, true ) ) {

            throw new InvalidExpectationNameException( $data['expectationName'] );

        }

        return new $className( ...array_map( function ( $argument ) {

            return static::filterDefinition( $argument );

        }, $data['expectationArguments'] ) );

    }

    /**
     * @param array $definition
     *
     * @return ExpectationInterface
     * @throws InvalidExpectationDefinitionException
     * @throws InvalidExpectationNameException
     */
    public static function fromDefinition( array $definition ): ExpectationInterface {

        $expectation = static::filterDefinition( $definition );
        if ( ! ( $expectation instanceof ExpectationInterface ) ) {

            throw new InvalidExpectationDefinitionException( $expectation );

        }

        return $expectation;

    }

    /**
     * @return array
     */
    public function jsonSerialize(): array {

        return [

            'expectationName' => array_slice( explode( '\\', static::class ), -1 )[0],
            'expectationArguments' => [],

        ];

    }

}
