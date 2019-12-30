<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\ArrayKeysExpectation;

use DataComparator\Comparator;
use DataExpectation\AbstractExpectation;
use DataExpectation\ArrayKeysExpectation;
use DataExpectation\Exceptions\InvalidExpectationDefinitionException;
use DataExpectation\Exceptions\InvalidExpectationNameException;
use DataExpectation\ListExpectation;
use DataExpectation\StringExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class SerializeDeserializeTest
 *
 * @package Tests\DataExpectation\ArrayKeysExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class SerializeDeserializeTest extends TestCase {

    /**
     * @throws InvalidExpectationDefinitionException
     * @throws InvalidExpectationNameException
     */
    public function testValid() {

        $expectation = new ArrayKeysExpectation( new ListExpectation( new StringExpectation() ) );

        Comparator::compare(

            $expectation,
            AbstractExpectation::fromDefinition( json_decode( json_encode( $expectation ), true ) )

        );

        $this->assertTrue( true );

    }

}
