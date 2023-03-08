<div style="background:#fff;padding:30px;">
    <h3>Add degree</h3>
    <hr />
    <?php 
        if($_POST['adddegree']){
            
            extract($_POST);
            
            $errdegree = '';
            $tblquery = "SELECT * FROM additional_details WHERE name = :name";
            $tblvalue = array(
                ':name' => htmlspecialchars(ucwords($degree))
            );
            $degreeCheck = $connect->tbl_select($tblquery, $tblvalue);
            if(!$degreeCheck){
                $tblquery = "INSERT INTO additional_details VALUES(:id, :name, :type)";
                $tblvalue = array(
                    ':id' => NULL, 
                    ':name' => htmlspecialchars(ucwords($degree)), 
                    ':type' => "Degree"
                );
                $insert = $connect->tbl_insert($tblquery,$tblvalue);
                if($insert){
                    echo "<p class='text-success'>Degree added</p>";
                    $degree = '';
                }
            }else{
                $errDegree = "already exist";
            }
        }
        if($_POST['removedeg']){
            extract($_POST);
            $tblquery = "DELETE FROM additional_details WHERE id = :id";
            $tblvalue = array(
                ':id' => $id
            );
            $delete = $connect->tbl_delete($tblquery,$tblvalue);
        }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-9">
                Degree <br />
                <input type="text" name="degree" class="form-control" placeholder="" value="<?php echo $degree; ?>" required>
                <span class="main">
                    <?php echo $errDegree; ?>
                </span>
            </div>
            <div class="col-lg-3">
                <br />
                <input type="submit" name="adddegree" class="btn btn-primary" value="Add degree">
            </div>
        </div>
    </form>

    <br>
    <table class="table table-bordered" style="font-family: Arial; font-size: 15px;">
        <thead>
            <tr>
                <th>SN</th>  
                <th>Degrees</th>      
                <th>Remove</th>      
            </tr>     
        </thead>  
        <tbody> 
            <?php
                $tblquery = "SELECT * FROM additional_details WHERE type = :type ORDER BY name";
                $tblvalue = array(
                    ':type' => 'Degree'
                );
                $select = $connect->tbl_select($tblquery,$tblvalue);
                $sn = 1;
                foreach($select as $data){
                    extract($data);
                    echo "
                        <tr>
                            <td>$sn</td>
                            <td>$name</td>
                            <td>
                                <form action='' method='post'>
                                    <input type='hidden' name='id' value='$id'>
                                    <input type='submit' name='removedeg' class='btn btn-sm btn-danger' value='Remove'>
                                </form>
                            </td>
                        </tr>
                    ";
                    $sn++;    
                }
            ?> 
        </tbody>
    </table>
</div>

<br>

