<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>        
    </head>
    <?php
       $fileName = 'sample.json';
       if(isset($_GET['name'])){
         $fileName = $_GET['name']  . '.json'; 
       }
       
       $json = file_get_contents($fileName);
       $outputData = json_decode($json, true);
    ?>
    <body>
        <audio src="./Game_playing.mp3" autoplay loop> あなたのブラウザーは <code>audio</code> 要素をサポートしていません。</audio>
        <h3>ごろ寝頑張った日記</h3>
        <table border="1">
            <tr>
                <th>日付</th>
                <th>ごろ寝数</th>
                <th></th>
                <th>メッセージ</th>
            </tr>
            <?php foreach ($outputData["dates"] as $key => $value): ?>
            <tr>
                <td><?php echo $key; ?></td>
                <td><?php echo $value;?></td>
                <td>
                    <progress max="10" value="<?php echo intval($value)?>"></progress>
                </td>
                <td>
                    <?php if ($value >= 10) :?>
                       頑張った
                    <?php endif;?>
                </td>
            </tr>
            <?php endforeach;?>
            <tr>
                <td>総合計</td>
                <td><?php echo $outputData["totalCnt"]?></td>
                <td>
                    <progress max="<?php echo (count($outputData["dates"]) * 10);?>" value="<?php echo $value?>"></progress>
                </td>
                <td>
                    <?php if ((count($outputData["dates"]) * 10) < $value):?>
                        これからも頑張って!!
                    <?php endif;?>
                </td>
            </tr>
        </table>
    </body>
</html>