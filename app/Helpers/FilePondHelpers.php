<?php

namespace App\Helpers;

use App\Models\TemporaryFile;
use App\Models\TemporaryImage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FilePondHelpers
{
  public static function removeTemporaryImage()
  {
    if (Session::has('image-law-app')) {
      $session = Session::get('image-law-app');
      $tmpFile = TemporaryImage::where('folder', $session)->first();
      if ($tmpFile && Storage::exists('post/tmp-filepond-image/' . $tmpFile->folder)) {
        Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpFile->folder);
      }
      if ($tmpFile) {
        $tmpFile->delete();
      }
      Session::forget('image-law-app');
    }
  }

  public static function removeTemporaryFile()
  {
    if (Session::has('file-law-app')) {
      $session = Session::get('file-law-app');
      $tmpFile = TemporaryFile::where('folder', $session)->first();
      if ($tmpFile && Storage::exists('post/tmp-filepond-file/' . $tmpFile->folder)) {
        Storage::deleteDirectory('post/tmp-filepond-file/' . $tmpFile->folder);
      }
      if ($tmpFile) {
        $tmpFile->delete();
      }
      Session::forget('file-law-app');
    }
  }
}
