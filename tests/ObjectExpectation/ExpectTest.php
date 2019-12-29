<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\ObjectExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\ObjectExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\ObjectExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new ObjectExpectation();

        $this->assertSame( $expectation, $expectation->expect( new \stdClass() ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new ObjectExpectation() )->expect( 'string' );

    }

}
