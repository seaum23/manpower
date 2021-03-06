<?php $result = $conn->query("SELECT delegateId, delegateName from delegate order by creationDate desc"); ?>

<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Sponsor</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
    <form action="template/addNewSponsorQry.php" method="post">
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label>Delegate</label>
                    <select class="form-control" name="delegateId" id="delegateId">
                    <option value="notSet">------ Select Delegate -------</option>
                    <?php while($delegate = mysqli_fetch_assoc($result)){ ?>
                        <option value="<?php echo $delegate['delegateId']?>"><?php echo $delegate['delegateName']?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6" >
                    <label>Sponsor Name</label>
                    <input class="form-control" type="text" name="sponsorName" placeholder="Enter Name" required>
                </div>                
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label>Sponsor NID</label>
                    <input class="form-control" type="text" name="sponsorNid" placeholder="Enter NID" required>
                </div>
                <div class="form-group col-md-6" >                    
                    <label>Comment</label>
                    <input class="form-control" type="text" id="sponsorVisa" name="comment" placeholder="Any Remark...">
                </div>
            </div>
        </div>
        <div class="form-group">        
            <input style="width: auto; margin: auto" class="form-control" type="submit" value="Add">
        </div>
    </form>
</div>


<script>
    window.onload = function() {
        $('#sponsorNav').addClass('active');
    };
</script>