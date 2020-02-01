<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataExpectation;

use DataExpectation\Traits\IndentTrait;

/**
 * Class AnythingExpectation
 *
 * @package DataExpectation
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
class AnythingExpectation extends AbstractExpectation {

    use IndentTrait;

    /**
     * @return string
     */
    public function getType(): string {

        return 'anything';

    }

    /**
     * @param $data
     * @param string|null $path
     *
     * @return $this
     */
    public function expect( $data, string $path = null ) {

        return $this;

    }

}
