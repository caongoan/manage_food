<?php
include "Layout/header.php";
?>
<?php
$ac = new AccountController();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $update = $ac->ChangePassword();
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Đổi mật khẩu
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="POST">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Thay đổi mật khẩu </h3>
                                <br/>
                                <?php
                                if (isset($update)) {
                                    echo $update;
                                } ?>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Mật khẩu cũ</label>
                                            <input type="password" class="form-control" placeholder="Mật khẩu cũ" name="OldPass">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mật khẩu mới</label>
                                            <input type="password" class="form-control" placeholder="Mật khẩu mới" name="NewPass">
                                        </div>
                                        <!-- /.form-group -->

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nhập lại mật khẩu</label>
                                            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="RetypePass">
                                        </div>
                                        <!-- /.form-group -->

                                    </div>

                                    <!-- /.col -->
                                </div>
                                <div class="box-footer">
                                    <input type="submit" class="btn btn-primary" value="Đổi mật khẩu" />
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->

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