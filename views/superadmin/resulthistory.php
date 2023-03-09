<div style="background:#fff;padding:30px;">
    <h5>Result Records</h5>
    <hr />
    
    <span>last 10 result added</span>
    <div class="row">
        <div class="col-12">
            <table class='table table-bordered' style='font-family: Arial; font-size: 15px;'>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Added By</th>
                        <th>Student</th>
                        <th>Session</th>
                        <th>Level</th>
                        <th>Course</th>
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
                    </tr>  
                </thead>
                <tbody> 
                    <?php
                        $tblquery = "SELECT * FROM result ORDER BY id DESC LIMIT 10";
                        $tblvalue = array();
                        $searches = $connect->tbl_select($tblquery, $tblvalue);
                        if($searches){
                            $addEmail = array();
                            $addName = [];
                            $coursesss = [];
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

                                $tblquery = "SELECT lname, fname, mname, course FROM students WHERE id = :id";
                                $tblvalue = array(
                                    ':id' => htmlspecialchars($userid)
                                );
                                $sea = $connect->tbl_select($tblquery, $tblvalue);
                                foreach($sea as $data){
                                    extract($data);
                                    $l = $lname . ' ' . $fname . ' ' . $mname;
                                    array_push($addName, $l);
                                    array_push($coursesss, $course);
                                }
                            }
                        }
                        $seE = 0;
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

                                $moreFields = explode('?* ', $more);
                                echo "
                                    <tr>
                                        <td>$sn</td>
                                        <td>$addEmail[$seE]</td>
                                        <td>$addName[$seE]</td>
                                        <td>$session</td>
                                        <td>$level</td>
                                        <td>$coursesss[$seE]</td>
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
                                    </tr>
                                "; 
                                $sn++;
                                $seE++;
                            }
                        }else{
                            echo "
                                <tr>
                                    <td colspan='7'>no result found</td>
                                </tr>
                            "; 
                        }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>