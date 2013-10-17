<?php
$title = "Active Courses"; //enter title into the quotation marks
include("../shared_php/header.php");
?>
<link rel="stylesheet" href="../css/acourses.css" />
   <br><br> <h3> <u> Current Courses: </u> </h3> <br>
<table width="1000px">
    <tr valign="top">
        <td width="150px">
            <div id="navigation">
                <ul class="top-level">
                    <?php
                    $selectSQL = "SELECT * FROM Classes where isFinished = 0 AND ClassInstructorId = " . $_SESSION['idmember'];
                    $result = $mysqli->query($selectSQL);

                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <li><a href="#"><?php echo $row['ClassName']; ?></a>
                            <ul class="sub-level">
                                <li><a href="#" onclick="LoadListOfStudents(<?php echo $row['idClass'];?>);" >List of students </a></li>
                                <li><a href="#" onclick="LoadListOfAssignments(<?php echo $row['idClass']; ?>);" 
                                     onclick="<?php $_SESSION['ClassName'] = $row['ClassName']; $_SESSION['ClassId'] = $row['idClass']?>" >List of assignments</a></li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>  
                </ul>
            </div>
        </td>
        <td width="850px">
            <iframe name="childFrame" id="myFrame">
            </iframe>
        </td>
    </tr>
</table>
<?php
include("../shared_php/footer.php");
?>