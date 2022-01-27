<?php
mb_internal_encoding("utf8");

// 仮保存のファイル名で画像ファイルを取得(ディレクトリとファイル名)
$temp_pic_name = $_FILES['picture']['tmp_name'];

// 元のファイル名で画像ファイルを取得する
$original_pic_name = $_FILES['picture']['name'];
$path_filename = './image/'.$original_pic_name;

// 仮保存のファイルを、imageフォルダに元のファイル名で移動させる
move_uploaded_file($temp_pic_name,'./image/'.$original_pic_name);
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <img src="4eachblog_logo.jpg">
        </header>
        <main>
            <div class="form_contents">
                <h2>会員登録 確認</h2>
                <p>こちらの内容で登録しても宜しいでしょうか？</p>
                <div class="name">
                    氏名：<?php echo $_POST['name']; ?>
                </div>
                <div class="mail">
                    メール：<?php echo $_POST['mail']; ?>
                </div>
                <div class="password">
                    パスワード：<?php echo $_POST['password']; ?>
                </div>
                <div class="picture">
                    プロフィール写真：<?php echo $original_pic_name; ?>
                </div>
                <div class="comments">
                    コメント：<?php echo $_POST['comments']; ?>
                </div>
                <div class="submit_area">
                    <form action="register.php">
                        <input type="submit" class="return_button" value="戻って修正する">
                    </form>
                    <form action="register_insert.php" method="post">
                        <input type="submit" class="submit_button" value="登録する">
                        <input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
                        <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
                        <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
                        <input type="hidden" value="<?php echo $path_filename; ?>" name="path_filename">
                        <input type="hidden" value="<?php echo $_POST['comments']; ?>" name="comments">
                    </form>
                </div>
            </div>
        </main>
        <footer>
            &copy; 2018 InterNous.inc. All rights reserved
        </footer>
    </body>
</html>