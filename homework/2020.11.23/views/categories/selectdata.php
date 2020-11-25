<div style="margin: 20px">
    <form action="" method="post" class="was-validated">
        <div class="mb-3">
            <select class="custom-select"  name="title" id="title">
                <option value="">--</option>
                <?php
                /** @var $categories */
                foreach ($categories as  $category):
                    ?>
                    <option value="<?= $category['title'] ?>"><?= $category['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="submit" value="Save">
    </form>
</div>