<div style="background:#fff;padding:30px;">
    <h3>Add course</h3>
    <hr />
    <?php 
        if($_POST['addcourse']){
            
            extract($_POST);
            
            $errCourse = '';
            $tblquery = "SELECT * FROM additional_details WHERE name = :name";
            $tblvalue = array(
                ':name' => htmlspecialchars(ucwords($course))
            );
            $courseCheck = $connect->tbl_select($tblquery, $tblvalue);
            if(!$courseCheck){
                $tblquery = "INSERT INTO additional_details VALUES(:id, :name, :type)";
                $tblvalue = array(
                    ':id' => NULL, 
                    ':name' => htmlspecialchars(ucwords($course)), 
                    ':type' => "Course"
                );
                $insert = $connect->tbl_insert($tblquery,$tblvalue);
                if($insert){
                    echo "<p class='text-success'>Course added</p>";
                    $course = '';
                }
            }else{
                $errCourse = "already exist";
            }
        }
        if($_POST['removecourse']){
            extract($_POST);
            $tblquery = "DELETE FROM additional_details WHERE id = :id";
            $tblvalue = array(
                ':id' => $id
            );
            $delete = $connect->tbl_delete($tblquery,$tblvalue);
        }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-9">
                Course <br />
                <input type="text" name="course" class="form-control" value="<?php echo $course; ?>" required>
                <span class="main">
                    <?php echo $errCourse; ?>
                </span>
            </div>
            <div class="col-lg-3">
                <br />
                <input type="submit" name="addcourse" class="btn btn-primary" value="Add course">
            </div>
        </div>
    </form>

    <br>
    <table class="table table-bordered" style="font-family: Arial; font-size: 15px;">
        <thead>
            <tr>
                <th>SN</th>  
                <th>Courses</th>      
                <th>Remove</th>      
            </tr>     
        </thead>  
        <tbody> 
            <?php
                $tblquery = "SELECT * FROM additional_details WHERE type = :type ORDER BY name";
                $tblvalue = array(
                    ':type' => 'Course'
                );
                $select = $connect->tbl_select($tblquery,$tblvalue);
                $sn = 1;
                foreach($select as $data){
                    extract($data);
                    echo "
                        <tr>
                            <td>$sn</td>
                            <td>$name</td>
                            <td>
                                <form action='' method='post'>
                                    <input type='hidden' name='id' value='$id'>
                                    <input type='submit' name='removecourse' class='btn btn-sm btn-danger' value='Remove'>
                                </form>
                            </td>
                        </tr>
                    ";
                    $sn++;    
                }
            ?> 
        </tbody>
    </table>
</div>

<br>

<div style="background:#fff;padding:30px;">
    <h3>Add method of learning</h3>
    <hr />
    <?php 
        if($_POST['addmol']){
            
            extract($_POST);
            
            $errMol = '';
            $tblquery = "SELECT * FROM additional_details WHERE name = :name";
            $tblvalue = array(
                ':name' => htmlspecialchars(ucwords($mol))
            );
            $molCheck = $connect->tbl_select($tblquery, $tblvalue);
            if(!$molCheck){
                $tblquery = "INSERT INTO additional_details VALUES(:id, :name, :type)";
                $tblvalue = array(
                    ':id' => NULL, 
                    ':name' => htmlspecialchars(ucwords($mol)), 
                    ':type' => "Mol"
                );
                $insert = $connect->tbl_insert($tblquery,$tblvalue);
                if($insert){
                    echo "<p class='text-success'>Method of Learning added</p>";
                    $mol = '';
                }
            }else{
                $errMol = "already exist";
            }
        }
        if($_POST['removemol']){
            extract($_POST);
            $tblquery = "DELETE FROM additional_details WHERE id = :id";
            $tblvalue = array(
                ':id' => $id
            );
            $delete = $connect->tbl_delete($tblquery,$tblvalue);
        }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-9">
                Learning Method <br />
                <input type="text" name="mol" class="form-control" value="<?php echo $mol; ?>" required>
                <span class="main">
                    <?php echo $errMol; ?>
                </span>
            </div>
            <div class="col-lg-3">
                <br />
                <input type="submit" name="addmol" class="btn btn-primary" value="Add Learning Method">
            </div>
        </div>
    </form>

    <br>
    <table class="table table-bordered" style="font-family: Arial; font-size: 15px;">
        <thead>
            <tr>
                <th>SN</th>  
                <th>Learning Methods</th>      
                <th>Remove</th>      
            </tr>     
        </thead>  
        <tbody> 
            <?php
                $tblquery = "SELECT * FROM additional_details WHERE type = :type ORDER BY name";
                $tblvalue = array(
                    ':type' => 'Mol'
                );
                $select = $connect->tbl_select($tblquery,$tblvalue);
                $sn = 1;
                foreach($select as $data){
                    extract($data);
                    echo "
                        <tr>
                            <td>$sn</td>
                            <td>$name</td>
                            <td>
                                <form action='' method='post'>
                                    <input type='hidden' name='id' value='$id'>
                                    <input type='submit' name='removemol' class='btn btn-sm btn-danger' value='Remove'>
                                </form>
                            </td>
                        </tr>
                    ";
                    $sn++;    
                }
            ?> 
        </tbody>
    </table>
</div>