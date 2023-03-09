<div style="background:#fff;padding:30px;">
    <h3>Add More Student Fields</h3>
    <hr />
    <?php 
        if($_POST['addstudent']){
            
            extract($_POST);
            
            $errstudent = '';
            $tblquery = "SELECT * FROM morefields WHERE content = :content";
            $tblvalue = array(
                ':content' => htmlspecialchars(ucwords($field))
            );
            $studentCheck = $connect->tbl_select($tblquery, $tblvalue);
            if(!$studentCheck){
                $tblquery = "INSERT INTO morefields VALUES(:id, :name, :content, :type)";
                $tblvalue = array(
                    ':id' => NULL, 
                    ':name' => htmlspecialchars(uniqid()), 
                    ':content' => htmlspecialchars(ucwords($field)), 
                    ':type' => "S"
                );
                $insert = $connect->tbl_insert($tblquery,$tblvalue);
                if($insert){
                    echo "<p class='text-success'>Field added</p>";
                    $field = '';
                }
            }else{
                $errstudent = "already exist";
            }
        }
        if($_POST['removestu']){
            extract($_POST);
            $tblquery = "DELETE FROM morefields WHERE id = :id";
            $tblvalue = array(
                ':id' => $id
            );
            $delete = $connect->tbl_delete($tblquery,$tblvalue);
        }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-9">
                Student field <br />
                <input type="text" name="field" class="form-control" value="<?php echo $field; ?>" required>
                <span class="main">
                    <?php echo $errstudent; ?>
                </span>
            </div>
            <div class="col-lg-3">
                <br />
                <input type="submit" name="addstudent" class="btn btn-primary" value="Add field">
            </div>
        </div>
    </form>

    <br>
    <table class="table table-bordered" style="font-family: Arial; font-size: 15px;">
        <thead>
            <tr>
                <th>SN</th>  
                <th>Fields</th>      
                <th>Remove</th>      
            </tr>     
        </thead>  
        <tbody> 
            <?php
                $tblquery = "SELECT * FROM morefields WHERE type = :type ORDER BY name";
                $tblvalue = array(
                    ':type' => 'S'
                );
                $select = $connect->tbl_select($tblquery,$tblvalue);
                $sn = 1;
                foreach($select as $data){
                    extract($data);
                    echo "
                        <tr>
                            <td>$sn</td>
                            <td>$content</td>
                            <td>
                                <form action='' method='post'>
                                    <input type='hidden' name='id' value='$id'>
                                    <input type='submit' name='removestu' class='btn btn-sm btn-danger' value='Remove'>
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
    <h3>Add More Payment Fields</h3>
    <hr />
    <?php 
        if($_POST['addpayment']){
            
            extract($_POST);
            
            $errPayment = '';
            $tblquery = "SELECT * FROM morefields WHERE content = :content";
            $tblvalue = array(
                ':content' => htmlspecialchars(ucwords($payment))
            );
            $paymentCheck = $connect->tbl_select($tblquery, $tblvalue);
            if(!$paymentCheck){
                $tblquery = "INSERT INTO morefields VALUES(:id, :name, :content, :type)";
                $tblvalue = array(
                    ':id' => NULL, 
                    ':name' => htmlspecialchars(uniqid()), 
                    ':content' => htmlspecialchars(ucwords($payment)), 
                    ':type' => "P"
                );
                $insert = $connect->tbl_insert($tblquery,$tblvalue);
                if($insert){
                    echo "<p class='text-success'>Field added</p>";
                    $payment = '';
                }
            }else{
                $errPayment = "already exist";
            }
        }
        if($_POST['removepayment']){
            extract($_POST);
            $tblquery = "DELETE FROM morefields WHERE id = :id";
            $tblvalue = array(
                ':id' => $id
            );
            $delete = $connect->tbl_delete($tblquery,$tblvalue);
        }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-9">
                Payment Field <br />
                <input type="text" name="payment" class="form-control" value="<?php echo $payment; ?>" required>
                <span class="main">
                    <?php echo $errPayment; ?>
                </span>
            </div>
            <div class="col-lg-3">
                <br />
                <input type="submit" name="addpayment" class="btn btn-primary" value="Add field">
            </div>
        </div>
    </form>

    <br>
    <table class="table table-bordered" style="font-family: Arial; font-size: 15px;">
        <thead>
            <tr>
                <th>SN</th>  
                <th>Fields</th>      
                <th>Remove</th>      
            </tr>     
        </thead>  
        <tbody> 
            <?php
                $tblquery = "SELECT * FROM morefields WHERE type = :type ORDER BY name";
                $tblvalue = array(
                    ':type' => 'P'
                );
                $select = $connect->tbl_select($tblquery,$tblvalue);
                $sn = 1;
                foreach($select as $data){
                    extract($data);
                    echo "
                        <tr>
                            <td>$sn</td>
                            <td>$content</td>
                            <td>
                                <form action='' method='post'>
                                    <input type='hidden' name='id' value='$id'>
                                    <input type='submit' name='removepayment' class='btn btn-sm btn-danger' value='Remove'>
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
    <h3>Add More Result Fields</h3>
    <hr />
    <?php 
        if($_POST['addresult']){
            
            extract($_POST);
            
            $errResult = '';
            $tblquery = "SELECT * FROM morefields WHERE content = :content";
            $tblvalue = array(
                ':content' => htmlspecialchars(ucwords($result))
            );
            $resultCheck = $connect->tbl_select($tblquery, $tblvalue);
            if(!$resultCheck){
                $tblquery = "INSERT INTO morefields VALUES(:id, :name, :content, :type)";
                $tblvalue = array(
                    ':id' => NULL, 
                    ':name' => htmlspecialchars('var' . uniqid()), 
                    ':content' => htmlspecialchars(ucwords($result)), 
                    ':type' => "R"
                );
                $insert = $connect->tbl_insert($tblquery,$tblvalue);
                if($insert){
                    echo "<p class='text-success'>field added</p>";
                    $result = '';
                }
            }else{
                $errResult = "already exist";
            }
        }
        if($_POST['removeresult']){
            extract($_POST);
            $tblquery = "DELETE FROM morefields WHERE id = :id";
            $tblvalue = array(
                ':id' => $id
            );
            $delete = $connect->tbl_delete($tblquery,$tblvalue);
        }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-9">
                Result Field <br />
                <input type="text" name="result" class="form-control" value="<?php echo $result; ?>" required>
                <span class="main">
                    <?php echo $errResult; ?>
                </span>
            </div>
            <div class="col-lg-3">
                <br />
                <input type="submit" name="addresult" class="btn btn-primary" value="Add field">
            </div>
        </div>
    </form>

    <br>
    <table class="table table-bordered" style="font-family: Arial; font-size: 15px;">
        <thead>
            <tr>
                <th>SN</th>  
                <th>Fields</th>      
                <th>Remove</th>      
            </tr>     
        </thead>  
        <tbody> 
            <?php
                $tblquery = "SELECT * FROM morefields WHERE type = :type ORDER BY name";
                $tblvalue = array(
                    ':type' => 'R'
                );
                $select = $connect->tbl_select($tblquery,$tblvalue);
                $sn = 1;
                foreach($select as $data){
                    extract($data);
                    echo "
                        <tr>
                            <td>$sn</td>
                            <td>$content</td>
                            <td>
                                <form action='' method='post'>
                                    <input type='hidden' name='id' value='$id'>
                                    <input type='submit' name='removeresult' class='btn btn-sm btn-danger' value='Remove'>
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