<?php
// 送られてきたデータを変数に格納
$name    = $_POST["name"];
$test    = $_POST["test"];
$kokugo  = $_POST["kokugo"];
$sugaku  = $_POST["sugaku"];
$rika    = $_POST["rika"];
$syakai  = $_POST["syakai"];
$eigo    = $_POST["eigo"];
// 学期のデータをファイル名にする処理
$filename = "data/{$test}.txt";
    // テストを表示用に変換
    if($test == "1_2"){
        $testText = "1学期末";
    }else if($test == "2_1"){
        $testText = "２学期中間";
    }else if($test == "2_2"){
        $testText = "２学期末";
    }else if($test == "3_1"){
        $testText = "３学期中間";
    }else if($test == "3_2"){
        $testText = "学年末";
    }


// 情報を配列に入れてJSONデータに変換
$info = array(
    $name => array(
        "kokugo" => $kokugo,
        "sugaku" => $sugaku,
        "rika"   => $rika,
        "syakai" => $syakai,
        "eigo"   => $eigo
    )
);

// ファイルが存在しない場合
if(!file_exists($filename)){

    $arrData = $info;

    // ユニコードとかも含めてきれいにJSON化
    $json = json_encode($arrData ,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

    //File書き込み
    file_put_contents($filename, $json);
}
// ファイルが存在する場合
else{
    $fileData = file_get_contents($filename);
    $arrData = json_decode($fileData,true);

    $arrData[$name] = array(
        "kokugo" => $kokugo,
        "sugaku" => $sugaku,
        "rika"   => $rika,
        "syakai" => $syakai,
        "eigo"   => $eigo
    );

    // ユニコードとかも含めてきれいにJSON化
    $json = json_encode($arrData ,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

    //File書き込み
    file_put_contents($filename, $json);

}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>書き込み画面</title>
    
    <style>
			.main{
				border: 1px solid #000;
				width: fit-content;
				position: absolute;
				top: 50%;
				left : 50%;
				transform: translate(-50%,-50%);
				text-align: center;
                font-size: 20px;
			}


            table{
                margin: 0 auto;
            }

            td{
                width: 100px;
                padding: 5px;
            }

            button {
                margin-top: 20px;
                width: 150px;
                font-size: 15px;
            }
    </style>

</head>
<body>

    <div class="main">
        <p>下記の内容で書き込みました！</p>

        <table border="1">
            <tr>
                <th>名前</th>
                <td><?=$name?></td>
            </tr>
            <tr>
                <th>テスト</th>
                <td><?=$testText?></td>
            </tr>
            <tr>
                <th>国語</th>
                <td><?=$kokugo?>　点</td>
            </tr>
            <tr>
                <th>数学</th>
                <td><?=$sugaku?>　点</td>
            </tr>
            <tr>
                <th>理科</th>
                <td><?=$rika?>　点</td>
            </tr>
            <tr>
                <th>社会</th>
                <td><?=$syakai?>　点</td>
            </tr>
            <tr>
                <th>英語</th>
                <td><?=$eigo?>　点</td>
            </tr>
        </table>

        <button id="back">登録画面に戻る</button>
        <button id="next">メイン画面に戻る</button>

    </div>



    <script>
        // ボタンの変数を取得
        let back = document.getElementById("back");
        let next = document.getElementById("next");
        
        // 登録画面に戻る
        back.addEventListener("click", () => {
            window.location.href = "post.php";
        });

        // メイン画面に戻る処理
        next.addEventListener("click", () => {
            window.location.href = "main.php";
        });


        // history.pushState(null, null, null);
        // // ページ戻り時にも今いるページを履歴に追加
        // window.addEventListener("popstate", function(){
        //     test();
        // });

        // function test(){
        //     history.pushState(null, null, null);
        // // ページ戻り時にも今いるページを履歴に追加
        // window.addEventListener("popstate", function(){
        //     history.pushState(null, null, null);
        //     // 確認ダイヤログを表示。不要な場合は削除
        //     alert('ブラウザの戻るボタンは使えません。');
        // });

        // }


    </script>

</body>
</html>
