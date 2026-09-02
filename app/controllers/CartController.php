<?php
	
namespace app\controllers;

use app\models\AppModel;
use app\models\Cart;
use app\models\Order;
use app\models\OrderXml;
use app\models\User;

class CartController extends AppController
{
	
	public function addAction()
	{
		$id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
		$qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : null;
		if ($id) {
			$product = \R::findOne('product', 'id = ?', [$id]);
			if (!$product) {
				return false;
			}
		}
		$cart = new Cart();
		$cart->addToCart($product, $qty);
		if (!empty($_SESSION['user'])) {
			$user_id = $_SESSION['user']['id'];
			$cart_qty = $cart->getQty($user_id);
			$cart_sum = $cart->getSum($user_id);
			$cart_sum_master = $cart->getSumMaster($user_id);
			$cart_sum_opt = $cart->getSumOpt($user_id);
			if ($cart_sum >= DISCOUNT) {
				$cart_sum_dis = $cart->getSumDis($user_id);
			}
			$cart_products = \R::getAll("SELECT * FROM cart JOIN product ON product.id = cart.product_id WHERE cart.user_id = ? AND product.status = '1'", [$user_id]);
		}
		if ($this->isAjax()) {
			$this->loadView('cart_modal', compact('cart_qty', 'cart_sum', 'cart_sum_dis', 'cart_products', 'cart_sum_master', 'cart_sum_opt'));
		}
		redirect();
		
	}
	
	public function showAction()
	{
		$this->loadView('cart_modal');
	}
	
	public function addqtyAction()
	{
		$id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
		$add_qty = !empty($_GET['cart_qty']) ? (int)$_GET['cart_qty'] : null;
		if ($id) {
			$product = \R::findOne('product', 'id = ?', [$id]);
			if (!$product) {
				return false;
			}
		}
		$cart = new Cart();
		$cart->addqtyItem($product, $add_qty);
		if (!empty($_SESSION['user'])) {
			$user_id = $_SESSION['user']['id'];
			$cart_qty = $cart->getQty($user_id);
			$cart_sum = $cart->getSum($user_id);
			$cart_sum_master = $cart->getSumMaster($user_id);
			$cart_sum_opt = $cart->getSumOpt($user_id);
			if ($cart_sum >= DISCOUNT) {
				$cart_sum_dis = $cart->getSumDis($user_id);
			}
			$cart_products = \R::getAll("SELECT * FROM cart JOIN product ON product.id = cart.product_id WHERE cart.user_id = ? AND product.status = '1'", [$user_id]);
		}
		
		if ($this->isAjax()) {
			$this->loadView('view', compact('cart_qty', 'cart_sum', 'cart_products', 'cart_sum_dis', 'cart_sum_master', 'cart_sum_opt'));
		}
		redirect();
	}
	
	public function addqtymodAction()
	{
		$id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
		$add_qty = !empty($_GET['cart_qty']) ? (int)$_GET['cart_qty'] : null;
		if ($id) {
			$product = \R::findOne('product', 'id = ?', [$id]);
			if (!$product) {
				return false;
			}
		}
		$cart = new Cart();
		$cart->addqtyItem($product, $add_qty);
		
		if (!empty($_SESSION['user'])) {
			$user_id = $_SESSION['user']['id'];
			$cart_qty = $cart->getQty($user_id);
			$cart_sum = $cart->getSum($user_id);
			$cart_sum_master = $cart->getSumMaster($user_id);
			$cart_sum_opt = $cart->getSumOpt($user_id);
			if ($cart_sum >= DISCOUNT) {
				$cart_sum_dis = $cart->getSumDis($user_id);
			}
			$cart_products = \R::getAll("SELECT * FROM cart JOIN product ON product.id = cart.product_id WHERE cart.user_id = ? AND product.status = '1'", [$user_id]);
		}
		
		if ($this->isAjax()) {
			$this->loadView('cart_modal', compact('cart_qty', 'cart_sum', 'cart_sum_dis', 'cart_products', 'cart_sum_master', 'cart_sum_opt'));
		}
		redirect();
	}
	
