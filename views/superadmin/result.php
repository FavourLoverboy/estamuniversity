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
                // getting additional field value
                $allFields = array();
                $tblquery = "SELECT * FROM morefields WHERE type = :type";
                $tblvalue = array(
                    ':type' => 'R'
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

                $tblquery = "INSERT INTO result VALUES(:id, :userid, :addedby, :level, :session, :semester, :title, :code, :cu, :score, :more, :date)";
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
                    ':more' => $allMore,
                    ':date' => date('Y-m-d')
                );
                $insert = $connect->tbl_insert($tblquery,$tblvalue);
                if($insert){
                    echo "<p class='text-success'>score added</p>";
                    $score = '';
                    $enter = true;
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
            <?php
            
                $tblquery = "SELECT * FROM morefields WHERE type = :type";
                $tblvalue = array(
                    ':type' => 'R'
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
                <th>Added By</th>    
                <th>Title</th>    
                <th>Code</th>      
                <th>CU</th>   
                <th>Score</th>
                <?php
            
                    $tblquery = "SELECT * FROM morefields WHERE type = :type";
                    $tblvalue = array(
                        ':type' => 'R'
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
                <th>Grade</th>    
                <th>GP</th>     
                <th>Remove</th>     
            </tr>     
        </thead>  
        <tbody> 
            <?php

                if($searches){
                    
                    $sn = 1;
                    $snE = 0;

                    $addEmail = array();
                    foreach($searches as $data){
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
                        
                        
                        $moreFields = explode('?* ', $more);
                        echo "
                            <tr>
                                <td>$sn</td>
                                <td>$addEmail[$snE]</td>
                                <td>$title</td>
                                <td>$code</td>
                                <td>$cu</td>
                                <td>$score</td>
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
                        $snE++;
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