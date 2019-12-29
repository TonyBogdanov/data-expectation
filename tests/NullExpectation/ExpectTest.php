<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\NullExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\NullExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\NullExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new NullExpectation();

        $this->assertSame( $expectation, $expectation->expect( null ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new NullExpectation() )->expect( 1 );

    }

}
