<div style="background:#fff;padding:30px;">
    <h3>search students</h3>
    <hr />
    <?php 
        if($_POST['find']){
            
            extract($_POST);
            $tblquery = "SELECT * FROM students WHERE degree = :degree AND course = :course AND mol = :mol AND level = :level AND session = :session ORDER BY lname";
            $tblvalue = array(
                ':degree' => htmlspecialchars($degree),
                ':course' => htmlspecialchars($course),
                ':mol' => htmlspecialchars($mol),
                ':level' => htmlspecialchars($level),
                ':session' => htmlspecialchars($session),
            );
            $searches = $connect->tbl_select($tblquery, $tblvalue);
        }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-3">
                <select name="course" class="form-control" required>
                    <option value="<?php echo $course; ?>"><?php echo $course; ?></option>
                    <?php
                        $tblquery = "SELECT * FROM additional_details WHERE type = :type ORDER BY name";
                        $tblvalue = array(
                            ':type' => 'Course'
                        );
                        $select = $connect->tbl_select($tblquery,$tblvalue);
                        foreach($select as $data){
                            extract($data);
                            echo "
                                <option value='$name'>$name</option>
                            ";   
                        }
                    ?> 
                </select>
                <small>Course Applied for</small>
            </div>

            <div class="col-lg-3">
                <select name="degree" class="form-control" required>
                    <option value="<?php echo $degree; ?>"><?php echo $degree; ?></option>
                    <?php
                        $tblquery = "SELECT * FROM additional_details WHERE type = :type ORDER BY name";
                        $tblvalue = array(
                            ':type' => 'Degree'
                        );
                        $select = $connect->tbl_select($tblquery,$tblvalue);
                        foreach($select as $data){
                            extract($data);
                            echo "
                                <option value='$name'>$name</option>
                            ";   
                        }
                    ?> 
                </select>
                <small>Degree Aim for</small>
            </div>

            <div class="col-lg-3">
                <select name="mol" class="form-control" required>
                    <option value="<?php echo $mol; ?>"><?php echo $mol; ?></option>
                    <?php
                        $tblquery = "SELECT * FROM additional_details WHERE type = :type ORDER BY name";
                        $tblvalue = array(
                            ':type' => 'Mol'
                        );
                        $select = $connect->tbl_select($tblquery,$tblvalue);
                        foreach($select as $data){
                            extract($data);
                            echo "
                                <option value='$name'>$name</option>
                            ";   
                        }
                    ?>
                </select>
                <small>Study Mode</small>
            </div>
            
            <div class="col-lg-3">
                <select name="session" class="form-control" required>
                    <option value="<?php echo $session; ?>"><?php echo $session; ?></option>
                    <?php
                        $tblquery = "SELECT session FROM students GROUP BY session ORDER BY session";
                        $tblvalue = array();
                        $select = $connect->tbl_select($tblquery,$tblvalue);
                        foreach($select as $data){
                            extract($data);
                            echo "
                                <option value='$session'>$session</option>
                            ";   
                        }
                    ?> 
                </select>
                <small>Session</small>
            </div>

            <div class="col-lg-3">
                <br>
                <select name="level" class="form-control" required>
                    <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="400">400</option>
                    <option value="500">500</option>
                </select>
                <small>Level</small>
            </div>
            <div class="col-lg-3">
                <br>
                <input type="submit" name="find" class="btn btn-primary" value="Proceed">
            </div>
        </div>
    </form>
</div>

<br>

<div style='background:#fff;padding:30px;'>
    <h3>search result</h3>
    <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
        <thead>
            <tr>
                <th>SN</th>  
                <th>Img</th>    
                <th>Name</th>    
                <th>Email</th>      
                <th>Sex</th>      
                <th>view</th>      
            </tr>     
        </thead>  
        <tbody> 
            <?php

                if($searches){
                    $sn = 1;
                    foreach($searches as $data){
                        extract($data);
                        echo "
                            <tr>
                                <td>$sn</td>
                                <td>
                                    <img src='../uploads/$folder/$passport' class='rounded-circle' style='height: 40px; width: 40px'>
                                </td>
                                <td>$lname $fname $mname</td>
                                <td>$email</td>
                                <td>$sex</td>
                                <td>
                                    <form action='' method='post'>
                                        <input type='hidden' name='id' value='$id'>
                                        <input type='submit' name='removedeg' class='btn btn-sm btn-info' value='see more ...'>
                                    </form>
                                </td>
                            </tr>
                        "; 
                        $sn++;  
                    }
                }else{
                    echo "
                        <tr>
                            <td colspan='4'>no result found</td>
                        </tr>
                    "; 
                }

            ?>
        </tbody>
    </table>
</div>

