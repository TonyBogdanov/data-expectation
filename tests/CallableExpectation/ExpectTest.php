<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\CallableExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\CallableExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\CallableExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new CallableExpectation();

        $this->assertSame( $expectation, $expectation->expect( function () {} ) );
        $this->assertSame( $expectation, $expectation->expect( [ $this, 'testValid' ] ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new CallableExpectation() )->expect( 'string' );

    }

    public function testInvalidCallable() {

        $this->expectException( UnexpectedDataException::class );

        ( new CallableExpectation() )->expect( [ $this, 'testFoo' ] );

    }

}
