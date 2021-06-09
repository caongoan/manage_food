<?php
include "Layout/header.php";
?>
<?php
$dc = new DiscountCodeController();
$list_type = $dc->list_code_type();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $add = $dc->Add();
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm mã giảm giá
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
                                        <label for="name">Mã giảm giá</label>
                                        <input type="text" class="form-control" placeholder="Nhập mã giảm giá..." name="discountCode" />
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="name">Số lượng</label>
                                        <input type="number" class="form-control" placeholder="Nhập số lượng..." name="amount" min="1" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Lượng giảm</label>
                                            <input type="text" class="form-control" placeholder="Nhập lượng giảm..." name="details" />
                                        </div>
                                        <div class="form-group">

                                            <label for="name">Loại mã giảm giá</label>
                                            <select class="form-control" name="typeId">

                                                <option>Chọn loại mã giảm giá</option>
                                                <?php
                                                if ($list_type) {
                                                    while ($result = $list_type->fetch_assoc()) {

                                                ?>
                                                        <option value=" <?php echo $result['typeId'] ?> "> <?php echo $result['typeName'] ?> </option>

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
                                    <a href="/manage_food/admin/index.php?controller=DiscountCode&action=index">Quay lại</a>
                                </div>
                                <div class="box-footer">
                                    <input id="sub" type="submit" class="btn btn-primary" value="Thêm" />
                                </div>
                                <div>
                                    <a href="/manage_food/admin/index.php?controller=DiscountCode&action=index"></a>
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