<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\FloatExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\FloatExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\FloatExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new FloatExpectation();

        $this->assertSame( $expectation, $expectation->expect( 1.1 ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new FloatExpectation() )->expect( 1 );

    }

}
