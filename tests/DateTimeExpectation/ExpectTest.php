<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\DateTimeExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\DateTimeExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\DateTimeExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    /**
     * @throws UnexpectedDataException
     */
    public function testValidDate() {

        $expectation = new DateTimeExpectation( 'Y-m-d' );
        $this->assertSame( $expectation, $expectation->expect( '2020-05-30' ) );

    }

    /**
     * @throws UnexpectedDataException
     */
    public function testValidTime() {

        $expectation = new DateTimeExpectation( 'H:i:s' );
        $this->assertSame( $expectation, $expectation->expect( '11:12:50' ) );

    }

    /**
     * @throws UnexpectedDataException
     */
    public function testValidDateTime() {

        $expectation = new DateTimeExpectation( 'Y-m-d H:i:s' );
        $this->assertSame( $expectation, $expectation->expect( '2020-05-30 11:12:50' ) );

    }

    /**
     * @throws UnexpectedDataException
     */
    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        $expectation = new DateTimeExpectation( 'Y-m-d H:i:s' );
        $expectation->expect( 'hello' );

    }

}
