<div style="background:#fff;padding:30px;">
    <h3>Add payment</h3>
    <hr />
    <?php 
        if($_POST){
            
            extract($_POST);

            $tblquery = "SELECT * FROM payment WHERE stu_id = :stu_id AND level = :level AND item = :item";
            $tblvalue = array(
                ':stu_id' => htmlspecialchars($_SESSION['stu_id']),
                ':level' => htmlspecialchars($_SESSION['stu_level']),
                ':item' => htmlspecialchars($item)
            );
            $paymentCheck = $connect->tbl_select($tblquery, $tblvalue);
            if(!$paymentCheck){
                $tblquery = "INSERT INTO payment VALUES(:id, :stu_id, :level, :item, :amount, :tid, :pm, :note, :date)";
                $tblvalue = array(
                    ':id' => NULL, 
                    ':stu_id' => htmlspecialchars($_SESSION['stu_id']),
                    ':level' => htmlspecialchars($_SESSION['stu_level']),
                    ':item' => htmlspecialchars($item), 
                    ':amount' => htmlspecialchars($amount),
                    ':tid' => htmlspecialchars($tid),
                    ':pm' => htmlspecialchars($pm),
                    ':note' => htmlspecialchars($note),
                    ':date' => htmlspecialchars($date)
                );
                $insert = $connect->tbl_insert($tblquery,$tblvalue);
                if($insert){
                    echo "<p class='text-success'>payment added</p>";
                    $level = $item = $amount = $tid = $pm = $note = $date = '';
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
                <textarea name="note" class="form-control"><?php echo $note; ?></textarea>
            </div>
            <div class="col-lg-3">
                <br />
                <input type="submit" name="add" class="btn btn-primary" value="Add Payment">
            </div>
        </div>
    </form>
</div>