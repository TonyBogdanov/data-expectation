<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\ClassExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\ClassExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\ClassExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new ClassExpectation( static::class );

        $this->assertSame( $expectation, $expectation->expect( $this ) );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new ClassExpectation( static::class ) )->expect( 'string' );

    }

    public function testInvalidClassName() {

        $this->expectException( UnexpectedDataException::class );

        ( new ClassExpectation( static::class ) )->expect( static::class );

    }

    public function testInvalidObject() {

        $this->expectException( UnexpectedDataException::class );

        ( new ClassExpectation( static::class ) )->expect( new \stdClass() );

    }

}
