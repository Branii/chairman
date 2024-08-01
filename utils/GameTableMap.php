<?php 

class GameTableMap {

    public static function getTables(): array {

        $json = '{
            "1": {
                "draw_table": "draw_numbers",
                "bet_table": "bet",
                "draw_storage": "royal5draw"
            },
            "3": {
                "draw_table": "dt_royal10",
                "bet_table": "bt_royal10",
                "draw_storage": "ds_royal10"
            },
            "4": {
                "draw_table": "dt_1kb5d1m",
                "bet_table": "bt_1kb5d1m",
                "draw_storage": "ds_1kb5d1m"
            },
            "5": {
                "draw_table": "dt_luckypick5",
                "bet_table": "bt_luckypick5",
                "draw_storage": "ds_luckypick5"

            },
            "6": {
                "draw_table": "dt_1kball1min",
                "bet_table": "bt_1kball1min",
                "draw_storage": "ds_1kball1min"
            },
            "7": {
                "draw_table": "dt_speedy1min",
                "bet_table": "bt_speedy1min",
                "draw_storage": "ds_speedy1min"
            },
            "8": {
                "draw_table": "dt_speedy5d3min",
                "bet_table": "bt_speedy5d3min",
                "draw_storage": "ds_speedy5d3min"
                
            },
            "9": {
                "draw_table": "dt_Lucky5D15mins",
                "bet_table": "bt_Lucky5D15mins",
                "draw_storage": "ds_Lucky5D15mins"
            },
            "10": {
                "draw_table": "dt_Fast31min",
                "bet_table": "bt_Fast31min",
                "draw_storage": "ds_Fast31min"
            },
            "11": {
                "draw_table": "dt_SpeedyFast315mins",
                "bet_table": "bt_SpeedyFast315mins",
                "draw_storage": "ds_SpeedyFast315mins"
            },
            "12": {
                "draw_table": "dt_LuckyFast33mins",
                "bet_table": "bt_LuckyFast33mins",
                "draw_storage": "ds_LuckyFast33mins"
            },
            "13": {
                "draw_table": "dt_1kballPc281mins",
                "bet_table": "bt_1kballPc281mins",
                "draw_storage": "ds_1kballPc281mins"
            },
            "14": {
                "draw_table": "dt_SpeedyPc2815mins",
                "bet_table": "bt_SpeedyPc2815mins",
                "draw_storage": "ds_SpeedyPc2815mins"
            },
            "15": {
                "draw_table": "dt_Luckypc283mins",
                "bet_table": "bt_Luckypc283mins",
                "draw_storage": "ds_Luckypc283mins"
            },
            "16": {
                "draw_table": "dt_Lucky3D",
                "bet_table": "bt_Lucky3D",
                "draw_storage": "ds_Lucky3D"
            },
            "17": {
                "draw_table": "dt_SpeedyPK1015min",
                "bet_table": "bt_SpeedyPK1015min",
                "draw_storage": "ds_SpeedyPK1015min"
            },
            "23": {
                "draw_table": "dt_LuckyPK103m",
                "bet_table": "bt_LuckyPK103m",
                "draw_storage": "ds_LuckyPK103m"
            },
            "25": {
                "draw_table": "dt_rapidmark6",
                "bet_table": "bt_rapidmark6",
                "draw_storage": "ds_rapidmark6"
            },
            "26": {
                "draw_table": "dt_mark65min",
                "bet_table": "bt_mark65min",
                "draw_storage": "ds_mark65min"
            },
            "27": {
                "draw_table": "dt_rapid11x5",
                "bet_table": "bt_rapid11x5",
                "draw_storage": "ds_rapid11x5"
            },
            "28": {
                "draw_table": "dt_lucky11x55min",
                "bet_table": "bt_lucky11x55min",
                "draw_storage": "ds_lucky11x55min"
            },
            "29": {
                "draw_table": "dt_rapidhappy8",
                "bet_table": "bt_rapidhappy8",
                "draw_storage": "ds_rapidhappy8"
            },
            "30": {
                "draw_table": "dt_Hanoi3D",
                "bet_table": "bt_Hanoi3D",
                "draw_storage": "ds_Hanoi3D"
            },
            "31": {
                "draw_table": "dt_Fast3_BG_1min",
                "bet_table": "bt_Fast3_BG_1min",
                "draw_storage": "ds_Fast3_BG_1min"
            },
            "32": {
                "draw_table": "dt_Mark6_BG1min",
                "bet_table": "bt_Mark6_BG1min",
                "draw_storage": "ds_Mark6_BG1min"
            },
            "33": {
                "draw_table": "dt_11x5BG1min",
                "bet_table": "bt_11x5BG1min",
                "draw_storage": "ds_11x5BG1min"
            },
            "34": {
                "draw_table": "dt_Pk10BG1min",
                "bet_table": "bt_Pk10BG1min",
                "draw_storage": "ds_Pk10BG1min"
            },
            "35": {
                "draw_table": "dt_Happy8_BG1min",
                "bet_table": "bt_Happy8_BG1min",
                "draw_storage": "ds_Happy8_BG1min"
            },
            "36": {
                "draw_table": "dt_5dboardgames",
                "bet_table": "bt_5dboardgames",
                "draw_storage": "ds_5dboardgames"
            },
            "37": {
                "draw_table": "dt_5dFantan1min",
                "bet_table": "bt_5dFantan1min",
                "draw_storage": "ds_5dFantan1min"
            },
            "38": {
                "draw_table": "dt_Pk10Fantan1min",
                "bet_table": "bt_Pk10Fantan1min",
                "draw_storage": "ds_Pk10Fantan1min"
            },
            "39": {
                "draw_table": "dt_Fast3Fantan1min",
                "bet_table": "bt_Fast3Fantan1min",
                "draw_storage": "ds_Fast3Fantan1min"
            },
            "40": {
                "draw_table": "dt_11x5Fantan1min",
                "bet_table": "bt_11x5Fantan1min",
                "draw_storage": "ds_11x5Fantan1min"
            },
            "41": {
                "draw_table": "dt_Mark6Fantan1min",
                "bet_table": "bt_Mark6Fantan1min",
                "draw_storage": "ds_Mark6Fantan1min"
            },
            "41": {
                "draw_table": "dt_Mark6Fantan1min",
                "bet_table": "bt_Mark6Fantan1min",
                "draw_storage": "ds_Mark6Fantan1min"
            },
            "42": {
                "draw_table": "dt_Happy8Fantan1min",
                "bet_table": "bt_Happy8Fantan1min",
                "draw_storage": "ds_Happy8Fantan1min"
            }
            
           
        }';

        return json_decode($json, true);
      
    }

}