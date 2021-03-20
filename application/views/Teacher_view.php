<?php 
echo "<h3>teacher records</h3>";
?>
<div class="wrapper">
    <div class="upper" id="upper">
        <h4 class="titleofpage"> Teachers List</h4><br/>
        <table style="border: 1px solid black">
            <th style="border: 1px solid black">faculty name</th>
            <th style="border: 1px solid black">facaulty_phone</th>
            <th style="border: 1px solid black;text-align: center;">Delete</th>
            <?php   $count=0;
                    foreach ($tname as $key => $value) {
            ?>
                        <tr style="border: 1px solid black">
                        <form method="post" action="">
                            <?php $value->faculty_id;?>

                            <td style="border: 1px solid black"><?php echo $value->faculty_name; ?><input type="hidden" name="tableRow[<?php echo $count;?>][faculty_id]" value="<?php echo $value->faculty_id; ?>"></td>
            <?php                    ?>
                            <td style="border: 1px solid black"><?php echo $value->faculty_phno; ?></td>
            <?php                    ?>
                        <td><input type="submit" class="btn btn-danger" name="tableRow[<?php echo $count;?>][del_button]" value="Delete"></td>
                        </form>
                        </tr>
            <?php $count++;
            }?>
        </table>
    </div>
</div>