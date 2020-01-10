<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\ArrayExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\ArrayExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\ArrayExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new ArrayExpectation();

        $this->assertSame( $expectation, $expectation->expect( [] ) );

    }

    public function testInvalidType() {

        $this->expectException( UnexpectedDataException::class );

        ( new ArrayExpectation() )->expect( 123 );

    }

    public function testInvalidObject() {

        $this->expectException( UnexpectedDataException::class );

        ( new ArrayExpectation() )->expect( new \stdClass() );

    }

    public function testInvalidNull() {

        $this->expectException( UnexpectedDataException::class );

        ( new ArrayExpectation() )->expect( null );

    }

}
