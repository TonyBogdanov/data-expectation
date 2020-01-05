<?php

/**
 * Copyright (c) Tony Bogdanov <tonybogdanov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DataExpectation\Exceptions;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

/**
 * Class AbstractException
 *
 * @package DataExpectation\Exceptions
 * @author Tony Bogdanov <tonybogdanov@gmail.com>
 */
abstract class AbstractException extends \Exception {

    /**
     * @var VarCloner
     */
    protected static $cloner;

    /**
     * @var CliDumper
     */
    protected static $dumper;

    /**
     * @param $data
     *
     * @return string
     */
    protected function format( $data ): string {

        if ( ! isset( static::$cloner ) ) {

            static::$cloner = new VarCloner();

        }

        if ( ! isset( static::$dumper ) ) {

            static::$dumper = new CliDumper();

        }

        return static::$dumper->dump( static::$cloner->cloneVar( $data ), true );

    }

}
