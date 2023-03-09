<div style="background:#fff;padding:30px;">
    <h5>Payment Records</h5>
    <hr />
    
    <span>last 10 payment added</span>
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
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Note</th>
                        <th>Date</th>  
                    </tr>  
                </thead>
                <tbody> 
                    <?php
                        $tblquery = "SELECT * FROM payment ORDER BY id DESC LIMIT 10";
                        $tblvalue = array();
                        $searches = $connect->tbl_select($tblquery, $tblvalue);
                        if($searches){
                            $addEmail = array();
                            $addName = [];
                            $addSession = [];
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

                                $tblquery = "SELECT lname, fname, mname, session FROM students WHERE id = :id";
                                $tblvalue = array(
                                    ':id' => htmlspecialchars($stu_id)
                                );
                                $sea = $connect->tbl_select($tblquery, $tblvalue);
                                foreach($sea as $data){
                                    extract($data);
                                    $l = $lname . ' ' . $fname . ' ' . $mname;
                                    array_push($addName, $l);
                                    array_push($addSession, $session);
                                }
                            }
                        }
                        $seE = 0;
                        if($searches){
                            $sn = 1;
                            foreach($searches as $data){
                                extract($data);
                                echo "
                                    <tr>
                                        <td>$sn</td>
                                        <td>$addEmail[$seE]</td>
                                        <td>$addName[$seE]</td>
                                        <td>$addSession[$seE]</td>
                                        <td>$level</td>
                                        <td>$item</td>
                                        <td>$amount</td>
                                        <td>$pm</td>
                                        <td>$note</td>
                                        <td>$date</td>
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