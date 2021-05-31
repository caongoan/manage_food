<?php 
    //load file layout
    $layout = "layout.php";
 ?>
<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="index.php?controller=products&action=add" class="btn btn-primary">Add product</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">List product</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th style="width:100px; max-height: 115px;">Image</th>
                    <th>Title</th>
                    <th style="width: 200px;">Category</th>
                    <th style="width: 100px">Discount</th>
                    <th style="width: 70px;">Hot product</th>
                    <th style="width:150px;"></th>
                </tr>
                <?php foreach($data as $rows): ?>
                <tr>
                    <td>
                        <?php if(file_exists("../frontend/assets/upload/products/".$rows->photo)): ?>
                            <img src="../frontend/assets/upload/Products/<?php echo $rows->photo; ?>" style="width: 100px; max-height: 100px; overflow: hidden;">
                        <?php endif; ?>
                    </td>
                    <td><?php echo $rows->name; ?></td>
                    <td>
    <?php 
        //truy van truc tiep
        //lay bien ket noi
        $conn = Connection::getInstance();
        //thuc thi cau truy van
        $query = $conn->query("select name from categories where id=".$rows->category_id);
        //lay mot ban ghi
        $category = $query->fetch();
        echo isset($category->name)?$category->name:"";
     ?>
                    </td>
                    <td style="text-align: center;"><?php echo $rows->discount; ?>%</td>
                    <td style="text-align: center;">
                    <?php if($rows->hot == 1): ?>
                        <span class="fa fa-check" style="color: lime;"></span>
                    <?php endif; ?>
                    </td>
                    <td style="text-align:center;">
                        <a href="index.php?controller=products&action=edit&id=<?php echo $rows->id; ?>">Edit</a>&nbsp;|
                        <a href="index.php?controller=products&action=delete&id=<?php echo $rows->id; ?>" onclick="return window.confirm('Are you sure?');" style="text-decoration: underline;color: #d9534f;">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#">Trang</a></li>
                <?php for($i = 1; $i <= $numPage; $i++): ?>
                <li class="page-item"><a class="page-link" href="index.php?controller=products&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>