<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\ListExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\IntegerExpectation;
use DataExpectation\ListExpectation;
use DataExpectation\StringExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\ListExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ [ new \stdClass() ] ],
            [ [ 'string' ] ],
            [ [ 123.456 ] ],
            [ [ null ] ],
            [ [ [] ] ],

        ];

    }

    public function testValid() {

        $expectation = new ListExpectation( new StringExpectation() );

        $this->assertSame( $expectation, $expectation->expect( [] ) );
        $this->assertSame( $expectation, $expectation->expect( [ 'string', 'another string' ] ) );

    }

    public function testValidCompound() {

        $expectation = new ListExpectation( new ListExpectation( new StringExpectation() ) );

        $this->assertSame( $expectation, $expectation->expect( [] ) );
        $this->assertSame( $expectation, $expectation->expect( [ [ 'string', ], [ 'another string' ] ] ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new ListExpectation( new IntegerExpectation() ) )->expect( $value );

    }

}
