<div style="background:#fff;padding:30px;">
    <h3>Enter course code</h3>
    <hr />
    <?php 
        if($_POST['find']){
            
            extract($_POST);
            $_SESSION['c'] = $course;
            $_SESSION['d'] = $degree;
            $_SESSION['m'] = $mol;
            $_SESSION['s'] = $session;
            $_SESSION['l'] = $level;
            $_SESSION['se'] = $semester;
            $tblquery = "SELECT * FROM course_code WHERE course = :course AND degree = :degree AND  mol = :mol AND session = :session AND level = :level AND semester = :semester ORDER BY code";
            $tblvalue = array(
                ':course' => htmlspecialchars($course),
                ':degree' => htmlspecialchars($degree),
                ':mol' => htmlspecialchars($mol),
                ':session' => htmlspecialchars($session),
                ':level' => htmlspecialchars($level),
                ':semester' => htmlspecialchars($semester)
            );
            $searches = $connect->tbl_select($tblquery, $tblvalue);
        }
        if($_POST['add']){
            
            extract($_POST);
            $_SESSION['c'] = $course;
            $_SESSION['d'] = $degree;
            $_SESSION['m'] = $mol;
            $_SESSION['s'] = $session;
            $_SESSION['l'] = $level;
            $_SESSION['se'] = $semester;

            if($ct AND $cc AND $cu){
                $tblquery = "SELECT * FROM course_code WHERE course = :course AND degree = :degree AND  mol = :mol AND session = :session AND level = :level AND semester = :semester AND code = :code";
                $tblvalue = array(
                    ':course' => htmlspecialchars($course),
                    ':degree' => htmlspecialchars($degree),
                    ':mol' => htmlspecialchars($mol),
                    ':session' => htmlspecialchars($session),
                    ':level' => htmlspecialchars($level),
                    ':semester' => htmlspecialchars($semester),
                    ':code' => htmlspecialchars($cc)
                );
                $check = $connect->tbl_select($tblquery, $tblvalue);
                if(!$check){
                    $tblquery = "INSERT INTO course_code VALUES(:id, :course, :degree, :mol, :session, :level, :semester, :title, :code, :credit_unite, :date)";
                    $tblvalue = array(
                        ':id' => NULL, 
                        ':course' => htmlspecialchars($course),
                        ':degree' => htmlspecialchars($degree),
                        ':mol' => htmlspecialchars($mol), 
                        ':session' => htmlspecialchars($session),
                        ':level' => htmlspecialchars($level),
                        ':semester' => htmlspecialchars($semester),
                        ':title' => htmlspecialchars(ucwords($ct)),
                        ':code' => htmlspecialchars(strtoupper($cc)),
                        ':credit_unite' => htmlspecialchars($cu),
                        ':date' => date('Y-m-d')
                    );
                    $insert = $connect->tbl_insert($tblquery,$tblvalue);
                    if($insert){
                        echo "<p class='text-success'>course added</p>";
                        $ct = $cc = $cu = '';
                    }
                }else{
                    echo "<p class='text-danger'>already added</p>";
                }
            }else{
                echo "<p class='text-danger'>course title, course code and credit unit are required</p>";
            }
        }
        $tblquery = "SELECT * FROM course_code WHERE course = :course AND degree = :degree AND  mol = :mol AND session = :session AND level = :level AND semester = :semester ORDER BY code";
        $tblvalue = array(
            ':course' => htmlspecialchars($_SESSION['c']),
            ':degree' => htmlspecialchars($_SESSION['d']),
            ':mol' => htmlspecialchars($_SESSION['m']),
            ':session' => htmlspecialchars($_SESSION['s']),
            ':level' => htmlspecialchars($_SESSION['l']),
            ':semester' => htmlspecialchars($_SESSION['se'])
        );
        $searches = $connect->tbl_select($tblquery, $tblvalue);
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-3">
                <select name="course" class="form-control" required>
                    <option value="<?php echo $_SESSION['c']; ?>"><?php echo $_SESSION['c']; ?></option>
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
                    <option value="<?php echo $_SESSION['d']; ?>"><?php echo $_SESSION['d']; ?></option>
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
                    <option value="<?php echo $_SESSION['m']; ?>"><?php echo $_SESSION['m']; ?></option>
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
                    <option value="<?php echo $_SESSION['s']; ?>"><?php echo $_SESSION['s']; ?></option>
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
                    <option value="<?php echo $_SESSION['l']; ?>"><?php echo $_SESSION['l']; ?></option>
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
                <select name="semester" class="form-control" required>
                    <option value="<?php echo $_SESSION['se']; ?>"><?php echo $_SESSION['se']; ?></option>
                    <option value="1st"><sup>1st</sup></option>
                    <option value="2nd"><sup>2nd</sup></option>
                    <option value="3rd"><sup>3rd</sup></option>
                </select>
                <small>Semester</small>
            </div>
            <div class="col-lg-3">
                <br>
                <input type="text" name="ct" class="form-control" value="<?php echo $ct; ?>">
                <small>Course Title</small>
            </div>
            <div class="col-lg-3">
                <br>
                <input type="text" name="cc" class="form-control" value="<?php echo $cc; ?>">
                <small>Course Code</small>
            </div>
            <div class="col-lg-3">
                <br>
                <input type="number" name="cu" class="form-control" value="<?php echo $cu; ?>">
                <small>Credit Unit</small>
            </div>
            <div class="col-lg-3">
                <br>
                <input type="submit" name="add" class="btn btn-primary" value="Proceed">
            </div>
            <div class="col-lg-3">
                <br>
                <input type="submit" name="find" class="btn btn-info" value="Search">
            </div>
        </div>
    </form>
</div>

<br>

<div style='background:#fff;padding:30px;'>
    <h3>course codes</h3>
    <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
        <thead>
            <tr>
                <th>SN</th>  
                <th>Course Title</th>   
                <th>Course Codes</th>   
                <th>Credit Unit</th>    
                <th>Date</th>      
                <th>remove</th>      
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
                                <td>$title</td>
                                <td>$code</td>
                                <td>$credit_unite</td>
                                <td>$date</td>
                                <td>
                                    <form action='' method='post'>
                                        <input type='hidden' name='id' value='$id'>
                                        <input type='submit' name='rem' class='btn btn-sm btn-info' value='remove'>
                                    </form>
                                </td>
                            </tr>
                        "; 
                        $sn++;
                    }
                }else{
                    echo "
                        <tr>
                            <td colspan='5'>no result found</td>
                        </tr>
                    "; 
                }

            ?>
        </tbody>
    </table>
</div>

<?php

    if($_POST['rem']){
        extract($_POST);
        $tblquery = "DELETE FROM course_code WHERE id = :id";
        $tblvalue = array(
            ':id' => $id
        );
        $delete = $connect->tbl_delete($tblquery,$tblvalue);
        echo "<script>  window.location='resultdetails' </script>";
        // echo "<script>  window.open('view', '_blank') </script>";
    }

?>
