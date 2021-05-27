<?php

/**
 * @file
 * Hooks provided by the trusttxt module.
 */

/**
 * Add additional lines to the site's trust.txt file.
 *
 * @return array
 *   An array of strings to add to the trust.txt.
 */
function hook_trusttxt() {
  return array(
    'greenadexchange.com, 12345, DIRECT, AEC242',
    'blueadexchange.com, 4536, DIRECT',
    'silverssp.com, 9675, RESELLER',
  );
}
