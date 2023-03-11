<div class="main">

    <!-- cards -->
    <div class="cardBox">
        <div class="card">
            <div>
                <?php
                    
                    $tblquery = "SELECT count(id) as allStudent FROM students";
                    $tblvalue = array();
                    $select = $connect->tbl_select($tblquery,$tblvalue);
                    foreach($select as $data){
                        extract($data);
                        $num = number_format($allStudent);
                        echo "
                            <div class='numbers'>$num</div>
                        ";
                    }
                
                ?>
                <div class="cardName">Students</div>
            </div>
        </div>
        <div class="card">
            <div>
                <?php
                    
                    $tblquery = "SELECT count(id) as allCourse FROM additional_details WHERE type = :type";
                    $tblvalue = array(
                        ':type' => 'Course'
                    );
                    $select = $connect->tbl_select($tblquery,$tblvalue);
                    foreach($select as $data){
                        extract($data);
                        $num = number_format($allCourse);
                        echo "
                            <div class='numbers'>$num</div>
                        ";
                    }
                
                ?>
                <div class="cardName">Courses</div>
            </div>
        </div>
        <div class="card">
            <div>
                <?php
                    
                    $tblquery = "SELECT count(id) as allCourse FROM additional_details WHERE type = :type";
                    $tblvalue = array(
                        ':type' => 'Degree'
                    );
                    $select = $connect->tbl_select($tblquery,$tblvalue);
                    foreach($select as $data){
                        extract($data);
                        $num = number_format($allCourse);
                        echo "
                            <div class='numbers'>$num</div>
                        ";
                    }
                
                ?>
                <div class="cardName">Degrees</div>
            </div>
        </div>
        <div class="card">
            <div>
                <?php
                    
                    $tblquery = "SELECT count(id) as allStaff FROM staff";
                    $tblvalue = array();
                    $select = $connect->tbl_select($tblquery,$tblvalue);
                    foreach($select as $data){
                        extract($data);
                        $num = number_format($allStaff);
                        echo "
                            <div class='numbers'>$num</div>
                        ";
                    }
                
                ?>
                <div class="cardName">Staffs</div>
            </div>
        </div>
    </div>

    <!-- Order List -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h5>Recent payments</h5>
                <a href="paymenthistory" class="btn">View All</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Item</td>
                        <td>Level</td>
                        <td>Price</td>
                        <td>Amount</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        $tblquery = "SELECT * FROM payment ORDER BY id DESC LIMIT 10";
                        $tblvalue = array();
                        $select = $connect->tbl_select($tblquery,$tblvalue);
                        foreach($select as $data){
                            extract($data);
                            $tblquery = "SELECT * FROM students WHERE id = :id";
                            $tblvalue = array(
                                ':id' => $stu_id
                            );
                            $select2 = $connect->tbl_select($tblquery,$tblvalue);
                            foreach($select2 as $data2){
                                extract($data2);
                            }
                            echo "
                                <tr>
                                    <td>$lname $fname $mname</td>
                                    <td>$item</td>
                                    <td>$level</td>
                                    <td>$pm</td>
                                    <td>$amount</td>
                                </tr>
                            ";
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>

        <!-- New Customers -->
        <div class="recentCustomers">
            <div class="cardHeader">
                <h5>Recent Students</h5>
            </div>

            <table>
                <?php
                    
                    $tblquery = "SELECT * FROM students ORDER BY id DESC LIMIT 8";
                    $tblvalue = array();
                    $select = $connect->tbl_select($tblquery,$tblvalue);
                    foreach($select as $data){
                        extract($data);
                        echo "
                            <tr>
                                <td width='60px'>
                                    <div class='imgBx'>
                                        <img src='../uploads/$folder/$passport' alt='Image'>
                                    </div>
                                </td>
                                <td>
                                    <h4>$lname $fname $mname <br> <span>$course</span></h4>
                                </td>
                            </tr>
                        ";
                    }
                
                ?>
            </table>
        </div>
    </div>
</div>