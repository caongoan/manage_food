<?php
include "Layout/header.php";
?>
<?php
$cat = new CategoriesController();
$list_category = $cat->list_category();
if (isset($_GET['catId'])) {
    $add = $cat->Add();
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm danh mục món ăn
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form action="">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Thêm mới </h3><br/>
                                <?php
                                                if (isset($add)) {
                                                    echo $add;
                                                } ?>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="controller" value="Categories" />
                                            <input type="hidden" name="action" value="indexAdd" />
                                            <label for="name">Danh mục món ăn</label>
                                            <select class="form-control" name="catId">
                                                
                                                <option>Chọn danh mục món ăn</option>
                                                <?php
                                                if ($list_category) {
                                                    while ($result = $list_category->fetch_assoc()) {

                                                ?>
                                                        <option value=" <?php echo $result['catId'] ?> "> <?php echo $result['catName'] ?> </option>

                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <!-- /.col -->
                                </div>
                                <div>
                                <a href="/manage_food/admin/index.php?controller=Categories&action=index">Quay lại</a>
                                </div>
                                <div class="box-footer">
                                    <input id="sub" type="submit" class="btn btn-primary" value="Thêm" />
                                </div>
                                <div>
                                    <a href="/manage_food/admin/index.php?controller=Categories&action=index"></a>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->

                        </div>

                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>
<?php
include "Layout/footer.php";
?>