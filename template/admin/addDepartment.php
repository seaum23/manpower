<?php
include ('includes/ajax.php');
$qry = "select companyId, companyName from company";
$result = mysqli_query($conn,$qry);
?>
<script type="text/javascript">
    function fetch_data(val){
        $.ajax({
            type: 'post',
            url: 'template/admin/fetchDepartmentData.php',
            data: {
                get_option:val
            },
            success: function (response){
                document.getElementById("departmentNames").innerHTML=response;
            }
        });
    }
</script>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Agent</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Candidate Agent Information</h3>
    <form action="template/admin/addDepartmentQry.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label for="sel1">Company:</label>
                    <select class="form-control" id="companyId" name="companyId" onchange="fetch_data(this.value)">
                        <option>Select Company</option>
                        <?php while($company = mysqli_fetch_assoc($result)){ ?>
                            <option value="<?php echo $company['companyId'];?>"><?php echo $company['companyName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="column col-md-6">
                    <label for="sel1">Department:</label>
                    <select class="form-control" id="departmentNames" name="departmentId">
                        <option>Select Department</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Add">
</div>
</form>
</div>