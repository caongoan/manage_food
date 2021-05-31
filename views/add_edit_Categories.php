<?php 
    $layout = "layout.php";
 ?>
<div class="col-md-12">  
    <div class="panel panel-primary">
        <div class="panel-heading">Add edit category</div>
        <div class="panel-body">
        <form method="post" action="<?php echo $formAction; ?>">
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Name</div>
                <div class="col-md-10">
                    <input type="text" value="<?php echo isset($record->name)?$record->name:''; ?>" name="name" class="form-control" required>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Danh mục cha</div>
                <div class="col-md-10">
                    <select name="parent_id">
                        <option value="0"></option>
                        <?php 
                            //lay cac danh muc cap cha
                            $categories = DB::fetchAll("select * from categories where parent_id = 0 order by id desc");
                         ?>
                         <?php foreach($categories as $rows): ?>
                        <option <?php if(isset($record->id) && $rows->id==$record->parent_id): ?> selected <?php endif; ?> value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>
                            <?php 
                                //liet ke cac danh muc cap con thuoc danh muc nay
                                $subCategory = DB::fetchAll("select * from categories where parent_id=".$rows->id." order by id desc");
                             ?>
                         <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- end rows -->
            
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <input type="submit" value="Process" class="btn btn-primary">
                </div>
            </div>
            <!-- end rows -->
        </form>
        </div>
    </div>
</div>