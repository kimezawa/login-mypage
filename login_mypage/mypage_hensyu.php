<?php
mb_internal_encoding("utf8");
session_start();

if(empty($_POST['from_mypage'])){
    header('Location:login_error.php');
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <img src="4eachblog_logo.jpg" class="logo_margin">
            <div class="login"><a href="log_out.php">ログアウト</a></div>
        </header>        
        <main>
            <div class="form_contents">
                <h2>会員情報</h2>
                <div>こんにちは!　<?php echo $_SESSION["name"]; ?>さん</div>
                <div class="picture_box">
                    <img src="<?php echo $_SESSION["picture"]; ?>">
                </div>
                <form method="post" action="mypage_update.php">
                    <div class="name _mypage">
                        氏名：<input type="text" class="formbox" size="30" name="name" value="<?php echo $_SESSION["name"]; ?>" required>
                    </div>
                    <div class="mail _mypage">
                        メール：<input type="text" class="formbox" size="30" name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php echo $_SESSION["mail"]; ?>" required>
                    </div>
                    <div class="password _mypage">
                        パスワード：<input type="text" class="formbox" size="30" name="password" id="password" pattern="^[a-zA-Z0-9]{6,}$" value="<?php echo $_SESSION["password"]; ?>" required>
                    </div>
                    <div class="comments_box">
                        <textarea class="formbox" rows="3" cols="74" name="comments"><?php echo $_SESSION["comments"]; ?></textarea>
                    </div>
                    <div class="submit_area">
                        <input type="submit" class="submit_button" value="この内容に変更する">
                    </div>
                </form>
            </div>
        </main>
        <footer>
            &copy; 2018 InterNous.inc. All rights reserved
        </footer>
    </body>
</html>