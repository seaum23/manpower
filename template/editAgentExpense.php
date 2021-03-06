<?php
if(isset($_POST['agentExpenseId'])){
    $agentExpenseId = $_POST['agentExpenseId'];
}else{
    $agentExpenseId = '';
}

$expense = mysqli_fetch_assoc($conn->query("SELECT agentexpense.*, agent.agentName from agentexpense
                                            inner join agent using (agentEmail) where agentExpenseId = ".$agentExpenseId));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Expense for Agent</h2>
    </div>
    
    <form action="template/addExpenseAgentQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <input type="hidden" name="agentExpenseId" value="<?php echo $agentExpenseId;?>">
        <h3 style="background-color: aliceblue; padding: 0.5%">Agent List</h3>
        <div class="form-group col-md-6" >
            <label>Select Agent Name</label>
            <select class="form-control" name="agentEmail">
                <option value="<?php echo $expense['agentEmail'];?>"><?php echo $expense['agentName'];?></option>
            </select>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Full Amount</label>
                    <input class="form-control" type="number" name="fullAmount" value="<?php echo $expense['fullAmount'];?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Advance</label>
                    <input class="form-control" type="number" name="advance" value="<?php echo $expense['paidAmount'];?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Adjust Amount</label>
                    <input class="form-control" type="number" name="adjustAmount" placeholder="0">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" >                    
                    <label>Purpose</label>
                    <input class="form-control" type="text" name="purpose" value="<?php echo $expense['expensePurposeAgent'];?>">
                </div>
                <div class="form-group col-md-6" > 
                    <label>Pay Date</label>
                    <input class="form-control" type="date" name="paydate" value="<?php echo $expense['payDate'];?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label>Comment</label>
                    <input class="form-control" type="text" name="comment" value="<?php echo $expense['comment'];?>">
                </div>
            </div>
        </div>
        <div class="form-group" >       
            <input style="margin: auto; width: auto;" class="form-control" type="submit" value="Update" name="agent">
        </div>
    </form>
</div>