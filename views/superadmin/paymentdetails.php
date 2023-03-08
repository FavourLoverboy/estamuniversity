<div style="background:#fff;padding:30px;">
    <h3>Add item</h3>
    <hr />
    <?php 
        if($_POST['additem']){
            
            extract($_POST);
            
            $erritem = '';
            $tblquery = "SELECT * FROM additional_details WHERE name = :name";
            $tblvalue = array(
                ':name' => htmlspecialchars(ucwords($item))
            );
            $itemCheck = $connect->tbl_select($tblquery, $tblvalue);
            if(!$itemCheck){
                $tblquery = "INSERT INTO additional_details VALUES(:id, :name, :type)";
                $tblvalue = array(
                    ':id' => NULL, 
                    ':name' => htmlspecialchars(ucwords($item)), 
                    ':type' => "Item"
                );
                $insert = $connect->tbl_insert($tblquery,$tblvalue);
                if($insert){
                    echo "<p class='text-success'>Item added</p>";
                    $item = '';
                }
            }else{
                $errItem = "already exist";
            }
        }
        if($_POST['removeitem']){
            extract($_POST);
            $tblquery = "DELETE FROM additional_details WHERE id = :id";
            $tblvalue = array(
                ':id' => $id
            );
            $delete = $connect->tbl_delete($tblquery,$tblvalue);
        }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-9">
                Item <br />
                <input type="text" name="item" class="form-control" placeholder="" value="<?php echo $item; ?>" required>
                <span class="main">
                    <?php echo $errItem; ?>
                </span>
            </div>
            <div class="col-lg-3">
                <br />
                <input type="submit" name="additem" class="btn btn-primary" value="Add item">
            </div>
        </div>
    </form>

    <br>
    <table class="table table-bordered" style="font-family: Arial; font-size: 15px;">
        <thead>
            <tr>
                <th>SN</th>  
                <th>Items</th>      
                <th>Remove</th>      
            </tr>     
        </thead>  
        <tbody> 
            <?php
                $tblquery = "SELECT * FROM additional_details WHERE type = :type ORDER BY name";
                $tblvalue = array(
                    ':type' => 'Item'
                );
                $select = $connect->tbl_select($tblquery,$tblvalue);
                $sn = 1;
                foreach($select as $data){
                    extract($data);
                    echo "
                        <tr>
                            <td>$sn</td>
                            <td>$name</td>
                            <td>
                                <form action='' method='post'>
                                    <input type='hidden' name='id' value='$id'>
                                    <input type='submit' name='removeitem' class='btn btn-sm btn-danger' value='Remove'>
                                </form>
                            </td>
                        </tr>
                    ";
                    $sn++;    
                }
            ?> 
        </tbody>
    </table>
</div>

<br>

<div style="background:#fff;padding:30px;">
    <h3>Add Payment Method</h3>
    <hr />
    <?php 
        if($_POST['addpm']){
            
            extract($_POST);
            
            $errPm = '';
            $tblquery = "SELECT * FROM additional_details WHERE name = :name";
            $tblvalue = array(
                ':name' => htmlspecialchars(ucwords($pm))
            );
            $pmCheck = $connect->tbl_select($tblquery, $tblvalue);
            if(!$pmCheck){
                $tblquery = "INSERT INTO additional_details VALUES(:id, :name, :type)";
                $tblvalue = array(
                    ':id' => NULL, 
                    ':name' => htmlspecialchars(ucwords($pm)), 
                    ':type' => "PM"
                );
                $insert = $connect->tbl_insert($tblquery,$tblvalue);
                if($insert){
                    echo "<p class='text-success'>Payment Method added</p>";
                    $pm = '';
                }
            }else{
                $errPm = "already exist";
            }
        }
        if($_POST['removepm']){
            extract($_POST);
            $tblquery = "DELETE FROM additional_details WHERE id = :id";
            $tblvalue = array(
                ':id' => $id
            );
            $delete = $connect->tbl_delete($tblquery,$tblvalue);
        }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-9">
                Payment Method <br />
                <input type="text" name="pm" class="form-control" value="<?php echo $pm; ?>" required>
                <span class="main">
                    <?php echo $errPm; ?>
                </span>
            </div>
            <div class="col-lg-3">
                <br />
                <input type="submit" name="addpm" class="btn btn-primary" value="Add Method">
            </div>
        </div>
    </form>

    <br>
    <table class="table table-bordered" style="font-family: Arial; font-size: 15px;">
        <thead>
            <tr>
                <th>SN</th>  
                <th>Method</th>      
                <th>Remove</th>      
            </tr>     
        </thead>  
        <tbody> 
            <?php
                $tblquery = "SELECT * FROM additional_details WHERE type = :type ORDER BY name";
                $tblvalue = array(
                    ':type' => 'PM'
                );
                $select = $connect->tbl_select($tblquery,$tblvalue);
                $sn = 1;
                foreach($select as $data){
                    extract($data);
                    echo "
                        <tr>
                            <td>$sn</td>
                            <td>$name</td>
                            <td>
                                <form action='' method='post'>
                                    <input type='hidden' name='id' value='$id'>
                                    <input type='submit' name='removepm' class='btn btn-sm btn-danger' value='Remove'>
                                </form>
                            </td>
                        </tr>
                    ";
                    $sn++;    
                }
            ?> 
        </tbody>
    </table>
</div>