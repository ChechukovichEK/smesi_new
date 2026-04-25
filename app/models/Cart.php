<?php

namespace app\models;

use ishop\App;

class Cart extends AppModel {

  public function getAllCartProducts(){
      if(!empty($_COOKIE['cart'])){
          return $_COOKIE['cart'];
      }
      return false;
  }

  public function setCartProducts($id){
      $cartProducts = $this->getAllCartProducts();
      if(!$cartProducts){
          setcookie('cart', $id, time() + 3600*24, '/');
      }else{
          $cartProducts = explode('.', $cartProducts);
          if(!in_array($id, $cartProducts)){
              $cartProducts[] = $id;
              $cartProducts = implode('.', $cartProducts);
              setcookie('cart', $cartProducts, time() + 3600*24, '/');
          }
      }
  }

  public function getCartProducts(){
      if(!empty($_COOKIE['cart'])){
          $cartProducts = $_COOKIE['cart'];
          $cartProducts = explode('.', $cartProducts);
          return $cartProducts;
      }
      return false;
  }

  public function addToCart($product, $qty = 1){
          $ID = $product->id;
          $title = $product->title;
          if(!($product->discount)){
            $price = $product->price;
          } else{
            $price = round(($product->price)*((100 - $product->discount)/100), 2);
          }
          $price_dis = $product->price_dis;
          $price_master = $product->price_master;
          $price_opt = $product->price_opt;
          $articul = $product->articul;
    if(!isset($_SESSION['user'])){
      if(isset($_SESSION['cart'][$ID])){
          $_SESSION['cart'][$ID]['qty'] += $qty;
      }else{
          $_SESSION['cart'][$ID] = [
              'qty' => $qty,
              'title' => $title,
              'alias' => $product->alias,
              'price' => $price,
              'price_dis' => $price_dis,
              'price_master' => $price_master,
              'price_opt' => $price_opt,
              'img' => $product->img,
              'articul' => $articul,
              'discount' => $product->discount,
              'units' => $product->units,
          ];
      }

      $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
      $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $price : $qty * $price;
      if($price_dis != 0){
        $_SESSION['cart.disc'] = isset($_SESSION['cart.disc']) ? $_SESSION['cart.disc'] + $qty * $price_dis : $qty * $price_dis;
      }
      else{
        $_SESSION['cart.disc'] = isset($_SESSION['cart.disc']) ? $_SESSION['cart.disc'] + $qty * $price : $qty * $price;
      }

      if($price_master != 0){
        $_SESSION['cart.master'] = isset($_SESSION['cart.master']) ? $_SESSION['cart.master'] + $qty * $price_master : $qty * $price_master;
      }
      else{
        $_SESSION['cart.master'] = isset($_SESSION['cart.master']) ? $_SESSION['cart.master'] + $qty * $price : $qty * $price;
      }

      if($price_opt != 0){
        $_SESSION['cart.opt'] = isset($_SESSION['cart.opt']) ? $_SESSION['cart.opt'] + $qty * $price_opt : $qty * $price_opt;
      }
      else{
        $_SESSION['cart.opt'] = isset($_SESSION['cart.opt']) ? $_SESSION['cart.opt'] + $qty * $price : $qty * $price;
      }


}
      if(!empty($_SESSION['user'])){
        $user_id = $_SESSION['user']['id'];
        if($cart_item = \R::findOne('cart', 'user_id = ? AND product_id = ?', [$user_id, $ID])){
          $qty = $cart_item->qty + $qty;
          $cart_id = $cart_item->id;
          \R::exec("UPDATE cart SET
                      qty = $qty
                      WHERE id = $cart_id");
        }else{
          \R::exec("INSERT INTO cart (user_id, product_id, qty) VALUES ($user_id, $ID, $qty)");
        }
      }
  }

  public function addqtyItem($product, $add_qty){
    $id = $product->id;
    $title = $product->title;
    if(!($product->discount)){
      $price = $product->price;
    } else{
      $price = round(($product->price)*((100 - $product->discount)/100), 2);
    }
    $price_dis = $product->price_dis;
    $price_master = $product->price_master;
    $price_opt = $product->price_opt;
    $articul = $product->articul;
    if(!isset($_SESSION['user'])){
      if(isset($_SESSION['cart'][$id])){
          $_SESSION['cart.qty'] = $_SESSION['cart.qty'] - $_SESSION['cart'][$id]['qty'];
          $_SESSION['cart.sum'] = $_SESSION['cart.sum'] - $_SESSION['cart'][$id]['qty'] * $price;
          if($price_dis != 0){
            $_SESSION['cart.disc'] = $_SESSION['cart.disc'] - $_SESSION['cart'][$id]['qty'] * $price_dis;
          } else{
            $_SESSION['cart.disc'] = $_SESSION['cart.disc'] - $_SESSION['cart'][$id]['qty'] * $price;
          }

          if($price_master != 0){
            $_SESSION['cart.master'] = $_SESSION['cart.master'] - $_SESSION['cart'][$id]['qty'] * $price_master;
          } else{
            $_SESSION['cart.master'] = $_SESSION['cart.master'] - $_SESSION['cart'][$id]['qty'] * $price;
          }

          if($price_opt != 0){
            $_SESSION['cart.opt'] = $_SESSION['cart.opt'] - $_SESSION['cart'][$id]['qty'] * $price_opt;
          } else{
            $_SESSION['cart.opt'] = $_SESSION['cart.opt'] - $_SESSION['cart'][$id]['qty'] * $price;
          }

          $_SESSION['cart'][$id] = [
            'qty' => $add_qty,
            'title' => $title,
            'alias' => $product->alias,
            'price' => $price,
            'price_dis' => $price_dis,
            'price_master' => $price_master,
            'price_opt' => $price_opt,
            'img' => $product->img,
            'articul' => $articul,
            'discount' => $product->discount,
            'units' => $product->units,
          ];
      }
        else{
          $_SESSION['cart'][$id] = [
              'qty' => $add_qty,
              'title' => $title,
              'alias' => $product->alias,
              'price' => $price,
              'price_dis' => $price_dis,
              'price_master' => $price_master,
              'price_opt' => $price_opt,
              'img' => $product->img,
              'articul' => $articul,
              'discount' => $product->discount,
              'units' => $product->units,
          ];
        }
      $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $add_qty : $add_qty;
      $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $add_qty * $price : $add_qty * $price;
      if($price_dis != 0){
        $_SESSION['cart.disc'] = isset($_SESSION['cart.disc']) ? $_SESSION['cart.disc'] + $add_qty * $price_dis : $add_qty * $price_dis;
      }else{
        $_SESSION['cart.disc'] = isset($_SESSION['cart.disc']) ? $_SESSION['cart.disc'] + $add_qty * $price : $add_qty * $price;
      }

      if($price_master != 0){
        $_SESSION['cart.master'] = isset($_SESSION['cart.master']) ? $_SESSION['cart.master'] + $add_qty * $price_master : $add_qty * $price_master;
      }else{
        $_SESSION['cart.master'] = isset($_SESSION['cart.master']) ? $_SESSION['cart.master'] + $add_qty * $price : $add_qty * $price;
      }

      if($price_dis != 0){
        $_SESSION['cart.opt'] = isset($_SESSION['cart.opt']) ? $_SESSION['cart.opt'] + $add_qty * $price_opt : $add_qty * $price_opt;
      }else{
        $_SESSION['cart.opt'] = isset($_SESSION['cart.opt']) ? $_SESSION['cart.opt'] + $add_qty * $price : $add_qty * $price;
      }
}
      if(!empty($_SESSION['user'])){
        $user_id = $_SESSION['user']['id'];
          \R::exec("UPDATE cart SET
                      qty = $add_qty
                      WHERE user_id = $user_id
                      AND product_id = $id");
      }
  }


  public function getQty($user_id){
    if($user_cart = \R::findAll('cart', 'user_id = ?', [$user_id])){
    foreach($user_cart as $cart_item){
    if (isset($cart_qty)){
      $cart_qty += $cart_item->qty;
    }
    else {
      $cart_qty = $cart_item->qty;
    }
  }
  return $cart_qty;
  }
}

  public function getSum($user_id){
    if($user_cart = \R::findAll('cart', 'user_id = ?', [$user_id])){
    $cart_sum = 0;
    foreach($user_cart as $cart_item){
      $cart_product = \R::findOne('product', 'id = ?', [$cart_item->product_id]);
      if(!($cart_product->discount)){
        $cart_price = $cart_product->price;
      } else{
        $cart_price = round(($cart_product->price)*((100 - $cart_product->discount)/100), 2);
      }
      $cart_sum += $cart_price * $cart_item->qty;
    }
    return $cart_sum;
  }
}

public function getSumDis($user_id){
  if($user_cart = \R::findAll('cart', 'user_id = ?', [$user_id])){
  $cart_sum_dis = 0;
  foreach($user_cart as $cart_item){
    $cart_product = \R::findOne('product', 'id = ?', [$cart_item->product_id]);
    $cart_price = $cart_product->price_dis;
    $reg_price = $cart_product->price;
    if($cart_price != 0){
      $cart_sum_dis += $cart_price * $cart_item->qty;
    }
    else{
      $cart_sum_dis += $reg_price * $cart_item->qty;
    }
  }
  return $cart_sum_dis;
}
}

public function getSumMaster($user_id){
  if($user_cart = \R::findAll('cart', 'user_id = ?', [$user_id])){
  $cart_sum_master = 0;
  foreach($user_cart as $cart_item){
    $cart_product = \R::findOne('product', 'id = ?', [$cart_item->product_id]);
    $cart_price = $cart_product->price_master;
    $reg_price = $cart_product->price;
    if($cart_price != 0){
      $cart_sum_master += $cart_price * $cart_item->qty;
    }
    else{
      $cart_sum_master += $reg_price * $cart_item->qty;
    }
  }
  return $cart_sum_master;
}
}

public function getSumOpt($user_id){
  if($user_cart = \R::findAll('cart', 'user_id = ?', [$user_id])){
  $cart_sum_opt = 0;
  foreach($user_cart as $cart_item){
    $cart_product = \R::findOne('product', 'id = ?', [$cart_item->product_id]);
    $cart_price = $cart_product->price_opt;
    $reg_price = $cart_product->price;
    if($cart_price != 0){
      $cart_sum_opt += $cart_price * $cart_item->qty;
    }
    else{
      $cart_sum_opt += $reg_price * $cart_item->qty;
    }
  }
  return $cart_sum_opt;
}
}


    public function deleteItem($id){
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        if($_SESSION['cart'][$id]['price_dis'] != 0){
          $sumDisMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price_dis'];
        }else{
          $sumDisMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        }

        if($_SESSION['cart'][$id]['price_master'] != 0){
          $sumMasterMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price_master'];
        }else{
          $sumMasterMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        }

        if($_SESSION['cart'][$id]['price_opt'] != 0){
          $sumOptMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price_opt'];
        }else{
          $sumOptMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        }

        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        $_SESSION['cart.disc'] -= $sumDisMinus;
        $_SESSION['cart.master'] -= $sumMasterMinus;
        $_SESSION['cart.opt'] -= $sumOptMinus;
        unset($_SESSION['cart'][$id]);
    }

    public function deleteUserItem($id, $user_id){
        $del_cart_item = \R::exec("DELETE FROM cart WHERE product_id = $id AND user_id = $user_id");
    }




}
