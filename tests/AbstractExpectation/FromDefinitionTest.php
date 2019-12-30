<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\AbstractExpectation;

use DataExpectation\AbstractExpectation;
use DataExpectation\Exceptions\InvalidExpectationDefinitionException;
use DataExpectation\Exceptions\InvalidExpectationNameException;
use PHPUnit\Framework\TestCase;

/**
 * Class FromDefinitionTest
 *
 * @package Tests\DataExpectation\AbstractExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class FromDefinitionTest extends TestCase {

    /**
     * @throws InvalidExpectationDefinitionException
     * @throws InvalidExpectationNameException
     */
    public function testInvalidExpectationDefinition() {

        $this->expectException( InvalidExpectationDefinitionException::class );

        AbstractExpectation::fromDefinition( [] );

    }

    /**
     * @throws InvalidExpectationDefinitionException
     * @throws InvalidExpectationNameException
     */
    public function testInvalidExpectationName() {

        $this->expectException( InvalidExpectationNameException::class );

        AbstractExpectation::fromDefinition( [

            'expectationName' => 'asd',
            'expectationArguments' => [],

        ] );

    }

}
