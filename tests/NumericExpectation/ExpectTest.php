<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\NumericExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\NumericExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\NumericExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new NumericExpectation();

        $this->assertSame( $expectation, $expectation->expect( 1 ) );
        $this->assertSame( $expectation, $expectation->expect( 1.1 ) );
        $this->assertSame( $expectation, $expectation->expect( '1.23' ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new NumericExpectation() )->expect( 'string' );

    }

}
