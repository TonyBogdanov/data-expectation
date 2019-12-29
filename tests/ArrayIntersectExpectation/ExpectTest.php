<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\ArrayIntersectExpectation;

use DataExpectation\ArrayIntersectExpectation;
use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\ValueExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\ArrayIntersectExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ [ 'b', 'c', 'd' ] ],
            [ [ 'string' ] ],

        ];

    }

    public function testValid() {

        $expectation = new ArrayIntersectExpectation( [ 'a', 'b' ], new ValueExpectation( [ 'a', 'b' ] ) );
        $this->assertSame( $expectation, $expectation->expect( [ 'a', 'b', 'c' ] ) );

        $expectation = new ArrayIntersectExpectation( [ 'a', 'b', 'c' ], new ValueExpectation( [ 'a', 'b' ] ) );
        $this->assertSame( $expectation, $expectation->expect( [ 'a', 'b' ] ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        $expectation = new ArrayIntersectExpectation( [ 'a', 'b' ], new ValueExpectation( [ 'a', 'b' ] ) );
        $this->assertSame( $expectation, $expectation->expect( $value ) );

    }

}
