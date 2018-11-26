CONTENTS OF THIS FILE
---------------------

 * About phpseclib
 * Usage
 * Known issues
 * Maintainers

ABOUT PHPSECLIB
---------------

This module is just a Libraries API definition for the php library
phpseclib and does nothing on its own. It is meant to be uesd by other
modules.

The php library phpseclib is a pure php implementation of:

 * BigIntegers
 * RSA
 * SSH
 * SFTP
 * X.509
 * Symmetric key encryption
    * AES
    * Rijndael
    * DES
    * 3DES
    * RC4

The API documentation can be found at http://phpseclib.sourceforge.net

USAGE
-----

To make use of phpseclib define it as dependency it your modules info
file, download the library from http://phpseclib.sourceforge.net and
place it to your libraries folder (e.g sites/all/libraries/phpseclib).

When ever you want to make use of the classes define by phpseclib make
sure that <?php libraries_load('phpseclib'); ?> was executed before at
least once.

KNOWN ISSUES
------------

phpseclib does not provide any clue about its version inside the code.
This module just defines a hardcoded version string of the latest version
availlable on Mai 2013. It there will be a newer version available,
things might go wrong.

MAINTAINERS
-----------

 * John P. "jpwarren00" Warren
 * Christian "corvus_ch" Häusler
