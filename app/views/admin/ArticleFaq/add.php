<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					<h1>Добавить FAQ</h1>
					
					<form action="" method="post">
						<div class="form-group">
							<label>Вопрос</label>
							<input type="text" name="title" class="form-control">
						</div>
						
						<div class="form-group">
							<label>Ответ</label>
							<textarea name="text" class="form-control" id="editor1" rows="10" cols="80"></textarea>
						</div>
						
						<div class="form-group">
							<label>Позиция (num)</label>
							<input type="number" name="num" class="form-control" value="0">
						</div>
						
						<div class="form-group">
							<label>Видимость</label>
							<select name="visibility" class="form-control">
								<option value="1">Показывать</option>
								<option value="0">Скрыть</option>
							</select>
						</div>
						
						<button type="submit" class="btn btn-success">Сохранить</button>
						<a href="/admin/article-faq/index?id=<?= $id_article ?>" class="btn btn-default">Назад к FAQ статьи</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->