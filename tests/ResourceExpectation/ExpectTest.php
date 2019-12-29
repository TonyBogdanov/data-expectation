<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DataExpectation\ResourceExpectation;

use DataExpectation\Exceptions\UnexpectedDataException;
use DataExpectation\ResourceExpectation;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectTest
 *
 * @package Tests\DataExpectation\ResourceExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class ExpectTest extends TestCase {

    public function testValid() {

        $expectation = new ResourceExpectation();
        $resource = imagecreate( 1, 1 );

        $this->assertSame( $expectation, $expectation->expect( $resource ) );

        imagedestroy( $resource );

    }

    public function testInvalid() {

        $this->expectException( UnexpectedDataException::class );

        ( new ResourceExpectation() )->expect( 'string' );

    }

}
