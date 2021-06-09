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
    $customer_detail = $order->CustomerDetail();
    ?>
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Chi tiết khách hàng
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
                                            <th>Mã khách hàng</th>
                                            <th>Tên khách hàng</th>
                                            <th>Địa chỉ</th>
                                            <th>Điện thoại</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($customer_detail) {
                                            while ($result = $customer_detail->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $result['customerId']; ?></td>
                                                    <td><?php echo $result['customerName']; ?></td>
                                                    <td><?php echo $result['address']; ?>|<a href="/manage_food/admin/index.php?controller=Order&action=Map&address=<?php echo $result['address']; ?>">Xem chi tiết</a></td>
                                                    <td><?php echo $result['phone']; ?></td>
                                                    
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