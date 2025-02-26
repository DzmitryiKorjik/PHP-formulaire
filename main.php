<?php
   include 'read_table.php';
    $name = "Dzmitryi";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <?php 
        include 'inc/header.html';
    ?>
    <div class="container">
        <h1>
            Bonjour <?php echo $name;?>!
        </h1>
        <h2>Liste des utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>last name</th>
                    <th>first name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>User rôle</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultats as $row) {?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['last_name'];?></td>
                        <td><?php echo $row['first_name'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['password'];?></td>
                        <td><?php echo $row['user_role'];?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        <div id="block_user" class="block_user">
            <div class="block_user-creat">
                <?php 
                    include 'inc/create_user.html';
                ?>
            </div>
            <div class="block_user-delete">
                <?php 
                    include 'inc/delete_user.html';
                ?>
            </div>
        </div>
    </div>
    <?php 
        include 'inc/footer.html';
    ?>
</body>
</html>