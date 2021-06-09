<?php
include "Layout/header.php";
?>
<style>
    .wrapper {
        top: -20px;
    }
</style>
<div class="content-wrapper">
    <?php $order = new orderController();
    $show_order = $order->Listorder();
    $list_status = $order->list_status();
    if (isset($_GET['orderId']) && isset($_GET['statusId'])) {
        $update = $order->Update();
    }
    if (isset($_POST['idStatus'])) {
        $statusId = $_POST['idStatus'];
    } else {
        $statusId = '';
    }
    $order_count = $order->list_all($statusId)
    ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách đơn hàng
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
                                    <select name="idStatus" style="float: left;margin-left:2rem;margin-right:2rem;">

                                        <option>Chọn trạng thái</option>
                                        <?php
                                        if ($list_status) {
                                            while ($result = $list_status->fetch_assoc()) {

                                        ?>
                                                <option value=" <?php echo $result['statusId'] ?> "> <?php echo $result['statusName'] ?> </option>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div>
                                        <button type="submit">Tìm kiếm</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php

                        if (isset($update)) {
                            echo $update;
                            echo '<br/>';
                            $show_order = $order->Listorder();
                        }
                        ?>

                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Ngày đặt</th>
                                            <th>Mã khách hàng</th>
                                            <th>Khách hàng</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Xử lý</th>
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
                                                    <td><?php echo $result['dateOrder']; ?></td>
                                                    <td><?php echo $result['customerId']; ?></td>
                                                    <td><?php echo '<a href="/manage_food/admin/index.php?controller=Order&action=indexCustomer&customerId=' . $result['customerId'] . '">Xem khách hàng</a>'; ?></td>
                                                    <td><?php echo $result['totalPrice']; ?></td>
                                                    <td><?php echo $result['statusName']; ?></td>
                                                    <td>
                                                        <?php if ($result['statusId'] == 1) {
                                                            echo '<a href="/manage_food/admin/index.php?controller=Order&action=index&orderId=' . $result['id'] . '&statusId=2">Xác nhận</a>';
                                                            echo '|';
                                                            echo '<a href="/manage_food/admin/index.php?controller=Order&action=index&orderId=' . $result['id'] . '&statusId=5">Hủy</a>';
                                                        } else if ($result['statusId'] == 2) {
                                                            echo '<a href="/manage_food/admin/index.php?controller=Order&action=index&orderId=' . $result['id'] . '&statusId=3">Giao hàng</a>';
                                                        }

                                                        ?>
                                                        |
                                                        <a href="/manage_food/admin/index.php?controller=Order&action=indexOrderDetail&Id=<?php echo $result['id']; ?>">
                                                            Xem thông tin
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
                                            if ($order_count) {
                                                $count = mysqli_num_rows($order_count);
                                                $count_page = ceil($count / 10); //ceil làm tròn
                                                for ($i = 1; $i <= $count_page; $i++) {
                                                    echo '<li class="paginate_button page-item "><a href="/manage_food/admin/index.php?controller=orderegories&action=index&page=' . $i . '" class="page-link">' . $i . '</a></li>';
                                                }
                                            }

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