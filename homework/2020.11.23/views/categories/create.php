<div style="margin: 20px">
    <form action="" method="post" class="was-validated">
        <div class="mb-3">
            <label for="validationTextarea">Title</label>
            <input  type="text" name="title" id="title" class="form-control is-invalid placeholder="Required example textarea" required></input>
            <div class="invalid-feedback">
                Please enter a message in the textarea.
            </div>
        </div>

        <div class="mb-3">
            <label for="parent_category_id">Check category</label>
            <select class="custom-select"  name="parent_category_id" id="parent_category_id">
                <option value="">--</option>
                <?php foreach (getCategories() as  $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="submit" value="Save">
    </form>
</div>

