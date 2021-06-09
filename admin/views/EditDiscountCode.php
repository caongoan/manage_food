<?php
include "Layout/header.php";
?>
<?php
$dc = new DiscountCodeController();
$id = $_GET['Id'];
$list_type = $dc->list_code_type();
$list = $dc->discount_code_by_id($id);
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $edit = $dc->Edit();
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa mã giảm giá
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="POST">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Sửa</h3>
                                <?php
                                if (isset($edit)) {
                                    header("Location:/manage_food/admin/index.php?controller=DiscountCode&action=index");
                                } ?>
                            </div>
                            <!-- /.box-header -->
                            <?php

                            if ($list) {
                                while ($result = $list->fetch_assoc()) {
                                    # code...

                            ?>
                                    <div class="box-body">
                                    <input type="hidden" name="Id" value="<?php echo $result['discountId']; ?>" />
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Mã giảm giá</label>
                                                <input type="text" class="form-control" placeholder="Nhập mã giảm giá..." name="discountCode" value="<?php echo $result['discountCode']; ?>" />
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="name">Số lượng</label>
                                                <input type="number" class="form-control" placeholder="Nhập số lượng..." name="amount" min="1" value="<?php echo $result['amount']; ?>" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Lượng giảm</label>
                                                    <input type="text" class="form-control" placeholder="Nhập lượng giảm..." name="details" value="<?php echo $result['details']; ?> " />
                                                </div>
                                                <div class="form-group">

                                                    <label for="name">Loại mã giảm giá</label>
                                                    <select class="form-control" name="typeId">

                                                        <option selected value=" <?php echo $result['typeId'];  ?> "> <?php echo $result['typeName'] ?> </option>
                                                        <?php
                                                        if ($list_type) {
                                                            while ($results = $list_type->fetch_assoc()) {

                                                        ?>
                                                                <option value=" <?php echo $results['typeId'] ?> "> <?php echo $results['typeName'] ?> </option>

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

                                        <div class="box-footer">
                                            <input id="sub" type="submit" class="btn btn-primary" value="Sửa" />
                                        </div>

                                        <!-- /.row -->
                                    </div>
                                    <!-- /.box-body -->
                            <?php }
                            } ?>

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