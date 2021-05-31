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
    if (isset($_GET['catId'])) {
        $del = $dc->Delete($_GET['catId']);
    }
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

                        <form action="">
                            <div class="row">
                                <div>
                                    <div class="new_input-form">
                                        <input type="hidden" name="controller" value="DiscountCode" />
                                        <input type="hidden" name="action" value="index" />
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
                        } ?>
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
                                                        <a href="/manage_food/admin/index.php?controller=Categories&action=indexEdit&Id=<?php echo $result['catId']; ?>">
                                                            <span class="glyphicon glyphicon-edit">
                                                            </span>
                                                        </a>

                                                        <a href="/manage_food/admin/index.php?controller=Categories&action=index&catId=<?php echo $result['catId']; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')">
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
                                            <li class="paginate_button page-item previous" id="example1_previous">
                                                <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                            </li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                            </li>
                                            <li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                            <li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">Next</a></li>
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