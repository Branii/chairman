<?php

 class GamePlayFunctionM6 {
    public static function getGamePlayFunction() : Array {  // Game Ids and their respective checker function
      return  [

        #---------------Mark6 Standard----------------

           '379' => 'ExtraNo',
           '380' => 'ExtraHeadTail',
           '382' => 'ComboZodiac',
           '383' => 'SpecialZodiac',
           '384' => 'FiveElement',
           '385' => 'FormExtraNo',
           '386' => 'SumExtraHeadTail',
           '387' => 'FormExtraTail',
           '388' => 'FormExtraZodiac',
           '389' => 'ColorBall',
           '392' => 'TwoColorBalls', 
           '395' => 'PickBallnumber', 
           '396' => 'FixedPlaceOne',
           '397' => 'FixedPlaceTwo',
           '398' => 'FixedPlaceThree',
           '399' => 'FixedPlaceFourth',
           '400' => 'FixedPlaceFive',
           '401' => 'FixedPlaceSix',
           '402' => 'winTwoORThree',
           '403' => 'WinThree',
           '404' => 'WinTwo',
           '407' => 'BraveryThree',
           '408' => 'BraveryTow',
           '409' => 'WinFour',
           '412' => 'OneZodaic',
           '416' => 'BallColor',
           '421' => 'Sum',
           '422' => 'TailNumber',
           '424' => 'Mismatch',
           '425' => 'TwoConsecTail',
           '426' => 'ThreeConsecTail',
           '427' => 'FourConsecTail',
           '428' => 'FiveConsecTail',
           '429' => 'TwoNumber',
           '430' => 'WinExtraNo',
           '431' => 'OneBallZodaic',
           '432' => 'TwoZodaic',
           '433' => 'ThreeZodaic',
           '434' => 'FourZodaic',
           '435' => 'FiveZodaic',
           '436' => 'SumZodaic',
           '437' => 'OddEvenZodaic',
           '438' => 'ColorBalls',
        

        #---------------mark6 2Sides----------------=> waiting for 2side game ids
        '214,169,170'=> 'RapidoBallNo',
        '171'=>'ExtraNo2sides',
        '205'=>'ExtraNoo',
        '206'=>'ExtraNoAllColor',
        '207' => 'ExtraNoAll2ColoredBalls',
        '208' => 'ExtraNoAll4ColoredBalls',
        '209'=>'ExtraSpecialZodaicColor',
        '210'=>'ExtraSpecialZodaicHeadTail',
        '211'=>'ExtraComboZodiac',
        '212'=>'ExtraFiveElement',
        '172'=>'TwoSidesPickOneBallNUmber',
        '215'=>'TwoSideOneZodiacColors',
        '216'=>'TwoSidesOneZodiacColorBalls',
        '173'=>'TwoSidesFixedPlaceOne',
        '174'=>'TwoSideTwoConsecZodaic',
        '217'=>'TwoSideThreeConsecZodaic',
        '218'=>'TwoSideFourConsecZodaic',
        '219'=>'TwoSideFiveConsecZodaic',
        '220'=>'TwoConsecTailNo',
        '221'=>'TwoSideThreeConsecTailNo',
        '222' =>'TwoSideFourConsecTailNo',
        '223'=>'TwoSideFiveConsecTailNo',
        '175'=>'TwoSideWinTwoORThree',
        '225'=>'TwoSideWinThree',
        '226'=>'TwoSideWinTwo',
        '227'=>'TwosideTwoNumber',
        '228'=>'TwoSideWinExtraNo',
        '229'=>'TwoSideWinFour',
        '176'=>'ZodiacTailZodiac',
        '177'=>'ZodaicZodiacNo',
        '178'=>'TwoSideZodaicTails',
        '179'=>'TwoSidesSum',
        '232'=>'Optional',
        '180'=>'TwoSidesMismatch',

        #---------------Board Games----------------=>  game ids
            '317,318,319,320' => 'ExtraNumbers',
            '321,322,323'=> 'ColorWaves',
            '324,325,326,327,328,329,330,331,332,333,334,335,336,337,338,339,340,
             341,342,343,344,345,346,347,348,349,350,351,352,353,354,355,356,357,
             358,359,360,361,362,363,364,365,366,367,368,369,370,371,372,1172'=> 'GuessNumber',
            '1173,1174,1175,1176,1178,1179'=> 'ElementSeven',

    #---------------Roadbet----------------=> waiting for 2side game ids
       //extraNo.
            '1183' => 'BigSmall',
            '1191' => 'OddEven',
            '1200' => 'BigSmallSum',
            '1208' => 'OddEvenSum',
            '1216' => 'SkyGround',
            '1218' => 'FirstLast',
            '1220'=>'PoultryBeast',
            '1222'=>'TailBigSmall',

            //ball 1
            '1184'=>'BallOneBigSmall',
            '1192'=>'BallOneOddEven',
            '1201'=>'BallOneBigSmallSum',
            '1209'=>'BallOneOddEvenSum',
            '1223'=>'BallOneTailBigSmall',

            //ball 2
            '1185'=>'BallTwoBigSmall',
            '1193'=>'BallTwoOddEven',
            '1202'=>'BallTwoBigSmallSum',
            '1210'=>'BallTwoOddEvenSum',
            '1224'=>'BallTwoTailBigSmall',

            //ball 3
            '1186'=>'BallThreeBigSmall',
            '1194'=>'BallThreeOddEven',
            '1203'=>'BallThreeBigSmallSum',
            '1211'=>'BallThreeOddEvenSum',
            '1226'=>'BallThreeTailBigSmall',

            //ball 4
            '1187'=>'BallFourBigSmall',
            '1195'=>'BallFourOddEven',
            '1204'=>'BallFourBigSmallSum',
            '1212'=>'BallFourOddEvenSum',
            '1227'=>'BallFourTailBigSmall',

            //ball 5
            '1188'=>'BallFiveBigSmall',
            '1196'=>'BallFiveOddEven',
            '1205'=>'BallFiveBigSmallSum',
            '1213'=>'BallFiveOddEvenSum',
            '1228'=>'BallFiveTailBigSmall',

            //ball 6
            '1189'=>'BallSixBigSmall',
            '1197'=>'BallSixOddEven',
            '1206'=>'BallSixBigSmallSum',
            '1214'=>'BallSixOddEvenSum',
            '1229'=>'BallSixTailBigSmall',
            //sum
            '1190'=>'SumBigSmall',
            '1198'=>'SumOddEven',
            '1231'=>'SumBigSmallNoTie',
            //Zodiac
            '1199'=>'OddEvenZodaics',

          #---------------Long dragon----------------=> 
              //extraNo.
            '91' => 'BigSmall',
            '92' => 'OddEven',
            '93' => 'BigSmallSum',
            '94' => 'OddEvenSum',
            '95' => 'SkyGround',
            '96' => 'FirstLast',
            '97'=>'PoultryBeast',
            '98'=>'TailBigSmall',

            
            //ball 1
            '99'=>'BallOneBigSmall',
            '105'=>'BallOneOddEven',
            '111'=>'BallOneBigSmallSum',
            '117'=>'BallOneOddEvenSum',
            '123'=>'BallOneTailBigSmall',

             //ball 2
             '100'=>'BallTwoBigSmall',
             '106'=>'BallTwoOddEven',
             '112'=>'BallTwoBigSmallSum',
             '118'=>'BallTwoOddEvenSum',
             '124'=>'BallTwoTailBigSmall',

             
            //ball 3
            '101'=>'BallThreeBigSmall',
            '107'=>'BallThreeOddEven',
            '113'=>'BallThreeBigSmallSum',
            '119'=>'BallThreeOddEvenSum',
            '125'=>'BallThreeTailBigSmall',

            //ball 4
            '102'=>'BallFourBigSmall',
            '108'=>'BallFourOddEven',
            '114'=>'BallFourBigSmallSum',
            '120'=>'BallFourOddEvenSum',
            '126'=>'BallFourTailBigSmall',

            //ball 5
            '103'=>'BallFiveBigSmall',
            '109'=>'BallFiveOddEven',
            '115'=>'BallFiveBigSmallSum',
            '121'=>'BallFiveOddEvenSum',
            '127'=>'BallFiveTailBigSmall',

            //ball 6
            '104'=>'BallSixBigSmall',
            '110'=>'BallSixOddEven',
            '116'=>'BallSixBigSmallSum',
            '122'=>'BallSixOddEvenSum',
            '128'=>'BallSixTailBigSmall',
            //sum
            '129'=>'SumBigSmall',
            '131'=>'SumOddEven',
            '130'=>'SumBigSmallNoTie',
            //Zodiac
            '132'=>'OddEvenZodaics',
 


           #---------------mark6 fantan----------------=> 
         '554,555,556,557,561,558,559,560,564,679,562,563'=>'FantanMain',
         '565,566,567,568' =>'fantanBsoe',
         '569,570,571,572,573,574,575,576,577,578,579,580,581,582,
          583,584,585,586,587,588,589,590,591,592,593,594,595,596,
          597,598,599,600,601,602,603,604,605,606,607,608,609,610,
          611,612,613,614,615,616,617' =>'fantanSpecialcode'


    
      ]; 
    }
 }