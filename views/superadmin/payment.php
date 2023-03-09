<div style="background:#fff;padding:30px;">
    <h5>Add payment for</h5>
    <?php echo $_SESSION['stu_name']; ?>
    <hr />
    <?php 
        if($_POST['add']){
            
            extract($_POST);

            $tblquery = "SELECT * FROM payment WHERE stu_id = :stu_id AND level = :level AND item = :item";
            $tblvalue = array(
                ':stu_id' => htmlspecialchars($_SESSION['stu_id']),
                ':level' => htmlspecialchars($_SESSION['stu_level']),
                ':item' => htmlspecialchars($item)
            );
            $paymentCheck = $connect->tbl_select($tblquery, $tblvalue);
            if(!$paymentCheck){
                // getting additional field value
                $allFields = array();
                $tblquery = "SELECT * FROM morefields WHERE type = :type";
                $tblvalue = array(
                    ':type' => 'P'
                );
                $select = $connect->tbl_select($tblquery,$tblvalue);
                foreach($select as $data){
                    extract($data);
                    array_push($allFields, $name); 
                }

                $allMore = '';
                foreach($allFields as $data){
                    $a = "$data";
                    $allMore .= htmlspecialchars($$a . '?* ');
                }
                $allMore = rtrim($allMore, "?* ");
                $tblquery = "INSERT INTO payment VALUES(:id, :stu_id, :addedby, :level, :item, :amount, :tid, :pm, :note, :more, :date)";
                $tblvalue = array(
                    ':id' => NULL, 
                    ':stu_id' => htmlspecialchars($_SESSION['stu_id']),
                    ':addedby' => htmlspecialchars($_SESSION['myId']),
                    ':level' => htmlspecialchars($_SESSION['stu_level']),
                    ':item' => htmlspecialchars($item), 
                    ':amount' => htmlspecialchars($amount),
                    ':tid' => htmlspecialchars($tid),
                    ':pm' => htmlspecialchars($pm),
                    ':note' => htmlspecialchars($note),
                    ':more' => $allMore,
                    ':date' => htmlspecialchars($date)
                );
                $insert = $connect->tbl_insert($tblquery,$tblvalue);
                if($insert){
                    echo "<p class='text-success'>payment added</p>";
                    $level = $item = $amount = $tid = $pm = $note = $date = '';
                    $enter = true;
                }
            }else{
                echo "<p class='text-danger'>payment already made</p>";
            }
        }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-3">
                Item <br/>
                <select name="item" class="form-control" required>
                    <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
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
                                <option value='$name'>$name</option>
                            ";
                            $sn++;    
                        }
                    ?>
                </select>
            </div>
            <div class="col-lg-3">
                Amount <br/>
                <input type="number" name="amount" class="form-control" value="<?php echo $amount; ?>" required>
            </div>
            <div class="col-lg-3">
                Date <br/>
                <input type="date" name="date" class="form-control" value="<?php echo $date; ?>" required>
            </div>
            <div class="col-lg-3">
                Transaction ID <br/>
                <input type="text" name="tid" class="form-control" value="<?php echo $tid; ?>" required>
                <span class="main" style="color: blue;">
                    <?php echo $errEmail; ?>
                </span>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-3">
                Payment Method <br/>
                <select name="pm" class="form-control" required>
                    <option value="<?php echo $pm; ?>"><?php echo $pm; ?></option>
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
                                <option value='$name'>$name</option>
                            ";
                            $sn++;    
                        }
                    ?>
                </select>
            </div>
            <div class="col-lg-6">
                Note <br />
                <textarea name="note" rows="1" class="form-control"><?php echo $note; ?></textarea>
            </div>
            <?php
            
                $tblquery = "SELECT * FROM morefields WHERE type = :type";
                $tblvalue = array(
                    ':type' => 'P'
                );
                $select = $connect->tbl_select($tblquery,$tblvalue);
                foreach($select as $data){
                    extract($data);
                    if(!$enter){
                        $a = "$name";
                        $abc = $$a;
                    }
                    
                    echo "
                        <div class='col-lg-3'>
                            $content <br/>
                            <input type='text' name='$name' value='$abc' class='form-control'>
                        </div>
                    ";    
                }
            
            ?>
            <div class="col-lg-3">
                <br />
                <input type="submit" name="add" class="btn btn-primary" value="Add Payment">
            </div>
        </div>
    </form>
</div>

<br>

<div style="background:#fff;padding:30px;">
    <div class="row">
        <div class="col-12">
            <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Added By</th>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <?php
            
                            $tblquery = "SELECT * FROM morefields WHERE type = :type";
                            $tblvalue = array(
                                ':type' => 'P'
                            );
                            $select = $connect->tbl_select($tblquery,$tblvalue);
                            
                            if($select){
                                $selected = true; 
                                $numV = sizeof($select);
                                foreach($select as $data){
                                    extract($data);
                                    if(!$enter){
                                        $a = "$name";
                                        $abc = $$a;
                                    }
                                    
                                    echo "
                                        <th>$content</th>
                                    ";    
                                }
                            }
                        
                        ?> 
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        $tblquery = "SELECT * FROM payment WHERE stu_id = :stu_id AND level = :level ORDER BY item";
                        $tblvalue = array(
                            ':stu_id' => $_SESSION['stu_id'],
                            ':level' => $_SESSION['stu_level'],
                        );
                        $select = $connect->tbl_select($tblquery,$tblvalue);
                        if($select){
                            $addEmail = array();
                            foreach($select as $data){
                                extract($data);
                                $tblquery = "SELECT * FROM staff WHERE id = :id";
                                $tblvalue = array(
                                    ':id' => htmlspecialchars($addedby)
                                );
                                $sear = $connect->tbl_select($tblquery, $tblvalue);
                                foreach($sear as $data){
                                    extract($data);
                                    array_push($addEmail, $email);
                                }
                            }
                        }
                        if($select){
                            $sn = 1;
                            $snE = 0;
                            foreach($select as $data){
                                extract($data);
                                $moreFields = explode('?* ', $more);
                                echo "
                                    <tr>
                                        <td>$sn</td>
                                        <td>$addEmail[$snE]</td>
                                        <td>$item</td>
                                        <td>$amount</td>
                                        <td>$pm</td>
                                ";
                                        $numV;
                                        if($selected){
                                            for($i = 0; $i < $numV; $i++){
                                                if($moreFields[$i]){
                                                    echo "
                                                        <td>$moreFields[$i]</td>
                                                    ";
                                                }else{
                                                    echo "
                                                        <td>-</td>
                                                    ";
                                                }
                                            }
                                            
                                        }
                                    
                                echo "
                                        <td>$date</td>
                                    </tr>
                                ";
                                $sn++;
                                $snE++;    
                            }
                        }else{
                            echo "
                                <tr>
                                    <td colspan='5'>no payment made</td>
                                </tr>
                            ";
                        }
                        
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>