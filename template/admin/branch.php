<?php
$qry = "select * from agenttype";
$result = mysqli_query($conn,$qry);

?>
<style>
    .column{
        padding: 2%;
    }
</style>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Admin Panal</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Candidate Agent Information</h3>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=createBranch" class="btn btn-primary">Create Branch</a>
                        </div>
                    </div>
                </div>
                <div class="column col-md-6" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=branchList" class="btn btn-primary">Branch List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
</div>