<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\StringLengthExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\StringLengthExpectation;
use DataExpectation\ValueExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\StringLengthExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ 'hello', 4 ],
            [ '', 1 ],

        ];

    }

    public function testValid() {

        $expectation = new StringLengthExpectation( new ValueExpectation( 0 ) );
        $this->assertSame( $expectation, $expectation->expect( '' ) );

        $expectation = new StringLengthExpectation( new ValueExpectation( 5 ) );
        $this->assertSame( $expectation, $expectation->expect( 'hello' ) );

    }

    /**
     * @dataProvider invalidProvider
     *
     * @param string $value
     * @param int $length
     *
     * @throws UnexpectedDataException
     */
    public function testInvalid( string $value, int $length ) {

        $this->expectException( UnexpectedDataException::class );

        $expectation = new StringLengthExpectation( new ValueExpectation( $length ) );
        $this->assertSame( $expectation, $expectation->expect( $value ) );

    }

}
