<div style="background:#fff;padding:30px;">
    <h5>enter result for </h5>
    <?php echo $_SESSION['namename']; ?>
    <hr />
    <?php 
        if($_POST['add']){
            
            extract($_POST);

            $allCourse = explode(',', $courses);

            $tblquery = "SELECT * FROM result WHERE userid = :userid AND level = :level AND session = :session AND semester = :semester AND code = :code";
            $tblvalue = array(
                ':userid' => htmlspecialchars($_SESSION['stu_id']),
                ':level' => htmlspecialchars($_SESSION['l']),
                ':session' => htmlspecialchars($_SESSION['s']),
                ':semester' => htmlspecialchars($_SESSION['se']),
                ':code' => htmlspecialchars($allCourse[1])
            );
            $scoreCheck = $connect->tbl_select($tblquery, $tblvalue);
            if(!$scoreCheck){
                $tblquery = "INSERT INTO result VALUES(:id, :userid, :addedby, :level, :session, :semester, :title, :code, :cu, :score, :date)";
                $tblvalue = array(
                    ':id' => NULL, 
                    ':userid' => htmlspecialchars($_SESSION['stu_id']),
                    ':addedby' => htmlspecialchars($_SESSION['myId']),
                    ':level' => htmlspecialchars($_SESSION['l']),
                    ':session' => htmlspecialchars($_SESSION['s']), 
                    ':semester' => htmlspecialchars($_SESSION['se']),
                    ':title' => htmlspecialchars($allCourse[0]),
                    ':code' => htmlspecialchars($allCourse[1]),
                    ':cu' => htmlspecialchars($allCourse[2]),
                    ':score' => htmlspecialchars($score),
                    ':date' => date('Y-m-d')
                );
                $insert = $connect->tbl_insert($tblquery,$tblvalue);
                if($insert){
                    echo "<p class='text-success'>score added</p>";
                    $score = '';
                }
            }else{
                echo "<p class='text-danger'>score already added</p>";
            }
        }
        $tblquery = "SELECT * FROM result WHERE userid = :userid AND level = :level AND session = :session AND semester = :semester";
        $tblvalue = array(
            ':userid' => htmlspecialchars($_SESSION['stu_id']),
            ':level' => htmlspecialchars($_SESSION['l']),
            ':session' => htmlspecialchars($_SESSION['s']),
            ':semester' => htmlspecialchars($_SESSION['se'])
        );
        $searches = $connect->tbl_select($tblquery, $tblvalue);
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-3">
                Semester <br/>
                <input type="text" name="semester" class="form-control" value="<?php echo $_SESSION['se']; ?>" readonly>
            </div>
            <div class="col-lg-3">
                course | code | unit <br/>
                <select name="courses" class="form-control" required>
                    <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
                    <?php
                        $tblquery = "SELECT * FROM course_code WHERE course = :course AND degree = :degree AND mol = :mol AND session = :session AND level = :level AND semester = :semester ORDER BY code";
                        $tblvalue = array(
                            ':course' => $_SESSION['c'],
                            ':degree' => $_SESSION['d'],
                            ':mol' => $_SESSION['m'],
                            ':session' => $_SESSION['s'],
                            ':level' => $_SESSION['l'],
                            ':semester' => $_SESSION['se'],
                        );
                        $select = $connect->tbl_select($tblquery,$tblvalue);
                        $sn = 1;
                        foreach($select as $data){
                            extract($data);
                            echo "
                                <option value='$title,$code,$credit_unite'>$title || $code || $credit_unite</option>
                            ";
                            $sn++;    
                        }
                    ?>
                </select>
            </div>
            
            <div class="col-lg-3">
                score <br/>
                <input type="number" name="score" class="form-control" value="<?php echo $score; ?>" required>
            </div>
            <div class="col-lg-3">
                <br />
                <input type="submit" name="add" class="btn btn-primary" value="Add School">
            </div>
        </div>
    </form>
</div>

<br>

<div style='background:#fff;padding:30px;'>
    <h3>result</h3>
    <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
        <thead>
            <tr>
                <th>SN</th>   
                <th>Title</th>    
                <th>Code</th>      
                <th>CU</th>   
                <th>Score</th>     
                <th>Grade</th>     
                <th>GP</th>     
                <th>Remove</th>     
            </tr>     
        </thead>  
        <tbody> 
            <?php

                if($searches){
                    
                    $sn = 1;
                    foreach($searches as $data){
                        extract($data);
                        if($score > 74){
                            $g = 'A';
                            $gp = '4.00';
                        }elseif($score > 69){
                            $g = 'AB';
                            $gp = '3.50';
                        }elseif($score > 64){
                            $g = 'B';
                            $gp = '3.25';
                        }elseif($score > 59){
                            $g = 'BC';
                            $gp = '3.00';
                        }elseif($score > 54){
                            $g = 'C';
                            $gp = '2.75';
                        }elseif($score > 49){
                            $g = 'CD';
                            $gp = '2.50';
                        }elseif($score > 44){
                            $g = 'D';
                            $gp = '2.25';
                        }elseif($score > 39){
                            $g = 'E';
                            $gp = '2.00';
                        }else{
                            $g = 'F';
                            $gp = '0.00';
                        }
                        echo "
                            <tr>
                                <td>$sn</td>
                                <td>$title</td>
                                <td>$code</td>
                                <td>$cu</td>
                                <td>$score</td>
                                <td>$g</td>
                                <td>$gp</td>
                                <td>
                                    <form action='' method='post'>
                                        <input type='hidden' name='score_id' value='$id'>
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
                            <td colspan='8'>no result found</td>
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
        $tblquery = "DELETE FROM result WHERE id = :id";
        $tblvalue = array(
            ':id' => $score_id
        );
        $delete = $connect->tbl_delete($tblquery,$tblvalue);
        echo "<script>  window.location='result' </script>";
    }

?>