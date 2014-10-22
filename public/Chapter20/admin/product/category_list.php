<?php include '../../view/header.php'; ?>
<?php include '../../view/sidebar_admin.php'; ?>
    <div id="content">
        <h1>Product Manager - Category List</h1>

        <table id="category_table">
            <tr>
                <td>Name</td>
                <td></td>
            </tr>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category['categoryName'] ?></td>
                    <td>
                        <form action="" method="post" >
                            <input type="hidden" name="action" value="delete_category">
                            <input type="hidden" name="category_id"
                                   value="<?php echo $category['categoryID']; ?>" />
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br/>
        <h2>Add Category</h2>
        <form action="" method="post" id="add_category_form">
            <input type="hidden" name="action" value="add_category">
            <input type="text" name="name"/>
            <input type="submit" value="Add">
        </form>

    </div>

<?php include '../../view/footer.php'; ?>