<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\NotExpectation;

use DataComparator\Comparator;
use DataExpectation\AbstractExpectation;
use DataExpectation\Exceptions\InvalidExpectationDefinitionException;
use DataExpectation\Exceptions\InvalidExpectationNameException;
use DataExpectation\IntegerExpectation;
use DataExpectation\NotExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class SerializeDeserializeTest
 *
 * @package Tests\DataExpectation\NotExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class SerializeDeserializeTest extends TestCase {

    /**
     * @throws InvalidExpectationDefinitionException
     * @throws InvalidExpectationNameException
     */
    public function testValid() {

        $expectation = new NotExpectation( new IntegerExpectation() );

        Comparator::compare(

            $expectation,
            AbstractExpectation::fromDefinition( json_decode( json_encode( $expectation ), true ) )

        );

        $this->assertTrue( true );

    }

    public function testType() {

        $expectation = new NotExpectation( new IntegerExpectation() );

        $this->assertIsString( $expectation->getType() );
        $this->assertNotEmpty( $expectation->getType() );

    }

}
