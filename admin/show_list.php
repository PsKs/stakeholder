<div class="table-scrol col-md-7 col-md-offset-2">  
    <h1 align="center">Select lists</h1>  
<div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->    
    <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">
        <?php  
            require("../connect.php");  
            $view_stakeholder_list = "select stklist_id, stklist_name from stakeholder_list";//select query for viewing users.  
            $run = mysqli_query($dbcon,$view_stakeholder_list);//here run the sql query.  
            while($row = mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
            {  
                $stklist_id=$row['stklist_id'];  
                $stklist_name=$row['stklist_name'];  
        ?>
        <label class="checkbox-inline">
        <input type="checkbox" id="<?php echo "inlineCheckbox".$stklist_id; ?>" value="<?php echo "inlineCheckbox".$stklist_id; ?>"> <?php echo $stklist_name; ?>
        </label>   
        <!-- <tr>  
            here showing results in the table  
            <td><?php echo $stklist_id; ?></td>           
            <td><?php echo $stklist_name; ?></td>  
            <td align="center"><a href="delete.php?del=<?php echo $user_id ?>"><button class="btn btn-primary">Select</button></a></td> 
        </tr>
        -->
        <?php } ?>
    </table>  
    </div>  
</div>