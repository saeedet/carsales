<?php

include_once("./../sql/sql_functions.php");

// AJAX RESPONSES FOR LIVE TABLE FILTERING

if(isset($_POST['show'])){
        $result = initTable();
        $itemCount = count($result);
        foreach ($result as $this_item) {
            echo "<tr>";
            echo "<td>".$this_item['ID']."</td>";
            echo "<td>".$this_item['brand']."</td>";
            echo "<td>".$this_item['model']."</td>";
            echo "<td>".$this_item['color']."</td>";
            echo "<td>".$this_item['body_type']."</td>";
            echo "<td>".$this_item['transmission']."</td>";
            echo "<td>".$this_item['year']."</td>";
            echo "<td>".$this_item['kilometers']."</td>";
            echo "<td>".$this_item['fuel_type']."</td>";
            echo "<td>".$this_item['seats']."</td>";
            echo "<td>$".$this_item['price']."</td>";
            echo "<td><a href='edit-item_ex.php?ID=".$this_item['ID']."&edit=1'>Edit</a></td>";
            echo "<td><a class='del' href='edit-item_ex.php?ID=".$this_item['ID']."&delete=1'>Delete</a></td>";
            echo "</tr>";
        }
}

if(isset($_POST["id"])) {
    $id = $_POST["id"];
    $result33 = get_this_item($id);

    if(!empty($result33)) { ?>

        <tr>
        <td><?php echo $result33[0]['ID']; ?></td>
        <td><?php echo $result33[0]['brand']; ?></td>
        <td><?php echo $result33[0]['model']; ?></td>
        <td><?php echo $result33[0]['color']; ?></td>
        <td><?php echo $result33[0]['body_type']; ?></td>
        <td><?php echo $result33[0]['transmission']; ?></td>
        <td><?php echo $result33[0]['year']; ?></td>
        <td><?php echo $result33[0]['kilometers']; ?></td>
        <td><?php echo $result33[0]['fuel_type']; ?></td>
        <td><?php echo $result33[0]['seats']; ?></td>
        <td>$<?php echo $result33[0]['price']; ?></td>
        <td><a href='edit-item_ex.php?ID=<?php echo $result33[0]['ID']; ?>&edit=1'>Edit</a></td>
        <td><a class='del' href='edit-item_ex.php?ID=<?php echo $result33[0]['ID']; ?>&delete=1'>Delete</a></td>
        </tr>

<?php }


}
 ?>
