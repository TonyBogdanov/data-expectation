<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\ArrayExpectation;

use DataComparator\Comparator;
use DataExpectation\AbstractExpectation;
use DataExpectation\ArrayExpectation;
use DataExpectation\Exceptions\InvalidExpectationDefinitionException;
use DataExpectation\Exceptions\InvalidExpectationNameException;
use PHPUnit\Framework\TestCase;

/**
 * Class SerializeDeserializeTest
 *
 * @package Tests\DataExpectation\ArrayExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class SerializeDeserializeTest extends TestCase {

    /**
     * @throws InvalidExpectationDefinitionException
     * @throws InvalidExpectationNameException
     */
    public function testValid() {

        $expectation = new ArrayExpectation();

        Comparator::compare(

            $expectation,
            AbstractExpectation::fromDefinition( json_decode( json_encode( $expectation ), true ) )

        );

        $this->assertTrue( true );

    }

    public function testType() {

        $expectation = new ArrayExpectation();

        $this->assertIsString( $expectation->getType() );
        $this->assertNotEmpty( $expectation->getType() );

    }

}
