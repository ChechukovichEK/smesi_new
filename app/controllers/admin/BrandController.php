<?php

namespace app\controllers\admin;

use app\models\admin\Brands;
use app\models\AppModel;
use ishop\libs\Pagination;

class BrandController extends AppController {

    public function indexAction(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 35;
        $count = \R::count('brands');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $brands = \R::getAll("SELECT * FROM brands ORDER BY sort DESC LIMIT $start, $perpage");
        $this->setMeta('Список производителей');
        $this->set(compact('brands', 'pagination', 'count'));
    }

	public function addAction(){
		if(!empty($_POST))
		{
			$brand = new Brands();
			$data = $_POST;
			$brand->load($data);
			$brand->attributes['is_home'] = $brand->attributes['is_home'] ? '1' : '0';
			$brand->getImg();
			if(!$brand->validate($data)){
				$brand->getErrors();
				$_SESSION['news-data'] = $data;
				redirect();
			}
			if($id = $brand->save('brands')){
				$alias = AppModel::createAlias('brands', 'alias', $data['title'], $id);
				$p = \R::load('brands', $id);
				$p->alias = $alias;
				\R::store($p);
				$_SESSION['success'] = 'Производитель добавлен';
			}
			redirect();
		}
		$this->setMeta("Добавление производителя");
	}

	public function editAction()
	{
		if(!empty($_POST)){
			$id = $this->getRequestID(false);
			$brand = new Brands();
			$data = $_POST;
			$brand->load($data);
			$brand->attributes['is_home'] = $brand->attributes['is_home'] ? '1' : '0';
			$brand->getImg();
			if(!$brand->validate($data)){
				$brand->getErrors();
				redirect();
			}
			if($brand->update('brands', $id)){
				$_SESSION['success'] = 'Изменения сохранены';
				redirect();
			}
		}

		$id = $this->getRequestID();
		$brand = \R::load('brands', $id);
		$_SESSION['brandsimg'] = $brand->img;

		$this->setMeta("Редактирование товара {$brand->title}");
		$this->set(compact('brand'));
	}

	public function deleteAction()
	{
		$id = $this->getRequestID();
		$brand = \R::load('brands', $id);
		\R::trash($brand);
		$_SESSION['success'] = 'Производитель удален';
		redirect();
	}

	public function addImageAction()
	{
		if(isset($_GET['upload'])){
			$name = $_POST['name'];
			$brand = new Brands();
			$brand->uploadImg($name);
		}
	}

	public function deleteImgAction()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : null;
		$src = isset($_POST['src']) ? $_POST['src'] : null;
		if(!$id || !$src){
			return;
		}

		if(\R::exec("UPDATE brands SET img = NULL WHERE id = ? AND img = ?", [$id, $src])){
			@unlink(WWW . "/brands/$src");
			exit('1');
		}

		return;
	}

}
