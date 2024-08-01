<?php

class GamePlayFunction11x5
{
  public static function getGamePlayFunction(): array
  {  // Game Ids and their respective checker function
    return  [

      #---------------11x5 Standard----------------

      '469' => 'f3straightJoint',
      '470' => 'f3straightManual',
      '474' => 'f3groupJoint',
      '475' => 'f3straightManual',
      '476' => 'f2straightJoint',
      '477' => 'f2straightManual',
      '478' => 'f2groupJoint',
      '479' => 'f2groupManual',
      '480' => 'anyPlace',
      '481' => 'fixedPlace',
      '482' => 'pickJoint1x1',
      '484' => 'pickJoint2x2',
      '486' => 'pickJoint3x3',
      '488' => 'pickJoint4x4',
      '490' => 'pickJoint5x5',
      '492' => 'pickJoint5x6',
      '494' => 'pickJoint5x7',
      '496' => 'pickJoint5x8',
      '483' => 'pickManual1x1',
      '485' => 'pickManual2x2',
      '487' => 'pickManual3x3',
      '489' => 'pickManual4x4',
      '491' => 'pickManual5x5',
      '493' => 'pickManual5x6',
      '495' => 'pickManual5x7',
      '497' => 'pickManual5x8',
      '498' => 'fixedDigit2x2',
      '499' => 'fixedDigit3x3',
      '500' => 'fixedDigit4x4',
      '501' => 'fixedDigit5x5',
      '502' => 'fixedDigit5x6',
      '503' => 'fixedDigit5x7',
      '504' => 'fixedDigit5x8',
      '505' => 'funOddEven',
      '506' => 'funTheMiddleNo',

      #---------------11x5 2Sides----------------=> waiting for 2side game ids
      '198,199,200,201,202'=>'twoSidesRapido',
      '203,204'=>'pick',
      '231'=>'straightFirst2Group',
      '224'=>'straightFirst3Group',

      #---------------11x5 Board Games-------------=> waiting for 2side game ids
      '1209,1210,1211' => 'UpperAndLowerPlate',
      '1219,1220' => 'OddandEvenDisk',
      '1212,1213,1214,1215,1216,1217,1218' => 'GuessTheNumberMiddle',
      '1221,1222,1223,1224,1225,1226,1227,1228,1229,1230,1231,1232,1233,1234,
       1235,1236,1237,1238,1239,1240,1241,1242,1243,1244,,1245,1246,1247,1248,1249,1250,1251' => 'GuessTheNumberSum',

      // boardgamestype 2********************

      '1183,1184,1185,1186' => 'bull_bull_bsoe',
      '1187,1188,1189,1190,1191,1192,1193,1194,1195,1196,1252' => 'bull_bull_board',
      '1197,1198,1199,1200,1201' => 'board_maximum',
      '1202,1203,1204,1205,1206' => 'board_minimum',
      '1207,1208' => 'board_dragonTigerTie',
      
      #---------------11x5 Road bet----------------=> 

      '1181,1182,1180,79,80' => 'SumAllDrawNumber',
      '1170, 1175, 69' => 'FirstBall',
      '1171, 1176, 70, 75' => 'SecondBall',
      '1172, 1177, 71, 76' => 'ThirdBall',
      '1173, 1178, 72, 77' => 'FourthBall',
      '1174, 1179, 73, 78' => 'FifthBall',

      // '1179' => 'FifthBall',

      #--------------- Dragon Tiger ----------------=> 
          
      '1,6' => 'BigSmallFirstBall',
      // '6' => 'BigSmallFirstBall',
      '2,7' => 'BigSmallSecondBall',
      // '7' => 'BigSmallSecondBall',
      '3,8' => 'BigSmallThirdBall',
      // '8' => 'BigSmallThirdBall',
      '4,9' => 'BigSmallFourthBall',
      // '9' => 'BigSmallFourthBall',
      '5,10' => 'BigSmallFifthBall',
      // '10' => 'BigSmallFifthBall',
      '11' => 'first_vrs_second',
      '12' => 'first_vrs_third',
      '13' => 'first_vrs_fourth',
      '14' => 'first_vrs_fifth',
      '15' => 'second_vrs_third',
      '16' => 'second_vrs_fourth',
      '17' => 'second_vrs_fifth',
      '18' => 'third_vrs_fourth',
      '19' => 'third_vrs_fifth',
      '20' => 'fourth_vrs_fifth',
      '21,22' => 'sumBigSmallOddEven',
      // '22' => 'sumBigSmallOddEven',

      #---------------- long Dragon ---------------=>

      '69,70,71,72,73,74,75,76,77,78,79,80,81'=>'Dragon'

    ];
  }
}
