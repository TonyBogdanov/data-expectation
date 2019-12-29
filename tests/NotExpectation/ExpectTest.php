<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\NotExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\IntegerExpectation;
use DataExpectation\NotExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\NotExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new NotExpectation( new IntegerExpectation() );

        $this->assertSame( $expectation, $expectation->expect( 1.1 ) );
        $this->assertSame( $expectation, $expectation->expect( 'string' ) );
        $this->assertSame( $expectation, $expectation->expect( true ) );
        $this->assertSame( $expectation, $expectation->expect( [] ) );
        $this->assertSame( $expectation, $expectation->expect( imagecreate( 1, 1 ) ) );
        $this->assertSame( $expectation, $expectation->expect( new \stdClass() ) );
        $this->assertSame( $expectation, $expectation->expect( function () {} ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new NotExpectation( new IntegerExpectation() ) )->expect( 1 );

    }

}
