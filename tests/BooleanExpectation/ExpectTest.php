<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\BooleanExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\BooleanExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\BooleanExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new BooleanExpectation();

        $this->assertSame( $expectation, $expectation->expect( true ) );
        $this->assertSame( $expectation, $expectation->expect( false ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new BooleanExpectation() )->expect( 'string' );

    }

}
