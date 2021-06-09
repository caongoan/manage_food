<?php
include "Layout/header.php";
?>
<style>
    .wrapper {
        top: -20px;
    }
</style>
<div class="content-wrapper">
    <?php $dc = new DiscountCodeController();
    $show_dc = $dc->ListDiscountCode();
    if (isset($_GET['discountId'])) {
        $del = $dc->Delete();
    }
    if (isset($_POST['searchString'])) {
        $name = $_POST['searchString'];
    } else {
        $name = "";
    }
    $dc_count = $dc->list_all($name)
    ?>
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách mã giảm giá
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
                            $show_dc = $dc->ListDiscountCode();
                        } 
                        ?>
                        <a href="/manage_food/admin/index.php?controller=DiscountCode&action=indexAdd">Thêm mới</a>

                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Mã giảm giá</th>
                                            <th>Số lượng</th>
                                            <th>Lượng giảm</th>
                                            <th>Loại</th>
                                            <th>Xử lý</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($show_dc) {
                                            $i = 0;
                                            while ($result = $show_dc->fetch_assoc()) {
                                                $i++;

                                        ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i; ?></th>
                                                    <td><?php echo $result['discountCode']; ?></td>
                                                    <td><?php echo $result['amount']; ?></td>
                                                    <td><?php echo $result['details']; ?></td>
                                                    <td><?php echo $result['typeName']; ?></td>
                                                    <td>
                                                        <a href="/manage_food/admin/index.php?controller=DiscountCode&action=indexEdit&Id=<?php echo $result['discountId']; ?>">
                                                            <span class="glyphicon glyphicon-edit">
                                                            </span>
                                                        </a>

                                                        <a href="/manage_food/admin/index.php?controller=DiscountCode&action=index&discountId=<?php echo $result['discountId']; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')">
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
                                            if ($dc_count) {
                                                $count = mysqli_num_rows($dc_count);
                                                $count_page = ceil($count / 10); //ceil làm tròn
                                                for ($i = 1; $i <= $count_page; $i++) {
                                                    echo '<li class="paginate_button page-item "><a href="/manage_food/admin/index.php?controller=dcegories&action=index&page=' . $i . '" class="page-link">' . $i . '</a></li>';
                                            }}
                                            
                                            ?> 
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