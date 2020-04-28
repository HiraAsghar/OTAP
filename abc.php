<html>
<body>
<?php 
if (isset($_POST["username"])){
$username = $_POST['Username'];
$password = $_POST['password'];
if ($username =='myaccount' AND $password=='myaccount123') {
echo '<a href=main.html"></a>';
}
else {
echo "You have not requested a login form!";
} }
?>
</body>
</html>