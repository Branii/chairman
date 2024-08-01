<?php

class GamePlayFunctionF3
{
   public static function getGamePlayFunction(): array
   {  // Game Ids and their respective checker function
      return  [

         #---------------Fast3 Standard----------------

         '390' => 'Bsoe',
         '393' => 'Sum',
         '394' => 'Toak',
         '405' => 'ThreeNoStandard',
         '406' => 'ThreeNoGroup',
         '410' => 'ThreeRow',
         '411' => 'HalfStreak',
         '413' => 'Mixed',
         '414' => 'OnePairStandardManual',
         '417' => 'OnePairStandardJoint',
         '418' => 'OnePairGroup',
         '419' => 'TwoNoGroup',
         '420' => 'TwoNoStandard',
         '423' => 'GuessANumber',

         #---------------Fast3 2Sides----------------=>

         '181' => 'GuessNumber',
         '182' => 'AnyTriple',
         '183' => 'Point',
         '184' => 'AnyTwo',
         '185' => 'OnePair',
         '186' => 'FishPrawnCrab',


         #---------------Board Games----------------=>
         '265,266,267,268' => 'SumNumbers',
         '303,304,305,306,307,308,309,310,311,312,313,314,315,316' => 'SumDice',
         '269,270,271,272,273,274' => 'TwoDice',
         '275,276,277,278,279,280' => 'ThreeDice',
         '281' => 'ComboDice',
         '282,283,284,285,286,287,288,289,290,291,292,293,294,295,296' => 'AnyTwoDice',
         '297,298,299,300,301,302' => 'FullDice',

         #---------------Fast3 Road Bet----------------=>
         '1148' => 'SumBigSmall',
         #-------------long Dragon -----------------=>
         '46' => 'LongDragon',


         #----------------fast3 fantan --------------------------->

         '618,619,620,621,622,623,624,625' => 'fast3FantanMain1',
         '626,627,628,629,630,631' => 'fast3FantanMain2',

         '660,661,662,663,664' => 'fast3FantanMisc1',
         '632,633,634,635,636,637,638,639,
          640,641,642,643,644,645,646' => 'fast3FantanMisc2',

         '665,666,667,668,669,670,671,672,673,674,675,676,677,678' => 'fast3FantanShowDeck1',
         '647,648,649,650,651,652,653,654,655,656,657,658' => 'fast3FantanShowDeck2'




      ];
   }
}
