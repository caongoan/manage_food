<?php
include "Layout/header.php";
?>
<style>
    .wrapper {
        top: -20px;
    }
</style>
<div class="content-wrapper">
    <?php $dish = new DishController();
    $show_dish = $dish->ListDish();
    if (isset($_GET['dishId'])) {
        $del = $dish->Delete();
    }
    if (isset($_POST['searchString'])) {
        $name = $_POST['searchString'];
    } else {
        $name = "";
    }
    $dish_count = $dish->list_all($name)
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách món ăn
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">

                        <form action="" method="POST">
                            <div class="row">
                                <div>
                                    <div class="new_input-form">
                                        <input type="text" name="searchString" />

                                    </div>
                                    <div>
                                        <button type="submit">Tìm kiếm</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        
                        if (isset($del)) {
                            echo $del;
                            echo '<br/>';
                            $show_dish = $dish->ListDish();
                        } 
                        ?>
                        <a href="/manage_food/admin/index.php?controller=Dish&action=indexAdd">Thêm mới</a>

                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tên món ăn</th>
                                            <th>Hình ảnh</th>
                                            <th>Giá</th>
                                            <th>Danh mục món ăn</th>
                                            <th>Trạng thái</th>
                                            <th>Xử lý</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($show_dish) {
                                            $i = 0;
                                            while ($result = $show_dish->fetch_assoc()) {
                                                $i++;

                                        ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i; ?></th>
                                                    <td><?php echo $result['dishName']; ?></td>
                                                    <td><img src="uploads/<?php echo $result['images'] ?>" width="80"></td>
                                                    <td><?php echo $result['price']; ?></td>
                                                    <td><?php echo $result['catName']; ?></td>
                                                    <td><?php echo $result['dishStatusName']; ?></td>
                                                    <td>
                                                        <a href="/manage_food/admin/index.php?controller=Dish&action=indexEdit&Id=<?php echo $result['dishId']; ?>">
                                                            <span class="glyphicon glyphicon-edit">
                                                            </span>
                                                        </a>

                                                        <a href="/manage_food/admin/index.php?controller=Dish&action=index&dishId=<?php echo $result['dishId']; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </a>
                                                    </td>

                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>


                                    </tbody>
                                </table>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        <ul class="pagination">
                                        <?php
                                            if ($dish_count) {
                                                $count = mysqli_num_rows($dish_count);
                                                $count_page = ceil($count / 10); //ceil làm tròn
                                                for ($i = 1; $i <= $count_page; $i++) {
                                                    echo '<li class="paginate_button page-item "><a href="/manage_food/admin/index.php?controller=dishegories&action=index&page=' . $i . '" class="page-link">' . $i . '</a></li>';
                                            }}
                                            
                                            ?> 
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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