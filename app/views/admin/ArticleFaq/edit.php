<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					<h1>Добавить FAQ</h1>
					
					
					<form action="" method="post">
						
						<!-- ОБЯЗАТЕЛЬНО: сохраняем id_article -->
						<input type="hidden" name="id_article" value="<?= $id_article ?>">
						
						<div class="form-group">
							<label for="title">Вопрос</label>
							<input type="text" name="title" id="title" class="form-control"
								   value="<?= htmlspecialchars($faq->title, ENT_QUOTES) ?>">
						</div>
						
						<div class="form-group">
							<label for="text">Ответ</label>
							<textarea name="text" class="form-control" id="editor1" rows="10" cols="80"><?= htmlspecialchars($faq->text, ENT_QUOTES) ?></textarea>
						</div>
						
						<div class="form-group">
							<label for="num">Позиция (num)</label>
							<input type="number" name="num" id="num" class="form-control"
								   value="<?= (int)$faq->num ?>">
						</div>
						
						<div class="form-group">
							<label for="visibility">Видимость</label>
							<select name="visibility" id="visibility" class="form-control">
								<option value="1" <?= $faq->visibility ? 'selected' : '' ?>>Показывать</option>
								<option value="0" <?= !$faq->visibility ? 'selected' : '' ?>>Скрыть</option>
							</select>
						</div>
						
						<button type="submit" class="btn btn-success">Сохранить изменения</button>
						<a href="/admin/article/edit?id=<?= $id_article ?>" class="btn btn-default">Назад к статье</a>
					
					</form>
				
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->