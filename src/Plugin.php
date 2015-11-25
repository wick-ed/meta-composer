<?php

/**
 * \AppserverIo\MetaComposer\Plugin
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/appserver
 * @link      http://www.appserver.io
 */

namespace AppserverIo\MetaComposer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Composer plugin which allows to inject certain common meta information into projects.
 * By dependening on this project meta information like a .editorconfig will be provided by this package
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/appserver
 * @link      http://www.appserver.io
 */
class Plugin implements PluginInterface
{

    /**
     * Path the meta information to inject resides in
     *
     * @var string META_PATH
     */
    const META_PATH = 'meta';

    /**
     * Will copy all files within the "meta" directory into the root directory of the main project
     *
     * @param \Composer\Composer       $composer   Composer instance
     * @param \Composer\IO\IOInterface $composerIo Instance of the composer IO
     *
     * @return void
     */
    public function activate(Composer $composer, IOInterface $composerIo)
    {
        // build up the absolute path the main projects directory
        $projectPath = dirname(dirname(__DIR__));
        // build up the absolute path to the meta dir
        $metaPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . self::META_PATH;
        // iterate the files and copy them
        foreach (scandir($metaPath) as $file) {
            // omit dots
            if ($file !== '..' && $file !== '.') {
                // copy the file
                copy($metaPath . DIRECTORY_SEPARATOR . $file, $projectPath . DIRECTORY_SEPARATOR . $file);
            }

        }
    }
}
