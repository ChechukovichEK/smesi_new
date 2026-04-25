<section class="content-header">
    <h1>Экспорт в Excel</h1>
    <ol class="breadcrumb">
        <li><a href="<?= ADMIN; ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Экспорт в Excel</li>
    </ol>
</section>

<style>
    #export {
        align-items: center;
    }
</style>

<section class="content">
    <div class="box" id="export">
        <div>
            <a href="<?= ADMIN ?>/export/exportorder" class="btn btn-block btn-lg btn-info">Экспорт заказов</a>
        </div>
        <div>
            <a href="<?= ADMIN ?>/export/exportuser" class="btn btn-block btn-lg btn-primary">Экспорт пользователей</a>
        </div>
        <div>
<!--            <select class="form-control">-->
<!--                <option value="--><?php //= ADMIN ?><!--/export/exportproduct" selected>Весь каталог</option>-->
<!--            </select>-->
            <a href="<?= ADMIN ?>/export/exportproduct" class="btn btn-block btn-lg btn-success">Экспорт товаров</a>
        </div>
    </div>
</section>
