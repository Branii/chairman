<?php

class GamePlayFunctionPK10
{

  public static function getGamePlayFunction(): array
  {  // Game Ids and their respective checker function
    return [

      #---------------Pk10 Standard----------------

      '358' => 'FirstOneStraightJoint',
      '359' => 'FirstTwoStraightJoint',
      '361' => 'FirstThreeStraightJoint',
      '363' => 'FirstFourStraightJoint',
      '365' => 'FirstFiveStraightJoint',
      '360' => 'FirstTwoStraightManual',
      '362' => 'FirstThreeStraightManual',
      '364' => 'FirstFourStraightManual',
      '366' => 'FirstFiveStraightManual',
      '367' => 'FirstFiveFixedPlace',
      '368' => 'LastFiveFixedPlace',
      '369' => 'DragonTiger',
      '370' => 'Pick2Joint',
      '371' => 'Pick2Manual',
      '372' => 'Pick3Joint',
      '373' => 'Pick3Manual',
      '374' => 'BseoFirst5',
      '375' => 'BsoeTopTwo',
      '376' => 'pk10SumOfTwo',
      '378' => 'Royal10SumOfFirst3',

      #---------------PK10 2Sides----------------=> waiting for 2side game ids
      #---------------PK10 Bord Games----------------=> waiting for 2side game ids
      '1148,1149' => 'FarwardAndBack',
      '1150,1151,1152,1153,1154,1155,1156,1157,1158,1159' => 'GuessTheWinner',
      '1160,1161,1162,1163,1164' => 'MaximumValue',
      '1165,1166,1167,1168,1169' => 'MinimumValue',
      '1170,1171' => 'QuickOrSlow',

      #---------------PK10 Road Bet Games----------------=> 
      '1116,1117' => 'SumOfFirstTwo',
      '1128,1138,1118' => 'BigSmallFirstBall',
      '1129,1139,1119' => 'BigSmallSecondBall',
      '1130,1140,1120' => 'BigSmallThirdBall',
      '1131,1141,1121' => 'BigSmallFourthBall',
      '1132,1142,1122' => 'BigSmallFifthBall',
      '1133,1143' => 'BigSmallSixBall',
      '1134,1144' => 'BigSmallSevenBall',
      '1135,1145' => 'BigSmallEightBall',
      '1136,1146' => 'BigSmallNineBall',
      '1137,1147' => 'BigSmallTenBall',

      // ------------ PK10 2Sides Games ------------------=>
      '156' => 'Rapido',
      '165' => 'Two2sidesSumofTopTwo',
      '167' => 'Ball1To10',
      '166' => 'FixedPlaceDummy',
      '168' => 'SumofTwo',

      // ------------ pk 10 logn dragon -----------------=>
      '23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,
      38,39,40,41,42,43,44,82,83,84,85,86' => 'LongDragon',

      // ------------ pk 10 fanatan --------------------=>

      '379,380,381,382,383,384,385,386,387,388,
      389,390,391,392,393,394,395,396' => 'FantanMain',

      '416, 408,409, 404,405, 406,407, 397, 398, 399,
      413, 410, 402,403,412, 406,407, 398, 399, 400,
      414, 410, 401, 404,411,405, 397, 399, 400,
      415,402,403,412, 401,411, 408,409, 397, 398, 400' => 'FantanOne',

      '435,553,421,431,426,425,427,
       432,552,431,350,428,429,430,
       433,553,350,417,424,422,423,
       434,552,417,421,418,419,420' => 'fantanTwo',

      '351,436,437,438,439,440,441,443,444,
        445,446,447,448,449' => 'fantanPosition'


    ];
  }
}
