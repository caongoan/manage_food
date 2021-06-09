<?php
include "Layout/header.php";
?>
<?php
$ac = new AccountController();
$pr = $ac->profile_detail();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $update = $ac->update_image($_FILES);
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thông tin
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Hồ sơ</h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                <?php
                                            if (isset($update)) {
                                                echo $update;
                                                echo '<br/>';
                                                
                                               
                                            } ?>
                                    <?php
                                    if ($pr) {
                                        while ($result = $pr->fetch_assoc()) {

                                    ?>
                                            
                                            <img class="profile-user-img img-responsive img-circle" src="uploads/<?php echo $result['images'] ?>" alt="User profile picture">
                                            <br />

                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <div style="margin-left: 45%"> <input type="file" name="images" style="width:75px;float:left;" /><input type="submit" style="height: 23px;" value="Đổi ảnh" /></div>
                                            </form>
                                            <h3 class="profile-username text-center"><?php echo $result['AdminName']; ?></h3>

                                            <ul class="list-group list-group-unbordered" style="margin-left: 30%;margin-right: 30%;">
                                                <li class="list-group-item">
                                                    <b>Tên </b> <a class="pull-right"><?php echo $result['AdminName']; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Tên cửa hàng</b> <a class="pull-right"><?php echo $result['StoreName']; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Email</b><a class="pull-right"><?php echo $result['AdminEmail']; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Địa chỉ</b><a class="pull-right"><?php echo $result['Address']; ?></a>
                                                </li>

                                            </ul>
                                    <?php }
                                    } ?>

                                </div>
                                <!-- /.box-body -->
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