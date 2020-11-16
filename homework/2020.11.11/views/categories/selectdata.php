<div style="margin: 20px">
    <form action="" method="post" class="was-validated">
        <div class="mb-3">
            <select class="custom-select"  name="title" id="title">
                <option value="">--</option>
                <?php foreach (getCategories() as  $category): ?>
                    <option value="<?= $category['title'] ?>"><?= $category['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="submit" value="Save">
    </form>
</div>
<?php
$categories = getCategoriesOne($_POST);
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
    <?php for($i=0; $i < count($categories); $i++):?>
        <tr>
            <td><?=$categories[$i]['id']?></td>
            <td><?=$categories[$i]['title']?></td>
            <td><?=$categories[$i]['parent_category_id']?></td>
            <td><?=$categories[$i]['created_at']?></td>
            <td><?=$categories[$i]['updated_at']?></td>
        </tr>
    <?php endfor; ?>
</table>
