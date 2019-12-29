<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\AndExpectation;

use DataExpectation\AndExpectation;
use DataExpectation\EmptyExpectation;
use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\NotExpectation;
use DataExpectation\StringExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\AndExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function invalidProvider(): array {

        return [

            [ '' ],
            [ null ],
            [ 0 ],

        ];

    }

    public function testValid() {

        $nonEmptyStringExpectation = new AndExpectation(

            new NotExpectation( new EmptyExpectation() ),
            new StringExpectation()

        );

        $emptyStringExpectation = new AndExpectation(

            new EmptyExpectation(),
            new StringExpectation()

        );

        $this->assertEquals( $nonEmptyStringExpectation, $nonEmptyStringExpectation->expect( 'string' ) );
        $this->assertEquals( $emptyStringExpectation, $emptyStringExpectation->expect( '' ) );

    }

    /**
     * @dataProvider invalidProvider
     */
    public function testInvalid( $value ) {

        $this->expectException( UnexpectedDataException::class );

        ( new AndExpectation(

            new NotExpectation( new EmptyExpectation() ),
            new StringExpectation()

        ) )->expect( $value );

    }

}
