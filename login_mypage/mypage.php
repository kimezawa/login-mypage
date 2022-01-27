<?php
mb_internal_encoding("utf8");
session_start();

// ログイン状態でmypage.phpに戻ってきたときは処理をスキップ
if(empty($_SESSION['id'])){
    try{
        $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
    }catch(PDOException $e){
        die(
            "<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインをしてください。</p><a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
        );
    }

    // プリペアードステートメント
    $stmt = $pdo -> prepare("select * from login_mypage where mail = ? && password = ?");

    // bindValueメソッドでパラメータをセット
    $stmt -> bindValue(1,$_POST["mail"]);
    $stmt -> bindValue(2,$_POST["password"]);

    // executeでクエリを実行
    $stmt -> execute();
    $pdo = NULL;

    // fetch・while文でデータ取得し、sessionに代入
    while($row = $stmt -> fetch()){
        $_SESSION["id"] = $row["id"];
        $_SESSION["name"] = $row["name"];
        $_SESSION["mail"] = $row["mail"];
        $_SESSION["password"] = $row["password"];
        $_SESSION["picture"] = $row["picture"];
        $_SESSION["comments"] = $row["comments"];
    }

    // sessionが無ければエラー画面にリダイレクト
    if(empty($_SESSION["id"])){
        header("Location:login_error.php");
    }

    if(!empty($_POST['login_keep'])){
        $_SESSION['login_keep'] = $_POST['login_keep'];
    }
}

if(!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])){
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('login_keep',$_SESSION['login_keep'],time()+60*60*24*7);
} else if(empty($_SESSION['login_keep'])){
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('login_keep','',time()-1);
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
                <div class="name _mypage">
                    氏名：<?php echo $_SESSION["name"]; ?>
                </div>
                <div class="mail _mypage">
                    メール：<?php echo $_SESSION["mail"]; ?>
                </div>
                <div class="password _mypage">
                    パスワード：<?php echo $_SESSION["password"]; ?>
                </div>
                <div class="comments_box">
                    <?php echo $_SESSION["comments"]; ?>
                </div>
                <div class="submit_area">
                    <form method="post" action="mypage_hensyu.php">
                        <input type="hidden" value="<?php echo rand(1,10); ?>" name="from_mypage">
                        <input type="submit" class="submit_button" value="編集する">
                    </form>
                </div>
            </div>
        </main>
        <footer>
            &copy; 2018 InterNous.inc. All rights reserved
        </footer>
    </body>
</html>