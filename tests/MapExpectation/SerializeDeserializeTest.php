<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\MapExpectation;

use DataComparator\Comparator;
use DataExpectation\AbstractExpectation;
use DataExpectation\ArrayExpectation;
use DataExpectation\BooleanExpectation;
use DataExpectation\Exceptions\InvalidExpectationDefinitionException;
use DataExpectation\Exceptions\InvalidExpectationNameException;
use DataExpectation\IntegerExpectation;
use DataExpectation\ListExpectation;
use DataExpectation\MapExpectation;
use DataExpectation\StringExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class SerializeDeserializeTest
 *
 * @package Tests\DataExpectation\MapExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class SerializeDeserializeTest extends TestCase {

    /**
     * @throws InvalidExpectationDefinitionException
     * @throws InvalidExpectationNameException
     */
    public function testValid() {

        $expectation = new MapExpectation( [

            'string' => new StringExpectation(),
            'integer' => new IntegerExpectation(),
            'array' => new ArrayExpectation(),
            'list' => new ListExpectation( new BooleanExpectation() ),
            'map' => new MapExpectation( [

                'string' => new StringExpectation(),
                'integer' => new IntegerExpectation(),
                'array' => new ArrayExpectation(),
                'list' => new ListExpectation( new BooleanExpectation() ),

            ] ),

        ] );

        Comparator::compare(

            $expectation,
            AbstractExpectation::fromDefinition( json_decode( json_encode( $expectation ), true ) )

        );

        $this->assertTrue( true );

    }

    public function testType() {

        $expectation = new MapExpectation( [

            'string' => new StringExpectation(),
            'integer' => new IntegerExpectation(),
            'array' => new ArrayExpectation(),
            'list' => new ListExpectation( new BooleanExpectation() ),
            'map' => new MapExpectation( [

                'string' => new StringExpectation(),
                'integer' => new IntegerExpectation(),
                'array' => new ArrayExpectation(),
                'list' => new ListExpectation( new BooleanExpectation() ),

            ] ),

        ] );

        $this->assertIsString( $expectation->getType() );
        $this->assertNotEmpty( $expectation->getType() );

    }

}
