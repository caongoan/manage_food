<?php
include "Layout/header.php";
?>
<?php
$dish = new DishController();
$list_cat = $dish->list_cat();
$list_status = $dish->list_status();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $add = $dish->Add($_FILES);
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm món ăn
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Thêm mới </h3><br />
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
                                        <label for="name">Tên món ăn</label>
                                        <input type="text" class="form-control" placeholder="Nhập tên món ăn..." name="dishName" />
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="name">Hình ảnh</label>
                                        <input type="file" class="form-control" placeholder="Chọn hình ảnh..." name="images"  />
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Giá</label>
                                        <input type="number" class="form-control" placeholder="Nhập giá..." name="price" />
                                    </div>
                                    <div class="form-group">

                                        <label for="name">Danh mục</label>
                                        <select class="form-control" name="catId">

                                            <option>Chọn danh mục</option>
                                            <?php
                                            if ($list_cat) {
                                                while ($result = $list_cat->fetch_assoc()) {

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
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="name">Trạng thái</label>
                                        <select class="form-control" name="dishStatusId">

                                            <option>Chọn trạng thái</option>
                                            <?php
                                            if ($list_status) {
                                                while ($result = $list_status->fetch_assoc()) {

                                            ?>
                                                    <option value=" <?php echo $result['dishStatusId'] ?> "> <?php echo $result['dishStatusName'] ?> </option>

                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="/manage_food/admin/index.php?controller=Dish&action=index">Quay lại</a>
                            </div>
                            <div class="box-footer">
                                <input id="sub" type="submit" class="btn btn-primary" value="Thêm" />
                            </div>
                            <div>
                                <a href="/manage_food/admin/index.php?controller=Dish&action=index"></a>
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