<?php
// 日付と各種合計での日数計算をする
$fileName = 'sample.json';
if(isset($_GET['name'])){
    $fileName = $_GET['name']  . '.json'; 
}
echo $fileName;
$stateDate = date("Y/m/d");
if(file_exists($fileName)) {
    $json = file_get_contents($fileName);
    $outputData = json_decode($json, true);
    echo $outputData[$stateDate];
    if (isset($outputData["dates"][$stateDate])) {
        $outputData["dates"][$stateDate] += 1;
    } else {
        $outputData["dates"][$stateDate] = 1;
    }
    $outputData["totalCnt"] += 1;
} else {
    $outputData = array();
    $outputData["dates"] = array($stateDate=> 1);
    $outputData["totalCnt"] = 1;
}

// データの更新処理を行う(jsonファイル形式で保存)
$data = json_encode($outputData);
$json = fopen($fileName, 'w+b');
fwrite($json, $data);
fclose($json);

