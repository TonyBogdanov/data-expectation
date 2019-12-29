<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\ScalarExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\ScalarExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\ScalarExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new ScalarExpectation();

        $this->assertSame( $expectation, $expectation->expect( 1 ) );
        $this->assertSame( $expectation, $expectation->expect( 1.1 ) );
        $this->assertSame( $expectation, $expectation->expect( 'string' ) );
        $this->assertSame( $expectation, $expectation->expect( true ) );

    }

    public function testInvalidArray() {

        $this->expectException( UnexpectedDataException::class );

        ( new ScalarExpectation() )->expect( [] );

    }

    public function testInvalidObject() {

        $this->expectException( UnexpectedDataException::class );

        ( new ScalarExpectation() )->expect( new \stdClass() );

    }

    public function testInvalidResource() {

        $this->expectException( UnexpectedDataException::class );

        $resource = imagecreate( 1, 1 );

        ( new ScalarExpectation() )->expect( $resource );

        imagedestroy( $resource );

    }

}
