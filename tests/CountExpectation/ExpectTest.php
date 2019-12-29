<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\CountExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\CountExpectation;
use DataExpectation\ValueExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\CountExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ [ 'a', 'b', 'c' ], 4 ],
            [ [], 1 ],

        ];

    }

    public function testValid() {

        $expectation = new CountExpectation( new ValueExpectation( 0 ) );
        $this->assertSame( $expectation, $expectation->expect( [] ) );

        $expectation = new CountExpectation( new ValueExpectation( 3 ) );
        $this->assertSame( $expectation, $expectation->expect( [ 'a', 'b', 'c' ] ) );

        $countable = new \ArrayObject( [ 'a', 'b' ] );
        $expectation = new CountExpectation( new ValueExpectation( 2 ) );
        $this->assertSame( $expectation, $expectation->expect( $countable ) );

    }

    /**
     * @dataProvider invalidProvider
     *
     * @param string $value
     * @param int $count
     *
     * @throws UnexpectedDataException
     */
    public function testInvalid( $value, int $count ) {

        $this->expectException( UnexpectedDataException::class );

        $expectation = new CountExpectation( new ValueExpectation( $count ) );
        $this->assertSame( $expectation, $expectation->expect( $value ) );

    }

}
