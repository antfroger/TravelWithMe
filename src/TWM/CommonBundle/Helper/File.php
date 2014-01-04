<?php

/**
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\CommonBundle\Helper;

/**
 *
 */
class File
{

    /**
     * Recursively remove the given directory
     *
     * @param  string  $dir
     * @return boolean
     */
    public static function rrmdir($dir)
    {
        self::emptyDir($dir);

        return rmdir($dir);
    }

    /**
     * Recursively remove the content of the given directory
     *
     * @param  string  $dir
     */
    public static function emptyDir($dir)
    {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            if (is_dir("$dir/$file")) {
                self::rrmdir("$dir/$file");
            } else {
                unlink("$dir/$file");
            }
        }
    }
}
