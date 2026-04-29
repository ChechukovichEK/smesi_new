<?php

namespace app\controllers;

class ArticleController extends AppController
{
	
	public function IndexAction()
	{
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$perpage = 12; // количество статей на странице
		$offset = ($page - 1) * $perpage;
		
		// Всего статей
		$total = \R::count('articles');
		
		// Статьи для текущей страницы
		$news = \R::findAll(
			'articles',
			'ORDER BY id DESC LIMIT ? OFFSET ?',
			[$perpage, $offset]
		);
		
		// Количество страниц
		$pages = ceil($total / $perpage);
		
		$title = "Статьи и полезная информация о строительстве и ремонте1";
		$desc = "В этом разделе вы можете ознакомиться с полезной информацией и актуальными новостями.";
		
		$this->setMeta($title, $desc, $title);
		$this->set(compact('news', 'page', 'pages'));
	}
	
	
	public function ViewAction()
	{
		$alias = $this->route['alias'];
		$new = \R::findOne('articles', ' alias = ? ', [$alias]);
		
		if (empty($new)) {
			throw new \Exception('Статья не найдена', 404);
		}
		
		// 🔥 Загружаем FAQ для статьи
		$faq = \R::findAll(
			'articlefaq',
			'id_article = ? AND visibility = 1 ORDER BY num DESC',
			[$new->id]
		);
		
		$faq_title = $new->faq_title ?: 'Часто задаваемые вопросы';
		
		if (empty($new->meta_title)) {
			$title = 'Smesi.by - ' . $new->title;
		} else {
			$title = $new->meta_title;
		}
		
		if (empty($new->meta_desc)) {
			$desc = 'Smesi.by - ' . $new->title;
		} else {
			$desc = $new->meta_desc;
		}
		
		$other_articles = \R::findAll('articles', 'id != ? ORDER BY id DESC LIMIT 3', [$new->id]);
		
		$new['content'] = $this->replaceBlogProducts($new['content']);
		
		$this->setMeta($title, $desc);
		$this->set(compact('new', 'other_articles', 'faq', 'faq_title'));
	}

    private function replaceBlogProducts($content)
    {
        return preg_replace_callback('/\[blog_product_(\d+)\]/', function ($matches) {
            $productId = (int)$matches[1];

            $item = \R::findOne('product', 'id = ?', [$productId]);
            if (!$item) return '';

            ob_start();

            require APP . '/views/components/card-row.php';

            $html = '<div class="blog-product">' . ob_get_clean() . '</div>';

            return $html;
        }, $content);
    }

    public function TtAction()
    {
        phpinfo();
    }
}
