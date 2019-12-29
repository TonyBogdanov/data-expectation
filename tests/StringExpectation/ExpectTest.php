<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\StringExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\StringExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\StringExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new StringExpectation();

        $this->assertSame( $expectation, $expectation->expect( 'string' ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new StringExpectation() )->expect( 1 );

    }

}
