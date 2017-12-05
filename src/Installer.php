<?php

namespace BJWPPreCommitHook;

class Installer
{
    public static function postInstall()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            //system('cmd /c vendor\bjornjohansen\wp-pre-commit-hook\src\setup.bat');
        }
        else {
            system('sh vendor/bjornjohansen/wp-pre-commit-hook/src/setup.sh');
        }
    }
}
