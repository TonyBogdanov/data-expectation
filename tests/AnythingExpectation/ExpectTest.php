<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\AnythingExpectation;

use DataExpectation\AnythingExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\AnythingExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new AnythingExpectation();

        $this->assertSame( $expectation, $expectation->expect( null ) );
        $this->assertSame( $expectation, $expectation->expect( true ) );
        $this->assertSame( $expectation, $expectation->expect( 123 ) );
        $this->assertSame( $expectation, $expectation->expect( 123.456 ) );
        $this->assertSame( $expectation, $expectation->expect( 'string' ) );
        $this->assertSame( $expectation, $expectation->expect( [] ) );
        $this->assertSame( $expectation, $expectation->expect( new \stdClass() ) );
        $this->assertSame( $expectation, $expectation->expect( function () {} ) );

    }

}
