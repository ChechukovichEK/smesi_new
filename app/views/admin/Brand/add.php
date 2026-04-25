<section class="content-header">
	<h1>Добавление производителя</h1>
	<ol class="breadcrumb">
		<li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Главная</a></li>
		<li><a href="<?=ADMIN?>/brand">Список производителей</a></li>
		<li class="active">Добавление производителя</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/brand/add" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Наименование</label>
                            <input type="text" name="title" class="form-control" placeholder="Наименование" required value="<?php isset ($_SESSION['brands_data']['title']) ? h($_SESSION['brands_data']['title']) : null; ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>