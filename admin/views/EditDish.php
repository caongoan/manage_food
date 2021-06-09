<?php
include "Layout/header.php";
?>
<?php
$dish = new DishController();
$id = $_GET['Id'];
$list_cat = $dish->list_cat();
$list_status = $dish->list_status();
$list = $dish->dish_by_id($id);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $edit = $dish->Edit($_FILES);
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa danh mục món ăn
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Sửa</h3>
                                <?php
                                if (isset($edit)) {
                                    header("Location:/manage_food/admin/index.php?controller=Dish&action=index");
                                } ?>
                            </div>
                            <!-- /.box-header -->
                            <?php

                            if ($list) {
                                while ($result = $list->fetch_assoc()) {
                                    # code...

                            ?>
                             <input type="hidden" name="Id" value="<?php echo $result['dishId']; ?>" />
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Tên món ăn</label>
                                                    <input type="text" class="form-control" placeholder="Nhập tên món ăn..." name="dishName" value="<?php echo $result['dishName'];?>" />
                                                </div>
                                                <!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="name">Hình ảnh</label>
                                                    <input type="file" class="form-control"  name="images" />
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Giá</label>
                                                    <input type="number" class="form-control" placeholder="Nhập giá..." name="price" value="<?php echo $result['price'];?>" />
                                                </div>
                                                <div class="form-group">

                                                    <label for="name">Danh mục</label>
                                                    <select class="form-control" name="catId">

                                                        <option selected value="<?php echo $result['catId'];?>"><?php echo $result['catName'];?></option>
                                                        <?php
                                                        if ($list_cat) {
                                                            while ($results = $list_cat->fetch_assoc()) {

                                                        ?>
                                                                <option value=" <?php echo $results['catId'] ?> "> <?php echo $results['catName'] ?> </option>

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
                                                    <select class="form-control" name="dishStatusId">

                                                    <option selected value="<?php echo $result['dishStatusId'];?>"><?php echo $result['dishStatusName'];?></option>
                                                        <?php
                                                        if ($list_status) {
                                                            while ($result1 = $list_status->fetch_assoc()) {

                                                        ?>
                                                                <option value=" <?php echo $result1['dishStatusId'] ?> "> <?php echo $result1['dishStatusName'] ?> </option>

                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <input id="sub" type="submit" class="btn btn-primary" value="Sửa" />
                                        </div>
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