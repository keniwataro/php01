<html>
	<head>
		<meta charset="utf-8">
		<title>入力画面</title>

		<style>

			.main{
				border: 1px solid #000;
				width: fit-content;
				position: absolute;
				top: 50%;
				left : 50%;
				transform: translate(-50%,-50%);
				text-align: center;
				padding: 20px 40px;
			}

			h1{
				background-color: greenyellow;
			}

			input,select {
				width: 150px;
				margin: 5px 10px;
				padding: 3px;
				text-align: center;
				font-size: 15px;
			}

			button{
				font-size: 20px;
			}

		</style>

	</head>

	<body>

		<div class="main">
			<h1>入力画面</h1>

			<form action="write.php" method="post">

			<table>
				<tr>
					<td>名前</td>
					<td>
						<select name="name" id="iptName" onchange="chkIpt()">
							<option value="">選択してください</option>
							<option value="山田太郎">山田太郎</option>
							<option value="田中一郎">田中一郎</option>
							<option value="岩田健">岩田健</option>
							<option value="江藤愛">江藤愛</option>
							<option value="緒方夏子">緒方夏子</option>
							<option value="加藤秋">加藤秋</option>
							<option value="木島三郎">木島三郎</option>
						</select>
					</td>
				</tr>

				<tr>
					<td>テスト</td>
					<td>
						<select name="test" id="iptTest" onchange="chkIpt()">
							<option value="">選択してください</option>
							<option value="1_2">1学期末</option>
							<option value="2_1">２学期中間</option>
							<option value="2_2">２学期末</option>
							<option value="3_1">３学期中間</option>
							<option value="3_2">学年末</option>
						</select>
					</td>
				</tr>

				<tr>
					<td>国語</td>
					<td><input id="iptK" type="number" name="kokugo" placeholder="数字で入力" oninput="chkIpt()">点</td>
				</tr>

				<tr>
					<td>数学</td>
					<td><input id="iptSu" type="number" name="sugaku" placeholder="数字で入力" oninput="chkIpt()">点</td>
				</tr>

				<tr>
					<td>理科</td>
					<td><input id="iptR" type="number" name="rika" placeholder="数字で入力" oninput="chkIpt()">点</td>
				</tr>

				<tr>
					<td>社会</td>
					<td><input id="iptSy" type="number" name="syakai" placeholder="数字で入力" oninput="chkIpt()">点</td>
				</tr>

				<tr>
					<td>英語</td>
					<td><input id="iptE" type="number" name="eigo" placeholder="数字で入力" oninput="chkIpt()">点</td>
				</tr>
			</table>
				<!-- 最初は非表示 -->
				<input id="sbmtBtn" type="submit" value="送信" disabled>
			</form>
			<button id="mainBtn">メイン画面に戻る</button>
		</div>



		<script>
			// セレクタを取得して関数に代入
			let iptName = document.querySelector("#iptName");
			let iptTest = document.querySelector("#iptTest");
			let iptK 	= document.querySelector("#iptK");
			let iptSu 	= document.querySelector("#iptSu");
			let iptR 	= document.querySelector("#iptR");
			let iptSy 	= document.querySelector("#iptSy");
			let iptE 	= document.querySelector("#iptE");
			let sbmtBtn = document.querySelector("#sbmtBtn");
			let mainBtn = document.querySelector("#mainBtn");

			// メイン画面に戻る
			mainBtn.addEventListener("click" , ()=>{
				window.location.href = "main.php";
			});

			// 入力チェック
			function chkIpt(){
				// 選択チェック
				if(iptName.value != "" &&
					iptTest.value != ""
				){
					if(iptK.value != "" &&
					iptSu.value != "" 	&&
					iptR.value != "" 	&&
					iptSy.value != "" 	&&
					iptE.value != "" 
					){
						if(iptK.value >= 0 	&& iptK.value <= 100 	&&
						iptSu.value >= 0 	&& iptSu.value <= 100 	&&
						iptR.value >= 0 	&& iptR.value <= 100 	&&
						iptSy.value >= 0 	&& iptSy.value <= 100 	&&
						iptE.value >= 0 	&& iptE.value <= 100 	
						){
							sbmtBtn.disabled = false;
							return;
						}
					}
				}
				
				sbmtBtn.disabled = true;
			}

		</script>

	</body>
</html>