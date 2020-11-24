<?php
$categories = getCategories();
?>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">TITLE</th>
        <th scope="col">PARENT_CATEGORY_ID</th>
        <th scope="col">CREATED_AT</th>
        <th scope="col">UPDATED_AT</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $countFor = count($categories);       //fixed
        for($i=0; $i < $countFor; $i++):
    ?>
        <tr>
            <td><?= $categories[$i]['id'] ?></td>
            <td><?= $categories[$i]['title'] ?></td>
            <td><?= $categories[$i]['parent_category_id'] ?></td>
            <td><?= $categories[$i]['created_at'] ?></td>
            <td><?= $categories[$i]['updated_at'] ?></td>
        </tr>
    <?php endfor; ?>
</table>
