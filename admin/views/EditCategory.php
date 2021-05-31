<?php
include "Layout/header.php";
?>
<?php
$cat = new CategoriesController();
$list_category = $cat->list_category();
$id=$_GET['Id'];
$category_by_name=$cat->category_by_id($id);
if (isset($_GET['catId'])) {
    $edit = $cat->Edit($id);
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa danh mục món ăn
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form>
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Sửa</h3>
                                <?php
                                                if (isset($edit)) {
                                                    header("Location:/manage_food/admin/index.php?controller=Categories&action=index");
                                                } ?>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Danh mục món ăn</label>
                                            <select class="form-control" name="catId">

                                            <?php
                                                if ($category_by_name) {
                                                    while ($results = $category_by_name->fetch_assoc()) {

                                                ?> 
                                                
                                            <option selected value=" <?php echo $id ?> "> <?php echo $results['catName'] ?> </option>
                                            <?php
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if ($list_category) {
                                                    while ($result = $list_category->fetch_assoc()) {

                                                ?>
                                                        <option value=" <?php echo $result['catId'] ?> "> <?php echo $result['catName'] ?> </option>

                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" name="Id" value="<?php echo $id ;?>" />
                                            <input type="hidden" name="controller" value="Categories" />
                                            <input type="hidden" name="action" value="indexEdit" />
                                            
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <!-- /.col -->
                                </div>
                                <div class="box-footer">
                                    <input type="submit" class="btn btn-primary" value="Sửa" />
                                </div>
                                <div>
                                    <a href="/manage_food/admin/index.php?controller=Categories&action=index"></a>
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