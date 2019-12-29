<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\RegexPatternExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\RegexPatternExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\RegexPatternExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new RegexPatternExpectation();

        $this->assertSame( $expectation, $expectation->expect( '/^\d+$/' ) );

    }

    public function testInvalidDelimiter() {

        $this->expectException( UnexpectedDataException::class );

        ( new RegexPatternExpectation() )->expect( '/^\d+$' );

    }

}
