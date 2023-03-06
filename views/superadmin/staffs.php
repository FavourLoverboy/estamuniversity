<div style="background:#fff; padding: 30px 30px 30px 30px;">
    <h3>staffs</h3>
    
    <?php
    
        if($_POST['dis']){
            extract($_POST);
            $tblquery = "UPDATE staff SET status = :status WHERE id = :id";
            $tblvalue = array(
                ':status' => '0',
                ':id' => htmlspecialchars($id)
            );
            $update = $connect->tbl_update($tblquery,$tblvalue);
            if($update){
                echo "<script>  window.location='staffs' </script>";
            }
        }

        if($_POST['en']){
            extract($_POST);
            $tblquery = "UPDATE staff SET status = :status WHERE id = :id";
            $tblvalue = array(
                ':status' => '1',
                ':id' => htmlspecialchars($id)
            );
            $update = $connect->tbl_update($tblquery,$tblvalue);
            if($update){
                echo "<script>  window.location='staffs' </script>";
            }
        }
    
    ?>

    <table class="table table-bordered" style="font-family: Arial; font-size: 15px;">
        <thead>
            <tr>
                <th>SN</th>  
                <th>Names</th>  
                <th>Email</th>  
                <th>Role</th>  
                <th>Date Paid</th>      
                <th>Status</th>      
            </tr>     
        </thead>  
        <tbody> 
            <?php
                $tblquery = "SELECT * FROM staff WHERE id != :id ORDER BY id DESC";
                $tblvalue = array(
                    ':id' => $_SESSION['myId']
                );
                $select = $connect->tbl_select($tblquery,$tblvalue);
                $sn = 1;
                foreach($select as $data){
                    extract($data);
                    if($level == 'SUA'){
                        $role = 'Super Admin';
                        $color = 'bg-success';
                    }elseif($level == 'PA'){
                        $role = 'Payment Admin';
                        $color = 'bg-primary';
                    }elseif($level == 'RA'){
                        $role = 'Result Admin';
                        $color = 'bg-info';
                    }elseif($level == 'SA'){
                        $role = 'Student Admin';
                        $color = 'bg-warning';
                    }
                    if($status == '1'){
                        echo "
                            <tr>
                                <td>$sn</td>
                                <td>$name</td>
                                <td>$email</td>
                                <td class='$color'>$role</td>
                                <td>$date</td>
                                <td>
                                    <form action='' method='post'>
                                        <input type='hidden' name='id' value='$id'>
                                        <input type='submit' name='dis' class='btn btn-sm btn-danger' value='Disable'>
                                    </form>
                                </td>
                            </tr>
                        ";    
                    }else{
                        echo "
                            <tr>
                                <td>$sn</td>
                                <td>$name</td>
                                <td>$email</td>
                                <td class='$color'>$role</td>
                                <td>$date</td>
                                <td>
                                    <form action='' method='post'>
                                        <input type='hidden' name='id' value='$id'>
                                        <input type='submit' name='en' class='btn btn-sm btn-success' value='Enable'>
                                    </form>
                                </td>
                            </tr>
                        ";    
                    }
                     
                    $sn++;    
                }
                
                
            ?> 
        </tbody>
    </table>
</div>