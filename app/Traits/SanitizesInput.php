<?php

namespace App\Traits;

use HTMLPurifier;
use HTMLPurifier_Config;

trait SanitizesInput
{
  public function sanitizeHtml($input)
  {
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);

    if (is_array($input)) {
      foreach ($input as $key => $value) {
        $input[$key] = $this->sanitizeHtml($value);
      }
    } elseif (is_string($input)) {
      $input = $purifier->purify($input);
    }

    return $input;
  }
}
