<?php
// バリデーション
// 入力値が正しく設定されているか確認し、不正な場合はユーザーに再入力・再選択を促す機能
// ユーザがだつらくしやすいのが会員登録画面。再入力画面ですべて空欄になっていたらみんなめんどくさくなってやめちゃう。

// 何か不備があった時に内容を格納する配列
$errors = [];

// ＰＯＳＴ送信時
if(!empty($_POST)){
// $_POST
// スーパーグローバル変数
// 連想配列で値を保持している
// keyはinputタグに設定されたname属性
// フォーム送信された値の取得
 $name = $_POST['input_name'];
 $email = $_POST['input_email'];
 $password = $_POST['input_password'];
// 空かどうかのチェック
if($name == ''){
    // echo '空です';
    $errors['name'] = 'blank';
}
if($email ==''){
    $errors['email'] = 'blank';
}
// passwordの文字数取得
//strlen(文字列)
// 文字数を産出する
$count = strlen ($password);
if($password == ''){
    $errors['password'] = 'blank';
}elseif($count < 4 || 16 < $count){
    // 空じゃない時
    // ４文字未満、または、１７文字以上
    $errors['password'] = 'length';
}
// 画像のチェック
// input_type="fileで送られるもの
// ファイルに関しては$_FILESというスーバーグローバル変数を使用
// $_FiLESを利用するための決まり事
// １．formタグにenctype="multipart/form-data"が指定されている
// ２．formタグにmethod="POST"が指定されている
// $_FILESの利用方法
// $_FILES[キー]['name']ファイル名
// $_FILES[キー]['temp_name']データそのもの
// 画像名の取得
$file_name = $_FILES['input_img_name']['name'];
// 画像名が空かどうかチェック　＝画像が未選択かどうかチェック
if($file_name != ''){
    // 画像が選択されていた時
}else{
    // 画像が未選択の時
    $errors['image_name'] = 'blank';
}


}





?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Learn SNS</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body style="margin-top: 60px">
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2 thumbnail">
                <h2 class="text-center content_header">アカウント作成</h2>
                <form method="POST" action="signup.php" enctype="multipart/form-data">
                                <!--　formタグ
                    method 送信方法
                　　　action 送信先
                　　　どこにどんな方法で値を送るのかを見る -->
                <!-- signup.phpで値を確認後、check.phpに送信 
                    値の送信先はsignup.php-->
                    <div class="form-group">
                        <label for="name">ユーザー名</label>
                        <input type="text" name="input_name" class="form-control" id="name" placeholder="山田 太郎"
                            value="">
                            <!-- ユーザー名に関するバリデーションメッセージ -->
                            <!-- isset(連想配列[key])
                            メモリ上に連想配列[key]が存在するか
                            存在する場合true、存在しない場合false
                            たとえて言うと、冷蔵庫の中にある牛乳の賞味期限を確認するとき、まず牛乳の存在を確認してから賞味期限を確認しないといけない。
                            ここでも、値の存在を確認してから、その真偽を確かめないといけない。 -->
                            <?php if (isset($errors['name']) && $errors['name'] == 'blank'): ?>
                            <p class = "text-danger">ユーザー名を入力してください</p>
                            <?php endif; ?>

                    </div>
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input type="email" name="input_email" class="form-control" id="email" placeholder="example@gmail.com"
                            value="">
                        <!-- メールアドレスに関するバリデーションメッセージ -->
                        <?php if (isset($errors['email']) && $errors['email'] == 'blank'): ?>
                            <p class = "text-danger">メールアドレスを入力してください</p>
                            <?php endif; ?>


                    </div>
                    <div class="form-group">
                        <label for="password">パスワード</label>
                        <input type="password" name="input_password" class="form-control" id="password" placeholder="4 ~ 16文字のパスワード">

                        <!-- パスワードに関するバリデーションメッセージ -->
                        <?php if (isset($errors['password']) && $errors['password'] == 'blank'): ?>
                            <p class = "text-danger">パスワードを入力してください</p>
                            <?php endif; ?>

                            <?php if (isset($errors['password']) && $errors['password'] == 'length'): ?>
                            <p class = "text-danger">パスワードは４～１６文字で入力してください</p>
                            <?php endif; ?>

                    </div>
                    <div class="form-group">
                        <label for="img_name">プロフィール画像</label>
                        <input type="file" name="input_img_name" id="img_name" accept="image/*">
                        <!-- accept="image/*　画像ファイルのみ選択可能にする。もしどんなファイルでも選択可能にしてしまったら、ウイルスの入ったファイルをユーザにあげられる可能性がある。 -->
                        <?php if (isset($errors['image_name']) && $errors['image_name'] == 'blank'): ?>
                            <p class = "text-danger">画像を選択してください</p>
                            <?php endif; ?>


                    </div>
                    <input type="submit" class="btn btn-default" value="確認">
                    <span style="float: right; padding-top: 6px;">ログインは
                        <a href="../signin.php">こちら</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="../assets/js/jquery-3.1.1.js"></script>
<script src="../assets/js/jquery-migrate-1.4.1.js"></script>
<script src="../assets/js/bootstrap.js"></script>
</html>

<!-- 新しい機能を実装するときに以前の機能が崩れていないかを確認するのも大切。 -->
<!-- コメント追加 -->