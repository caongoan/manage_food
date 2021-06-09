<?php
include "Layout/header.php";
?>
<?php
$pr = new PromotionController();
$list_dish = $pr->list_dish();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $add = $pr->Add();
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm giá món ăn mới
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form action="" method="POST">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Ngày bắt đầu</label>
                                        <input type="date" class="form-control" name="startDate" />
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="name">Ngày kết thúc</label>
                                        <input type="date" class="form-control"  name="endDate" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">

                                            <label for="name">Món ăn</label>
                                            <select class="form-control" name="dishId">

                                                <option>Chọn món ăn</option>
                                                <?php
                                                if ($list_dish) {
                                                    while ($result = $list_dish->fetch_assoc()) {

                                                ?>
                                                        <option value=" <?php echo $result['dishId'] ?> "> <?php echo $result['dishName'] ?> </option>

                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Giá mới</label>
                                            <input type="text" class="form-control" placeholder="Nhập giá mới..." name="promotionPrice" />
                                        </div>
                                        
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <!-- /.col -->
                                </div>
                                <div>
                                    <a href="/manage_food/admin/index.php?controller=Promotion&action=index">Quay lại</a>
                                </div>
                                <div class="box-footer">
                                    <input id="sub" type="submit" class="btn btn-primary" value="Thêm" />
                                </div>
                                <div>
                                    <a href="/manage_food/admin/index.php?controller=Promotion&action=index"></a>
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