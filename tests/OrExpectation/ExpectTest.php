<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\OrExpectation;

use DataExpectation\BooleanExpectation;
use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\IntegerExpectation;
use DataExpectation\OrExpectation;
use DataExpectation\StringExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\OrExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ 123.456 ],
            [ null ],
            [ [ new \stdClass() ] ],
            [ [ 'one', 'two', 'three' ] ],

        ];

    }

    public function testValid() {

        $expectation = new OrExpectation(

            new BooleanExpectation(),
            new IntegerExpectation(),
            new StringExpectation()

        );

        $this->assertSame( $expectation, $expectation->expect( true ) );
        $this->assertSame( $expectation, $expectation->expect( 123 ) );
        $this->assertSame( $expectation, $expectation->expect( 'string' ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new OrExpectation(

            new BooleanExpectation(),
            new IntegerExpectation(),
            new StringExpectation()

        ) )->expect( $value );

    }

}