	public function deleteAction()
	{
		$id = !empty($_GET['id']) ? $_GET['id'] : null;
		if (isset($_SESSION['cart'][$id])) {
			$cart = new Cart();
			$cart->deleteItem($id);
		}
		if (isset($_SESSION['user'])) {
			$user_id = $_SESSION['user']['id'];
			$cart = new Cart();
			$cart->deleteUserItem($id, $user_id);
			$cart_qty = $cart->getQty($user_id);
			$cart_sum = $cart->getSum($user_id);
			$cart_sum_master = $cart->getSumMaster($user_id);
			$cart_sum_opt = $cart->getSumOpt($user_id);
			if ($cart_sum >= DISCOUNT) {
				$cart_sum_dis = $cart->getSumDis($user_id);
			}
			$cart_products = \R::getAll("SELECT * FROM cart JOIN product ON product.id = cart.product_id WHERE cart.user_id = ? AND product.status = '1'", [$user_id]);
		}
		if ($this->isAjax()) {
			$this->loadView('cart_modal', compact('cart_qty', 'cart_sum', 'cart_sum_dis', 'cart_products', 'cart_sum_master', 'cart_sum_opt'));
		}
		redirect();
	}
	
	public function clearAction()
	{
		if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
			$user_id = $_SESSION['user']['id'];
			\R::exec("DELETE FROM cart WHERE user_id = $user_id");
		}
		unset($_SESSION['cart']);
		unset($_SESSION['cart.qty']);
		unset($_SESSION['cart.sum']);
		unset($_SESSION['cart.disc']);
		unset($_SESSION['cart.master']);
		unset($_SESSION['cart.opt']);
		$this->loadView('cart_modal');
	}
	
	public function viewAction()
	{
		if (!empty($_SESSION['user'])) {
			$user_id = $_SESSION['user']['id'];
			$cart = new Cart();
			$cart_qty = $cart->getQty($user_id);
			$cart_sum = $cart->getSum($user_id);
			$cart_sum_master = $cart->getSumMaster($user_id);
			$cart_sum_opt = $cart->getSumOpt($user_id);
			if ($cart_sum >= DISCOUNT) {
				$cart_sum_dis = $cart->getSumDis($user_id);
			}
			$cart_products = \R::getAll("SELECT * FROM cart JOIN product ON product.id = cart.product_id WHERE cart.user_id = ? AND product.status = '1'", [$user_id]);
		}
		
		// Рекомендуемые товары (как на странице товара)
		$categoryProducts = \R::find(
			'product',
			"hit = '1' AND status = '1' ORDER BY hit_position LIMIT 4"
		);
		
		// Недавно просмотренные (как в ProductController)
		$recentlyViewed = null;
		$p_model = new \app\models\Product();
		$r_viewed = $p_model->getRecentlyViewed();
		
		if ($r_viewed) {
			$recentlyViewed = \R::find(
				'product',
				'id IN (' . \R::genSlots($r_viewed) . ') GROUP BY id LIMIT 4',
				$r_viewed
			);
		}
		
		$this->setMeta('Корзина');
		$this->set(compact('cart_qty', 'cart_sum', 'cart_products', 'cart_sum_dis', 'cart_sum_master', 'cart_sum_opt', 'categoryProducts', 'recentlyViewed'));
		
	}
	
	public function checkoutAction()
	{
		if (!empty($_POST)) {
			// регистрация пользователя
			if (!User::checkAuth() && !empty($_POST['email'])) {
				$reg_mail = h($_POST['email']);
				if (!empty($reg_mail) && (\R::find('user', 'email = ?', [$reg_mail]))) {
					$_SESSION['success'] = '<p>Мы хотели создать для Вас личный кабинет, но обнаружили, что Вы уже зарегистрированы на нашем сайте! Авторизуйтесь, пожалуйста, чтобы не терять возможности нашей бонусной программы!</p>';
				} else {
					$user = new User();
					$data = $_POST;
					$user->load($data);
					$rand_append = rand(100000, 1000000);
					$user->attributes['login'] = AppModel::createAlias('user', 'login', $user->attributes['name'], $rand_append);
					$user_login = $user->attributes['login'];
					if (!$user->validate($data) || !$user->checkUnique()) {
						$user->getErrors();
						$_SESSION['form_data'] = $data;
						redirect();
					} else {
						$rand_pass = rand(100000, 1000000);
						$user->attributes['password'] = $rand_pass;
						$user->attributes['password'] = password_hash($rand_pass, PASSWORD_DEFAULT);
						if (!$user_id = $user->save('user')) {
							$_SESSION['error'] = 'Ошибка!';
							redirect();
						}
					}
					$user_email = h($user->attributes['email']);
					$user_name = h($user->attributes['name']);
					
					$chat_id = '-661035035';
					$text = '<b>Зарегистрирован новый пользователь:</b> Имя - <b>' . PHP_EOL . $user_name . '</b> Логин - <b>' . PHP_EOL . $user_login . '</b>E-mail - <b>' . PHP_EOL . $user_email . '</b>Пароль - <b>' . PHP_EOL . $rand_pass . '</b>';
					
					Order::mailRegistration($user_email, $user_name, $user_login, $rand_pass);
				}
			}
			
			// сохранение заказа
			if (isset($user_id) || isset($_SESSION['user']['id'])) {
				$data['user_id'] = isset($user_id) ? $user_id : $_SESSION['user']['id'];
			} else {
				$data['user_id'] = '0';
			}
			
			//$data['user_status']
			if (isset($_SESSION['user']['status'])) {
				$user_status = $_SESSION['user']['status'];
			} else {
				$user_status = 'client';
			}
			$data['user_status'] = $user_status;
			
			//$data['name']
			if (isset($_SESSION['user']['name']) && !empty($_SESSION['user']['name'])) {
				if (empty($_POST['name'])) {
					$data['name'] = $_SESSION['user']['name'];
				} else {
					$data['name'] = h($_POST['name']);
				}
			} else {
				$data['name'] = h($_POST['name']);
			}
			//$data['phone']
			if (isset($_SESSION['user']['phone']) && !empty($_SESSION['user']['phone'])) {
				if (empty($_POST['phone'])) {
					$data['phone'] = $_SESSION['user']['phone'];
				} else {
					$data['phone'] = h($_POST['phone']);
				}
			} else {
				$data['phone'] = h($_POST['phone']);
			}
			
			//$data['address']
			$data['address'] = h($_POST['address']);
			
			//$user_email
			if (isset($_SESSION['user']['email']) && !empty($_SESSION['user']['email'])) {
				if (empty($_POST['email'])) {
					$user_email = $_SESSION['user']['email'];
				} else {
					$user_email = h($_POST['email']);
				}
			} else {
				$user_email = h($_POST['email']);
			}
			
			//$data['email']
			if (isset($_SESSION['user']['email']) && !empty($_SESSION['user']['email'])) {
				if (empty($_POST['email'])) {
					$data['email'] = $_SESSION['user']['email'];
				} else {
					$data['email'] = h($_POST['email']);
				}
			} else {
				$data['email'] = h($_POST['email']);
			}
			
			$note = !empty($_POST['note']) ? $_POST['note'] : '';
			$data['note'] = $note;
			$samovivoz = !empty($_POST['samovivoz']) ? '1' : '0';
			$data['samovivoz'] = $samovivoz;
			$user_name = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : $_POST['name'];
			
			if (isset($_SESSION['user']['phone']) && !empty($_SESSION['user']['phone'])) {
				if (empty($_POST['phone'])) {
					$user_phone = $_SESSION['user']['phone'];
				} else {
					$user_phone = h($_POST['phone']);
				}
			} else {
				$user_phone = h($_POST['phone']);
			}
			
			//$user_address
			$user_address = h($_POST['address']);
			
			$pay = !empty($_POST['pay']) ? $_POST['pay'] : '';
			$data['pay'] = $pay;
			$order_id = Order::saveOrder($data);
			$order_products = Order::getOrderProduct($order_id);
			$order_qty = Order::getQty($order_id);
			$order_sum = Order::getSum($order_id);
			$order_sum_master = Order::getSumMaster($order_id);
			$order_sum_opt = Order::getSumOpt($order_id);
			$order_sum_dis = Order::getSumDis($order_id);
			
			$dataXml = new \stdClass();
			$dataXml->order_id = $order_id;
			
			//отправляем в чат
			$chat_id = '-661035035';
			$text = '<b>Заказ № ' . $order_id . '</b> Имя - <b>' . PHP_EOL . $user_name . '</b> Статус - <b>' . PHP_EOL . $user_status . '</b> Телефон - <b>' . PHP_EOL . $user_phone . '</b><i>Товары:</i>' . PHP_EOL;
			
			$this->sendTelegram($text);
			// $send_url = BASE_URL . 'sendMessage';
			// $send_url .= "?chat_id={$chat_id}&parse_mode=html&text={$text}";
			// $send = fopen($send_url, "r");
			//отправляем в чат
			
			// товары и сумма
			//клиент
			if ($user_status == 'client') {
				if (isset($order_sum)) {
					if ($order_sum >= DISCOUNT) {
						foreach ($order_products as $item) {
							$el = new \stdClass();
							if ($item['price_dis'] != 0) {
								$text .= '<u>' . $item['title'] . '</u> - ' . $item['qty'] . $item['units'] . ' - ' . $item['price_dis'] . 'руб/' . $item['units'] . PHP_EOL;
								$el->price = $item['price_dis'];
							} else {
								$text .= '<u>' . $item['title'] . '</u> - ' . $item['qty'] . $item['units'] . ' - ' . $item['price'] . 'руб/' . $item['units'] . PHP_EOL;
								$el->price = $item['price'];
							}
							$el->id = $item['product_id'];
							$el->qty = $item['qty'];
							$dataXml->data[] = $el;
						}
						$text .= '<b>Сумма заказа</b> - <i>' . $order_sum_dis . '</i>' . PHP_EOL;
					} else {
						foreach ($order_products as $item) {
							$text .= '<u>' . $item['title'] . '</u> - ' . $item['qty'] . $item['units'] . ' - ' . $item['price'] . 'руб/' . $item['units'] . PHP_EOL;
							$el = new \stdClass();
							$el->id = $item['product_id'];
							$el->price = $item['price'];
							$el->qty = $item['qty'];
							$dataXml->data[] = $el;
						}
						$text .= '<b>Сумма заказа</b> - ' . $order_sum . '' . PHP_EOL;
					}
				}
			}
			//клиент
			
			//мастер
			if ($user_status == 'master') {
				if (isset($order_sum_master)) {
					foreach ($order_products as $item) {
						$el = new \stdClass();
						if ($item['price_master'] != 0) {
							$text .= '<u>' . $item['title'] . '</u> - ' . $item['qty'] . $item['units'] . ' - ' . $item['price_master'] . 'руб/' . $item['units'] . PHP_EOL;
							$el->price = $item['price_master'];
						} else {
							$text .= '<u>' . $item['title'] . '</u> - ' . $item['qty'] . $item['units'] . ' - ' . $item['price'] . 'руб/' . $item['units'] . PHP_EOL;
							$el->price = $item['price'];
						}
						$el->id = $item['product_id'];
						$el->qty = $item['qty'];
						$dataXml->data[] = $el;
					}
					$text .= '<b>Сумма заказа</b> - ' . $order_sum_master . PHP_EOL;
				}
			}
			//мастер
			
			//опт
			if ($user_status == 'opt') {
				if (isset($order_sum_opt)) {
					foreach ($order_products as $item) {
						$el = new \stdClass();
						if ($item['price_opt'] != 0) {
							$text .= '<u>' . $item['title'] . '</u> - ' . $item['qty'] . $item['units'] . ' - ' . $item['price_opt'] . 'руб/' . $item['units'] . PHP_EOL;
							$el->price = $item['price_opt'];
						} else {
							$text .= '<u>' . $item['title'] . '</u> - ' . $item['qty'] . $item['units'] . ' - ' . $item['price'] . 'руб/' . $item['units'] . PHP_EOL;
							$el->price = $item['price'];
						}
						
						$el->id = $item['product_id'];
						$el->qty = $item['qty'];
						$dataXml->data[] = $el;
					}
					$text .= '<b>Сумма заказа</b> - ' . $order_sum_opt . PHP_EOL;
				}
			}
			//опт
			//кол-во
			if (isset($order_qty)) {
				$text .= '<b>Количество товаров</b> - ' . $order_qty . PHP_EOL;
			}
			
			if ($samovivoz == '1') {
				$text .= '<b>Самовывоз</b>' . PHP_EOL;
			}
			if ($samovivoz == '0' && !empty($user_address)) {
				$text .= '<b>Доставка по адресу</b> - ' . $user_address . PHP_EOL;
			}
			if (isset($pay) && !empty($pay)) {
				$text .= '<b>Способ оплаты</b> - ' . $pay . PHP_EOL;
			}
			
			if (isset($note) && !empty($note)) {
				$text .= '<b>Примечание</b> - <i>' . $note . '</i>' . PHP_EOL;
			}
			
			#$send_url = BASE_URL . 'sendMessage';
			#$send_url .= "?chat_id={$chat_id}&parse_mode=html&text={$text}";
			#$send = fopen($send_url, "r");
			
			$this->sendTelegram($text);
			//отправляем в чат
			
			//отправляем на e-mail
			Order::mailOrder($order_id, $user_email, $user_name, $user_status, $user_phone, $user_address, $note, $order_products, $order_qty, $order_sum, $samovivoz, $pay, $order_sum_dis, $order_sum_master, $order_sum_opt);
			Order::mailBill($order_id, $user_email, $user_name, $user_status, $user_phone, $user_address, $note, $order_products, $order_qty, $order_sum, $samovivoz, $pay);
			//отправляем на e-mail
			
			// создаем order XML
			OrderXml::createXml($dataXml);
			// создаем order XML
			if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
				unset($_SESSION['cart']);
				unset($_SESSION['cart.qty']);
				unset($_SESSION['cart.sum']);
				unset($_SESSION['cart.disc']);
				unset($_SESSION['cart.master']);
				unset($_SESSION['cart.opt']);
			}
			if (isset($_SESSION['user'])) {
				$user_id = $_SESSION['user']['id'];
				if ($user_cart = \R::findAll('cart', 'user_id = ?', [$user_id])) {
					foreach ($user_cart as $cart_item) {
						$del_id = $cart_item['id'];
						\R::exec("DELETE FROM cart WHERE id = $del_id");
					}
				}
			}
			redirect();
		}
	}
	
	
	
	private function sendTelegram($message)
	{
		$chat_id = -661035035;
		$token = '5048825951:AAEbDQTGTHMOy9tdPLIa9TMRPxt1gMV1Ojo';
		
		$ch = curl_init();
		curl_setopt_array(
			$ch,
			[
				CURLOPT_URL => 'https://api.telegram.org/bot' . $token . '/sendMessage',
				CURLOPT_POST => TRUE,
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_TIMEOUT => 10,
				CURLOPT_POSTFIELDS => [
					'chat_id' => $chat_id,
					'text' => $message,
					'parse_mode' => 'html',
				],
			]
		);
		
		$response = curl_exec($ch);
	}
	
	
}
