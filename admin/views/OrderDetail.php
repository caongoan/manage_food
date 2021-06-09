<?php
include "Layout/header.php";
?>
<style>
    .wrapper {
        top: -20px;
    }
</style>
<div class="content-wrapper">
    <?php $order = new OrderController();
    $show_order = $order->OrderDetail();
    ?>
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Chi tiết đơn hàng
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">

                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Mã món ăn</th>
                                            <th>Tên món ăn</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($show_order) {
                                            $i = 0;
                                            while ($result = $show_order->fetch_assoc()) {
                                                $i++;

                                        ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i; ?></th>
                                                    <td><?php echo $result['dishId']; ?></td>
                                                    <td><?php echo $result['dishName']; ?></td>
                                                    <td><?php echo $result['quantity']; ?></td>
                                                    <td><?php echo $result['price']; ?></td>
                                                    <td><?php echo $result['intoMoney']; ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>


                                    </tbody>
                                </table>
                                <div>
                                    <a href="/manage_food/admin/index.php?controller=Order&action=index">Quay lại</a>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        <ul class="pagination">
                                            
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