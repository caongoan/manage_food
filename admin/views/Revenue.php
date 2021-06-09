<?php
include "Layout/header.php";
?>

<style>
    .wrapper {
        top: -20px;
    }
</style>
<div class="content-wrapper">
    <?php $st = new StatisticalController();
    $show_st = $st->revenue();
    ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách món ăn bán chạy trong tháng
        </h1>
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
                                        if ($show_st) {

                                            $i = 0;
                                            $sum_quantity = 0;
                                            $sum_money = 0;
                                            while ($result = $show_st->fetch_assoc()) {
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
                                                $sum_quantity += $result['quantity'];
                                                $sum_money += $result['intoMoney'];
                                            }
                                        }
                                        ?>


                                    </tbody>
                                </table>

                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        <div>Tổng số món ăn đã bán:<b><?php if (isset($sum_quantity)) echo $sum_quantity; ?></b></div>
                                        <div>Tổng doanh thu:<b><?php if (isset($sum_money)) echo $sum_money; ?></b></div>
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