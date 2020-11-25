<div style="margin: 20px">
    <form action="" method="post" class="was-validated">
        <div class="mb-3">
            <label for="parent_category_id">Select category</label>
            <select class="custom-select"  name="parent_category_id" id="parent_category_id">
                <option value="">--</option>
                <?php
                /** @var  $categories */
                foreach ($categories as  $category):
                    ?>
                    <option value="<?= $category['title'] ?>"><?= $category['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="newtitle">New title</label>
            <input  type="text" name="newtitle" id="newtitle" class="form-control is-invalid placeholder"></input>
        </div>
        <div class="mb-3">
            <label for="parent_category_id">Select new parent category</label>
            <select class="custom-select"  name="new_parent_category_id" id="new_parent_category_id">
                <option value="">--</option>
                <option value="none">NONE</option>
                <?php foreach ($categories as  $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <input name="button"  type="submit" value="Update">
    </form>
</div>


