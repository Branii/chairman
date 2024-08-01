
<?php

class GamePlayFunctionHappy8
{

  public static function getGamePlayFunction(): array
  {  // Game Ids and their respective checker function
    return  [

      #---------------Happy8 Standard--------------=>

      '462' => 'PickOne',
      '463' => 'PickTwo',
      '464' => 'PickThree',
      '465' => 'PickFour',
      '466' => 'PickFive',
      '467' => 'PickSix',
      '468' => 'PickSeven',
      '471' => 'FunOverUnder',
      '472' => 'FunOddEven',
      '473' => 'FunSum',

      #---------------Happy8 2Sides----------------=>

      '192' => 'Sum',
      '193' => 'SumPass',
      '194' => 'MoreFirstLast',
      '195' => 'MoreEvenOdd',
      '196' => 'GoldAndOthers1',
      '197' => 'Ballnumbers',

      #---------------board Games ----------------=>
      '373,374,375' => 'BigAndSmall',
      '376,377,378' => 'SuperoirMiddelLower',
      '379,380,381' => 'OddTieEven',
      '382,383,384,385,386,387' => 'BOSOBESE',
      '388,389,390,391,392' => 'GoldAndOthers',

      #---------------Happy8 Road Bet ------------=> 
      '1232, 1233, 1234, 1235' => 'SumBigSmallOddEven',

      #---------------Happy8 Long dragon ------------=> 
      '87, 88, 89, 90' => 'SumBigSmallOddEven',

      #---------------Happy8 fantan---------------=> 
      '450,451,452,453' => 'Happy8BSOE',

      '454,455,456,457' => 'happy8color',

      '458,459,460,461,469' => 'happy8fiveElement',

      '510,511,512,513,514,515,516,517,
       518,519,520,521,522,523,524,525,
       526,527,528,529' => 'Happy8fantanOne',

      '549, 551, 537, 543, 540, 539, 541,
       546, 550, 530, 544, 545, 543, 534,
       547, 551, 534, 532, 533, 531, 542,
       548, 550, 538, 537, 535, 536, 475' => 'Happy8fantan2'

    ];
  }
}
