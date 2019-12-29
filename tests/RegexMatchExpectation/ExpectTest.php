<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\RegexMatchExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\RegexMatchExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\RegexMatchExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValidIP() {

        $expectation = new RegexMatchExpectation(

            '/^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/'

        );

        $this->assertSame( $expectation, $expectation->expect( '127.0.0.1' ) );

    }

    public function testValidNumber() {

        $expectation = new RegexMatchExpectation( '/^\d+$/' );

        $this->assertSame( $expectation, $expectation->expect( '123' ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new RegexMatchExpectation( '/^\d+$/' ) )->expect( 'hello' );

    }

}
