<?php
    // エラーが見やすくなる
    ini_set('display_errors', "On");

    // テストデータをゲット！
    $test = $_GET["test"];
    $filename = "data/{$test}.txt";

    // 名前を取得
    $name = "";
    if(isset($_GET["name"])){
        $name = $_GET["name"];
    }

    // 無選択の場合はメイン画面に戻る
    if($test == ""){
        header("Location:main.php");
    }

    // ファイルが存在しない場合
    if( !file_exists($filename) ){
        echo "ファイルが存在しません";
        return;
    }
    // ファイルが存在する場合
    else{
        $fileData = file_get_contents($filename);
        $arrData = json_decode($fileData,true);
    }


    // 平均と標準偏差を求める関数
    function hensa($arrData,$kyoka){
        
        $kekka  = array();  // 戻り値（平均、偏差）
        $hensa  = 0;        // 偏差の値を初期化
        $heikin = 0;        // 平均の値を初期化
        $cnt    = 0;        // 人数の合計

        // 繰り返し
        foreach($arrData as $key => $value){
            // 教科の値を加算
            $heikin += $arrData[$key][$kyoka];
            // 教科を2乗した値を代入
            $hensa += pow($arrData[$key][$kyoka],2);
            // 人数をカウント
            $cnt++;
        }

        // 結果を格納
        $kekka["heikin"] = intval($heikin / $cnt);
        $kekka["hensa"] = sqrt($hensa / $cnt);

        return $kekka;
    }

    // 各教科の平均点と標準偏差を配列に格納
    $arrH = array();
    $arrH[0] = hensa($arrData,"kokugo");
    $arrH[1] = hensa($arrData,"sugaku");
    $arrH[2] = hensa($arrData,"rika");
    $arrH[3] = hensa($arrData,"syakai");
    $arrH[4] = hensa($arrData,"eigo");
    

    // 名前が選択されている場合
    if(isset($name)){
        if($name != ""){
            // 各教科の点数と偏差値を格納
            $nameData = array();
            // 国語
            $nameData[0][0] = (int)$arrData[$name]["kokugo"];
            $nameData[0][1] = ($nameData[0][0] - $arrH[0]["heikin"] ) / $arrH[0]["hensa"] * 10 + 50;
            $nameData[0][1] = intval($nameData[0][1]);
            $nameData[0][2] = "国語";
            // 数学
            $nameData[1][0] = (int)$arrData[$name]["sugaku"];
            $nameData[1][1] = ($nameData[1][0] - $arrH[1]["heikin"] ) / $arrH[1]["hensa"] * 10 + 50;
            $nameData[1][1] = intval($nameData[1][1]);
            $nameData[1][2] = "数学";
            // 理科
            $nameData[2][0] = (int)$arrData[$name]["kokugo"];
            $nameData[2][1] = ($nameData[2][0] - $arrH[2]["heikin"] ) / $arrH[2]["hensa"] * 10 + 50;
            $nameData[2][1] = intval($nameData[2][1]);
            $nameData[2][2] = "理科";
            // 社会
            $nameData[3][0] = (int)$arrData[$name]["kokugo"];
            $nameData[3][1] = ($nameData[3][0] - $arrH[3]["heikin"] ) / $arrH[3]["hensa"] * 10 + 50;
            $nameData[3][1] = intval($nameData[3][1]);
            $nameData[3][2] = "社会";
            // 英語
            $nameData[4][0] = (int)$arrData[$name]["kokugo"];
            $nameData[4][1] = ($nameData[4][0] - $arrH[4]["heikin"] ) / $arrH[4]["hensa"] * 10 + 50;
            $nameData[4][1] = intval($nameData[4][1]);
            $nameData[4][2] = "英語";
        }
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>表示画面</title>

    <style>
        .main{
            width: fit-content;
            margin: 0 auto;
            text-align: center;
            background-color: rgba(20, 50, 40, 0.1);

        }

        h2{
            margin: 0;
            background-color: rgba(200, 20, 40, 0.7);
        }

        table{
            margin: 10px auto;
        }

        th{
            width: 80px;
        }

        select{
            font-size: 15px;
            padding: 5px;
        }
    </style>

</head>
<body>

    <div class="main">
        <form id="slctName" action="display.php" method="get">
            <h2>名前選択</h2>
            <input type="hidden" name="test" value="<?=$test?>">
            <select name="name" onchange="slctSbmt()">
                <option value="">選択してください</option>
                <option value="山田太郎">山田太郎</option>
                <option value="田中一郎">田中一郎</option>
                <option value="岩田健">岩田健</option>
                <option value="江藤愛">江藤愛</option>
                <option value="緒方夏子">緒方夏子</option>
                <option value="加藤秋">加藤秋</option>
                <option value="木島三郎">木島三郎</option>
            </select>
            <!-- <input type="submit" value="表示"> -->
        </form>

        <script>
                function slctSbmt(){
                    document.getElementById("slctName").submit();
                }
        </script>

        <?php if(!isset($_GET["name"]) || $name == null)return?>

        <h2><?=$name?>さんの成績</h2>

        <canvas id="myChart" style="width: 600px;"></canvas>

        <table border="1">
            <tr>
                <th></th>
                <th>国語</th>
                <th>数学</th>
                <th>理科</th>
                <th>社会</th>
                <th>英語</th>
            </tr>
            <tr>
                <th>得点</th>
                <td><?=$nameData[0][0]?></td>
                <td><?=$nameData[1][0]?></td>
                <td><?=$nameData[2][0]?></td>
                <td><?=$nameData[3][0]?></td>
                <td><?=$nameData[4][0]?></td>
            </tr>
            <tr>
                <th>偏差値</th>
                <td><?=$nameData[0][1]?></td>
                <td><?=$nameData[1][1]?></td>
                <td><?=$nameData[2][1]?></td>
                <td><?=$nameData[3][1]?></td>
                <td><?=$nameData[4][1]?></td>
            </tr>
        </table>

        <button id="mainBtn">メイン画面に戻る</button>

    </div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0 "></script>

<script>

    // メイン画面に戻るボタンの処理
    let mainBtn = document.getElementById("mainBtn");
    mainBtn.addEventListener("click",() =>{
        window.location.href = "main.php";
    });


    // グラフ表示
    const ctx = document.getElementById("myChart");
    const myPieChart = new Chart(ctx, {
        data: {
            labels: ["国語", "数学", "理科", "社会", "英語"],
            datasets: [
                // 偏差値
                {
                    type: 'line',       //グラフの種類「線」
                    label: "偏差値",    //グラフラベル
                    yAxisID: "hensa",   //Y軸ID
                    backgroundColor: "rgb(255, 22, 22)",
                    borderColor:     "rgb(122, 255, 130)",
                    data: [<?=$nameData[0][1]?>,
                            <?=$nameData[1][1]?>,
                            <?=$nameData[2][1]?>,
                            <?=$nameData[3][1]?>,
                            <?=$nameData[4][1]?>],
                },
                // 得点
                {
                    type: 'bar',        //グラフの種類「棒」
                    label: "得点",      //グラフラベル
                    yAxisID: "point",   //Y軸ID
                    backgroundColor: [
                    "#BB5179",
                    "#FAFF67",
                    "#58A27C",
                    "#3C00FF",
                    "#89CD43",
                    ],
                    data: [<?=$nameData[0][0]?>,
                            <?=$nameData[1][0]?>,
                            <?=$nameData[2][0]?>,
                            <?=$nameData[3][0]?>,
                            <?=$nameData[4][0]?>],
                }
            ]
        },
        // pluginとしてchartdatalabelsを追加
        plugins: [ChartDataLabels], 
        // オプション内容
        options: {
            // レスポンシブデザインモード
            responsive:false,
            // プラグイン
            plugins: {
                // グラフタイトル
                title: {
                    display: true,
                    text: '教科毎の点数と偏差値グラフ',
                    font: {
                        size:25,
                    },
                },
                // 凡例ラベル
                legend:{
                    display: false,
                },
                // データラベル
                datalabels: { 
                // 備忘録
                //     formatter: function(value, context) { 
                //     return context.chart.data.labels[context.dataIndex];
                //     },
                // 色
                color:"#000", 
                font: {             // フォント設定
                    weight: "bold", // ラベル表記を太字に変更
                    size: 15,       // サイズ変更
                    }
                }
            },
            // 軸設定
            scales :{
                // 偏差値 Y軸
                "hensa":{
                    type: "linear", 
                    position: "right",
                    grid:{
                        drawOnChartArea: false
                    },
                    max:100,
                    min:0,
                    stepSize:10,
                },
                // 得点 Y軸
                "point":{
                    type: "linear", 
                    position: "left",
                    max:100,
                    min:0,
                    stepSize:10,
                },
            },
        }
    });


    </script>

</body>
</html>