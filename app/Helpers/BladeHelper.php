<?php

use App\Media;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

function featuredImage(Product $product)
{
    if ($product->featuredImage){
        return $product->featuredImage->url;
    }
    return asset('images/no_img.svg');
}
function featuredImage2(Product $product)
{
    if ($product->featuredImage2){
        return $product->featuredImage2->url;
    }
    return asset('images/no_img.svg');
}
function featuredProductImage(Product $product)
{
    if ($product->fImage){
        return $product->fImage->url;
    }
    return asset('images/no_img.svg');
}
function gallerImage(Media $image)
{
    return $image->url ?? null;
}

function image_url($url)
{
  // if (@getimagesize($url)) {
    return $url;
  // }
    return asset('images/no_img.svg');
}

function isProductInWishlist(Product $product)
{
    foreach (Cart::instance('wishlist')->content() as $wishlist) {
        if ($wishlist->id == $product->id) {
            return $wishlist->rowId;
        }
    }
    return null;
}

function calculatorCharge($amount, $percentage)
{   $tax = 0;
    $tax = $amount * ($percentage/100);
    return round($tax + $amount,2);
}

function number2Word($amount){
  $words_string = '';
  $words = Array("0" => '',"1" => 'One',"2" => 'Two',"3" => 'Three',"4" => 'Four',"5" => 'Five',"6" => 'Six',"7" => 'Seven',"8" => 'Eight',"9" => 'Nine',"10" => 'Ten',"11" => 'Eleven',"12" => 'Twelve',"13" => 'Thirteen',"14" => 'Fourteen',"15" => 'Fifteen',"16" => 'Sixteen',"17" => 'Seventeen',"18" => 'Eighteen',"19" => 'Nineteen',"20" => 'Twenty',"30" => 'Thirty',"40" => 'Forty',"50" => 'Fifty',"60" => 'Sixty',"70" => 'Seventy',"80" => 'Eighty',"90" => 'Ninety');
  $number = (string)$amount;
  $n_length = strlen($number);
  if ($n_length <= 9) {
      $n_array = Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
      $received_n_array = Array();
      for ($i = 0; $i < $n_length; $i++) {
          $received_n_array[$i] = substr($number,$i, 1);
      }
      for ($i = 9 - $n_length, $j = 0; $i < 9; $i++, $j++) {
          $n_array[$i] = $received_n_array[$j];
      }
      for ($i = 0, $j = 1; $i < 9; $i++, $j++) {
          if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
              if ($n_array[$i] == 1) {
                  $n_array[$j] = 10 + intval($n_array[$j]);
                  $n_array[$i] = 0;
              }
          }
      }
      $value = "";
      for ($i = 0; $i < 9; $i++) {
          if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
              $value = $n_array[$i] * 10;
          } else {
              $value = $n_array[$i];
          }
          if ($value != 0) {
              $words_string .= $words[$value] . " ";
          }
          if (($i == 1 && $value != 0) || ($i == 0 && $value != 0 && $n_array[$i + 1] == 0)) {
              $words_string .= "Crores ";
          }
          if (($i == 3 && $value != 0) || ($i == 2 && $value != 0 && $n_array[$i + 1] == 0)) {
              $words_string .= "Lakhs ";
          }
          if (($i == 5 && $value != 0) || ($i == 4 && $value != 0 && $n_array[$i + 1] == 0)) {
              $words_string .= "Thousand ";
          }
          if ($i == 6 && $value != 0 && ($n_array[$i + 1] != 0 && $n_array[$i + 2] != 0)) {
              $words_string .= "Hundred and ";
          } else if ($i == 6 && $value != 0) {
              $words_string .= "Hundred ";
          }
      }
  }
  return $words_string;
}

function cacheflush(){
    \Artisan::call('cache:clear');

}
