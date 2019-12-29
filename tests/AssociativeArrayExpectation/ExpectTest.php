<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\AssociativeArrayExpectation;

use DataExpectation\AssociativeArrayExpectation;
use DataExpectation\Exceptions\UnexpectedDataException;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\AssociativeArrayExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ [ new \stdClass() ] ],
            [ [ 'one', 'two', 'three' ] ],
            [ [ 0 => 'one', 1 => 'two', 2 => 'three' ] ],
            [ [ 0 => 'one', 2 => 'two', 1 => 'three' ] ],

        ];

    }

    public function testValid() {

        $expectation = new AssociativeArrayExpectation();

        $this->assertSame( $expectation, $expectation->expect( [] ) );
        $this->assertSame( $expectation, $expectation->expect( [ 0 => 'one', 2 => 'two', 3 => 'three' ] ) );
        $this->assertSame( $expectation, $expectation->expect( [ 'one' => 'one', 'two' => 'two', 'three' => 'three' ] ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new AssociativeArrayExpectation() )->expect( $value );

    }

}
