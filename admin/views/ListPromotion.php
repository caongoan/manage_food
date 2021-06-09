<?php
include "Layout/header.php";
?>
<style>
    .wrapper {
        top: -20px;
    }
</style>
<div class="content-wrapper">
    <?php $promotion = new PromotionController();
    $show_promotion = $promotion->ListPromotion();
    if (isset($_GET['promotionId'])) {
        $del = $promotion->Delete();
    }
    if (isset($_POST['searchString'])) {
        $name = $_POST['searchString'];
    } else {
        $name = "";
    }
    $promotion_count = $promotion->list_all($name)
    ?>
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách giá món ăn mới
        </h1>
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
                            $show_promotion = $promotion->ListPromotion();
                        } 
                        ?>
                        <a href="/manage_food/admin/index.php?controller=Promotion&action=indexAdd">Thêm mới</a>

                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Món ăn</th>
                                            <th>Giá mới</th>
                                            <th>Xử lý</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($show_promotion) {
                                            $i = 0;
                                            while ($result = $show_promotion->fetch_assoc()) {
                                                $i++;

                                        ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i; ?></th>
                                                    <td><?php echo $result['startDate']; ?></td>
                                                    <td><?php echo $result['endDate']; ?></td>
                                                    <td><?php echo $result['dishName']; ?></td>
                                                    <td><?php echo $result['promotionPrice']; ?></td>
                                                    <td>
                                                        <a href="/manage_food/admin/index.php?controller=Promotion&action=index&promotionId=<?php echo $result['promotionId']; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')">
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
                                            if ($promotion_count) {
                                                $count = mysqli_num_rows($promotion_count);
                                                $count_page = ceil($count / 10); //ceil làm tròn
                                                for ($i = 1; $i <= $count_page; $i++) {
                                                    echo '<li class="paginate_button page-item "><a href="/manage_food/admin/index.php?controller=promotionegories&action=index&page=' . $i . '" class="page-link">' . $i . '</a></li>';
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