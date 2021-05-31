<?php 
    //load file layout
    $layout = "layout.php";
 ?>
<div class="col-md-12">  
    <div class="panel panel-primary">
        <div class="panel-heading">Add edit product</div>
        <div class="panel-body">
        <!-- neu muon load anh thi phai cho thuoc tinh enctype="multipart/form-data" -->
        <form method="post" enctype="multipart/form-data" action="<?php echo $formAction; ?>">
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
                <div class="col-md-2">Price</div>
                <div class="col-md-10">
                    <input type="number" min=0 value="<?php echo isset($record->price)?$record->price:'0'; ?>" name="price" class="form-control" required>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">% Discount (% Giảm giá)</div>
                <div class="col-md-10">
                    <input type="number" min=0 max=100 value="<?php echo isset($record->discount)?$record->discount:'0'; ?>" name="discount" class="form-control" required>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Category</div>
                <div class="col-md-10">
                    <select name="category_id" class="form-control" style="width: 300px;">
                    <?php 
                        //lay bien ket noi
                        $conn = Connection::getInstance();
                        //liet ke cap 1
                        $query1 = $conn->query("select * from categories where parent_id = 0 order by id desc");
                        foreach($query1 as $rows1):
                     ?>
                            <option <?php if(isset($record->category_id)&&$record->category_id==$rows1->id): ?> selected <?php endif; ?> value="<?php echo $rows1->id; ?>"><?php echo $rows1->name; ?></option>
                            <?php 
                                //liet ke cap 2
                                $query2 = $conn->query("select * from categories where parent_id=".$rows1->id." order by id desc");
                                foreach($query2 as $rows2):
                             ?>
                             <option <?php if(isset($record->category_id)&&$record->category_id==$rows2->id): ?> selected <?php endif; ?> value="<?php echo $rows2->id; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rows2->name; ?></option>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Descripition</div>
                <div class="col-md-10">
                    <textarea name="description" id="description"><?php echo isset($record->description)?$record->description:''; ?></textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace('description');
                    </script>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Content</div>
                <div class="col-md-10">
                    <textarea name="content" id="content"><?php echo isset($record->content)?$record->content:''; ?></textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace('content');
                    </script>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <input type="checkbox" <?php if (isset($record->hot)&&$record->hot==1): ?> checked <?php endif; ?> name="hot" id="hot"> <label for="hot">Hot</label>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Upload image</div>
                <div class="col-md-10">
                    <input type="file" name="photo">
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