<?php 
    //load file layout
    $layout = "layout.php";
 ?>
<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="index.php?controller=categories&action=add" class="btn btn-primary">Add Category</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">List Category</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Category name</th>
                    <th style="width:160px;"></th>
                </tr>
                <?php foreach($data as $rows): ?>
                <tr>
                    <td><?php echo $rows->name; ?></td>
                    <td style="text-align:center;">
                        <a href="index.php?controller=categories&action=edit&id=<?php echo $rows->id; ?>">Edit</a>&nbsp;|
                        <a href="index.php?controller=categories&action=delete&id=<?php echo $rows->id; ?>" onclick="return window.confirm('Are you sure?');" style="text-decoration: underline;color: #d9534f;">Delete</a>
                    </td>
                </tr>
                <?php 
                    // liet ke cac muc cap con thuoc muc nay
                    $subCategory = DB::fetchAll("select * from categories where parent_id=" .$rows->id." order by id desc");
                 ?>
                 <?php foreach($subCategory as $subRows){ ?>
                    <tr>
                        <td style="padding-left: 35px;"><?php echo $subRows->name; ?></td>
                        <td style="text-align:center;">
                            <a href="index.php?controller=categories&action=edit&id=<?php echo $subRows->id; ?>">Edit</a>&nbsp;|
                            <a href="index.php?controller=categories&action=delete&id=<?php echo $subRows->id; ?>" onclick="return window.confirm('Are you sure?');"style="text-decoration: underline; color: #d9534f;">Delete</a>
                        </td>
                    </tr>
                 <?php } ?>
                <?php endforeach; ?>
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#">Trang</a></li>
                <?php for($i = 1; $i <= $numPage; $i++): ?>
                <li class="page-item"><a class="page-link" href="index.php?controller=categories&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>