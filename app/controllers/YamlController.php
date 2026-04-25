<?php

namespace app\controllers;

use Symfony\Component\Yaml\Yaml;

class YamlController extends AppController
{

	public function feed1Action()
	{
		$this->genFeed('8704380', ['129869266', '129869299', '4294967579', '4294968434']);
	}

	public function feed2Action()
	{
		$this->genFeed('8704377');
	}

	public function feed3Action()
	{
		$this->genFeed('8704409', ['4294967644', '129920690', '4294967998', '4294968102', '4294967671', '4294968194', '4294968103']);
	}

	public function feed4Action()
	{
		$this->genFeed('7932917');
	}

    public function feed5Action()
    {
        $this->genFeed('8651249');
    }

    public function feed6Action()
    {
        $this->genFeed('8922009');
    }

    public function feed7Action()
    {
        $this->genFeed('8651247', ['4294967896', '4294967897', '4294967898', '142038985', '142039021', '142039045', '142039091']);
    }

    public function feed8Action()
    {
        $this->genFeed('8651251');
    }

	public function feed9Action()
	{
		$this->genFeed('4808652', ['68777711', '4294967390', '4294967557', '4294967558', '130323988']);
	}

    public function feed10Action()
    {
        $this->genFeed('4810324', ['4294967663', '4294967881', '4294967882', '129653519', '68882162', '129653543', '68882139', '4294968003', '4294968004', '4294967596', '4294967597']);
    }

	public function feed11Action()
	{
		$this->genFeed('4652872');
	}

	public function feed12Action()
	{
		$this->genFeed('4655377');
	}

	public function feed13Action()
	{
		$this->genFeed('4654629');
	}

	public function feed14Action()
	{
		$this->genFeed('4359454');
	}

	public function feed15Action()
	{
		$this->genFeed('4656244');
	}

	public function feed16Action()
	{
		$this->genFeed('4359455');
	}

	public function genFeed($id, $filter = [])
	{
		$categories = \R::findAll('category');
		$products = \R::findAll('product', 'category_id = ? AND status = ?', [$id, '1']);

//		foreach ($products as $product) {
//			var_dump($product);
//			die();
//		}


		header("Content-type: text/xml; charset=utf-8");

		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<yml_catalog date="'.date('Y-m-d\TH:i:sP').'">';

		echo '<shop>';

		echo '<name>Smesi.by</name>';
		echo '<company>Smesi.by</company>';
		echo '<url>https://smesi.by/</url>';
		echo '<platform>BSM/Yandex/Market</platform>';
		echo '<version>2.7.5</version>';

		echo '<currencies>';
		echo '<currency id="BYN" rate="1"/>';
		echo '</currencies>';

		echo '<categories>';
		foreach ($categories as $category) {
			if ($category->parent_id == 0) {
				echo '<category id="'.$category->id.'">'.$category->title.'</category>';
			} else {
				echo '<category id="'.$category->id.'" parentId="'.$category->parent_id.'">'.$category->title.'</category>';
			}

		}
		echo '</categories>';

		echo '<offers>';
		foreach ($products as $product) {
			if (!in_array($product->id, $filter) && $product->price > 0 && $product->status == 1) {
				echo '<offer id="'.$product->id.'">';
				echo '<url>https://smesi.by/product/'.$product->alias.'</url>';
				echo '<price>'.$product->price.'</price>';
				echo '<currencyId>BYN</currencyId>';
				echo '<categoryId>'.$product->category_id.'</categoryId>';
				if (!empty($product->img)) {
					echo '<picture>https://smesi.by/prodimg/'.$product->img.'</picture>';
				}
				echo '<name>'.$product->title.'</name>';
				echo '</offer>';
			}
		}
		echo '</offers>';

		echo '</shop>';

		echo '</yml_catalog>';
		die();
	}

}