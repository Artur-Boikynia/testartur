<?php


class Actionwithcategories extends Connecttodb
{
    /**
     * @param array $data
     * @return bool
     */
    public function createCategories(array $data): bool
    {
        if(empty($data['parent_category_id'])){
            $sql = 'INSERT INTO categories (title) VALUES (?)';
            Connecttodb::getDb();
            $stmt = mysqli_prepare(Connecttodb::getDb(), $sql);
            mysqli_stmt_bind_param($stmt, 's', $data['title']);
            return mysqli_stmt_execute($stmt);
        }
        elseif (!empty($data['parent_category_id'])){
            $sql = 'INSERT INTO categories (title, parent_category_id) VALUES (?, ?)';
            $stmt = mysqli_prepare(Connecttodb::getDb(), $sql);
            mysqli_stmt_bind_param($stmt, 'si', $data['title'], $data['parent_category_id']);
            return mysqli_stmt_execute($stmt);
        }
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        $sql = 'SELECT * FROM categories';
        $stmt = mysqli_prepare(Connecttodb::getDb(), $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    /**
     * @param array $nameOfCategories
     * @return array
     */
    function getCategoriesOne(array $nameOfCategories): array
    {
        $sql = 'SELECT * FROM categories WHERE title = ?';
        $stmt = mysqli_prepare(Connecttodb::getDb(), $sql);
        mysqli_stmt_bind_param($stmt, 's', $nameOfCategories['title'],);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);

    }

    /**
     * @param array $data
     */
    public function updateCategory(array $data): void
    {
        if(empty($data['new_parent_category_id'])){
            $sql = 'UPDATE `categories` SET `title` = ? WHERE `title` = ?';
            $stmt = mysqli_prepare(Connecttodb::getDb(), $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $data['newtitle'],$data['parent_category_id']);
            mysqli_stmt_execute($stmt);
        }
        elseif (!empty($data['new_parent_category_id'])){
            if(empty($_POST['newtitle'])){
                $sql = 'UPDATE categories SET parent_category_id = ? WHERE title = ?';
                $stmt = mysqli_prepare(Connecttodb::getDb(), $sql);
                mysqli_stmt_bind_param($stmt, 'is',$data['new_parent_category_id'] ,$data['parent_category_id']);
                mysqli_stmt_execute($stmt);
                if($data['new_parent_category_id'] == 'none'){
                    $sql1 = 'UPDATE categories SET parent_category_id = NULL WHERE title = ?';
                    $stmt1 = mysqli_prepare(Connecttodb::getDb(), $sql1);
                    mysqli_stmt_bind_param($stmt1, 's',$data['parent_category_id']);
                    mysqli_stmt_execute($stmt1);
                }
            }
            else{
                if($data['new_parent_category_id'] == 'none'){
                    var_dump($data['newtitle']);
                    $sql1 = 'UPDATE categories SET title = ?, parent_category_id = NULL WHERE title = ?';
                    $stmt1 = mysqli_prepare(Connecttodb::getDb(), $sql1);
                    mysqli_stmt_bind_param($stmt1, 'ss',$data['newtitle'], $data['parent_category_id']);
                    mysqli_stmt_execute($stmt1);
                }
                else{
                    $sql = 'UPDATE categories SET title = ?, parent_category_id = ? WHERE title = ?';
                    $stmt = mysqli_prepare(Connecttodb::getDb(), $sql);
                    mysqli_stmt_bind_param($stmt, 'sis', $data['newtitle'], $data['new_parent_category_id'] ,$data['parent_category_id']);
                    mysqli_stmt_execute($stmt);
                }
            }
        }
    }

    /**
     * @param array $nameOfCategories
     * @return array
     */
   public function selectForDelete(array $nameOfCategories): array
    {
        $sql = 'SELECT id from categories WHERE title = ?';
        $stmt = mysqli_prepare(Connecttodb::getDb(), $sql);
        mysqli_stmt_bind_param($stmt, 's', $nameOfCategories['title'],);
        mysqli_stmt_execute($stmt);
        $getResult = mysqli_stmt_get_result($stmt);
        $result = mysqli_fetch_assoc($getResult);

        $sql2 = 'SELECT title FROM categories WHERE parent_category_id = ?';
        $stmt2 = mysqli_prepare(Connecttodb::getDb(), $sql2);
        mysqli_stmt_bind_param($stmt2, 'i', $result['id'],);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);

        return mysqli_fetch_all($result2, MYSQLI_ASSOC);
    }

    /**
     * @param array $nameOfCategories
     * @return bool
     */
    public function functionOfDelete(array $nameOfCategories): bool
    {
        $sql = ' DELETE FROM categories WHERE title = ?';
        $stmt = mysqli_prepare(Connecttodb::getDb(), $sql);
        mysqli_stmt_bind_param($stmt, 's', $nameOfCategories['title']);
        return mysqli_stmt_execute($stmt);

    }

}