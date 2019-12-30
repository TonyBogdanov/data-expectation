<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\IntegerExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\IntegerExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\IntegerExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new IntegerExpectation();

        $this->assertSame( $expectation, $expectation->expect( 1 ) );

    }

    public function testInvalidString() {

        $this->expectException( UnexpectedDataException::class );

        ( new IntegerExpectation() )->expect( 'string' );

    }

    public function testInvalidFloat() {

        $this->expectException( UnexpectedDataException::class );

        ( new IntegerExpectation() )->expect( 123.45 );

    }

}
