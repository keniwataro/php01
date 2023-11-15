<?php



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メイン画面</title>
    <style>

        *{
            margin: 0;
            padding: 0;
        }

        body{
            text-align: center;
        }

        .main{
            height: 100vh;
            width: fit-content;
            margin: 0 auto;
            padding: 0 80px;
            background-color: rgba(100, 200, 60, 0.2);
        }
        
        h1{
            padding: 20px 0;
            background-color: rgba(200, 10, 60, 0.4);
        }

        select{
            font-size: 20px;
        }

        input[type="submit"]{
            font-size: 20px;
            width: 100px;
            display: block;
            margin: 10px auto;
        }

        button{
            font-size: 20px;
            width: 150px;
        }
    </style>
</head>
<body>

    <div class="main">
        <h1>メイン画面</h1>
            
        <form action="display.php" method="get">
            <h2>テスト結果を選択</h2>

            <select name="test" id="slctTest">
                <option value="">選択してください</option>
                <option value="1_2">1学期末</option>
                <option value="2_1">２学期中間</option>
                <option value="2_2">２学期末</option>
                <option value="3_1">３学期中間</option>
                <option value="3_2">学年末</option>
            </select>
            <input type="submit" value="表示">
        </form>

        <h2>テスト結果登録</h2>
        <button id="register">登録ボタン</button>
    </div>
    

    <script>
        // 登録ボタンをクリックしたときの処理
        let register = document.getElementById("register");
        register.addEventListener("click",() =>{
            window.location.href = "post.php";
        });
    </script>
</body>
</html>