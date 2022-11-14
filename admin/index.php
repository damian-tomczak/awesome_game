<?php include "header.php" ?>
<?php include "menu.php" ?>
<td id="main" colspan="2">
    <h3>Dashboard</h3>
    <p>Great to see you again <?php echo htmlspecialchars($_SESSION["username"]); ?> &lt;3</p>
    <p><a href="../logout.php">back to welcome page</a></p>
</td>
<?php include "footer.php" ?>