<?php


namespace App\Helper;

use App\Order;

class CustomHelper {

  const PhoneNoRegex = "/^(?=.{11}$)(01)\d+$/";

  public static function storeImage($image, $path) {
    $path = '/uploads' . $path;
    try {
      $name = time() . '.' . $image->getClientOriginalExtension();
      $destinationPath = public_path($path);
      $image->move($destinationPath, $name);
      if (isset($name)) {
        return $path . $name;
      }
      return false;
    } catch (\Exception $e) {
      return false;
    }
  }

  public static function deleteFile($image = null) {
    if ($image !== null) {
      $old_image_path = public_path($image);
      if (file_exists($old_image_path)) {
        @unlink($old_image_path);
      }
    }
  }

  /**
   * @param float $number
   * @param int $decimals
   * @return float
   */
  public static function parseFloat(float $number, int $decimals = 2): float {
    return (float)number_format($number, $decimals, '.', '');
  }

  public static function customer_unique_num()
  {
      do {
          $number = random_int(1000000, 9999999);
      } while (Order::where("customer_id", "=", $number)->first());

      return $number;
  }

}