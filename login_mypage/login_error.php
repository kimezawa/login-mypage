<?php
session_start();
if(isset($_SESSION['id'])){
    header('Location:mypage.php');
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ログイン</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <img src="4eachblog_logo.jpg" class="logo_margin">
            <div class="login"><a href="login.php">ログイン</a></div>
        </header>
        <main>
            <div class="form_contents _smallwidth">
                <form method="post" action="mypage.php">
                    <div class="error">
                        メールアドレスまたはパスワードが間違っています。
                    </div>
                    <div class="mail">
                        <label>メールアドレス</label><br>
                        <input type="text" class="formbox" size="40" name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                    </div>
                    <div class="password">
                        <label>パスワード</label><br>
                        <input type="password" class="formbox" size="40" name="password" id="password" pattern="^[a-zA-Z0-9]{6,}$" required>
                    </div>
                    <div class="keep">
                        <label><input type="checkbox" name="login_keep" value="login_keep">ログイン状態を保持する</label>
                    </div>
                    <div class="submit_area">
                        <input type="submit" class="submit_button" value="ログイン">
                    </div>
                </form>
            </div>
        </main>
        <footer>
            &copy; 2018 InterNous.inc. All rights reserved
        </footer>
    </body>
</html>