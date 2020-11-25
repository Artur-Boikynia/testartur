
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
    /** @var  $selectedCategories */
        $countFor = count($selectedCategories);
        for($i=0; $i < $countFor; $i++):
    ?>
        <tr>
            <td><?= $selectedCategories[$i]['id'] ?></td>
            <td><?= $selectedCategories[$i]['title'] ?></td>
            <td><?= $selectedCategories[$i]['parent_category_id'] ?></td>
            <td><?= $selectedCategories[$i]['created_at'] ?></td>
            <td><?= $selectedCategories[$i]['updated_at'] ?></td>
        </tr>
    <?php endfor; ?>
</table>