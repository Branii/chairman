
<?php

class GamePlayFunctionThreeD
{

    public static function getGamePlayFunction(): array
    {  // Game Ids and their respective checker function
        return  [

            #---------------ThreeD Standard----------------

             '329' =>'all3_straight_joint',
             '330' => 'all3_straight_manual',
             '331' =>'all3__sum',
             '332' =>'all3_span',
             '333' => 'all3_group3',
             '334' =>'all3_group6',
             '335' =>'all3_combo_manual',
             '336' => 'all3_sum_group',
             '337' =>'fixed_digit',

            #---------------first 2----------------

             '338' => 'first2_straight_joint',
             '339' => 'first2_straight_manual',
             '340' => 'first2_sum',
             '341' => 'first2_span',
             '342' => 'first2_group_joint',
             '343' => 'first2_group_manual',
             '344' => 'first2_sum_group',
             '345' => 'first2_fixed_digit',

             #---------------last 2----------------

             '346' =>'last2_straight_joint',
             '347' => 'last2_straight_manual',
             '348' =>'last2_sum',
             '349' =>'last2_span',
             '350' => 'last2_group_joint',
             '351' =>'last2_group_manual',
             '352' =>'last2_sum_group',
             '353' => 'last2_fixed_digit',

            #---------------fixed place----------------

             '354' =>'fixed_place',

            #---------------Any place----------------

             '355' =>'any_place1x3',
             '356' =>'any_place2x3',

            #--------------- Dragon | Tiger ----------------

             '357' => 'DragonTiger',

            // ********************Twosides *******

            '130,131,132' => 'conv',

            '135,136,137,138' => 'twoside',

            '139,140,141' => 'combo',

            '142,145,147' => 'fixed_place_two_side',

            '152,153,154,155' => 'sum',

            '157,159' => 'group',

            '160' => 'span',




            #---------------5D Long Dragon----------------=> 
            
            '1149,1152,1155,1150,1153,1156,1151,1154,1157' => 'RoadBetBSOEPC',
            '1159,1164,1167,1160,1165,1168,1161,1166,1236,1162,1163,1169' => 'RoadBet1st2nd3rd'


            // *******************5D MAny  Table **************

           


            // ****************Roadbet Games *******************

            

            #---------------Board Games -----------------
            
            #----------------stud Games ----------------
            
            #---------------bacarat games --------------
           

            #---------------Fantan Games ---------------
          
        ];
    }
}
