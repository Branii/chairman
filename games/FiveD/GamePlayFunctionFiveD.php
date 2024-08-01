<?php

class GamePlayFunctionFiveD
{

    public static function getGamePlayFunction(): array
    {  // Game Ids and their respective checker function
        return [

            #---------------FiveD Standard----------------

            '1' => 'all5_straight_joint',
            '2' => 'all5_straight_manual',
            '3' => 'all5_straight_combo',
            '4' => 'all5_group_120',
            '5' => 'all5_group_60',
            '6' => 'all5_group_30',
            '7' => 'all5_group_20',
            '8' => 'all5_group_10',
            '9' => 'all5_group_5',
            '10' => 'all4_first4_straight_joint',
            '11' => 'all4_first4_straight_manual',
            '12' => 'all4_first4_straight_combo',
            '13' => 'all4_first4_group_24',
            '14' => 'all4_first4_group_12',
            '15' => 'all4_first4_group_6',
            '16' => 'all4_first4_group_4',
            '17' => 'all4_last4_straight_joint',
            '18' => 'all4_last4_straight_manual',
            '19' => 'all4_last4_straight_combo',
            '20' => 'all4_last4_group_24',
            '21' => 'all4_last4_group_12',
            '22' => 'all4_last4_group_6',
            '23' => 'all4_last4_group_4',
            '24' => 'first3_first3_straight_joint',
            '25' => 'first3_first3_straight_manual',
            '26' => 'first3_first3_straight_combo',
            '27' => 'first3_sum_of_first3',
            '28' => 'first3_span_of_first3',
            '29' => 'first3_first3_group_3',
            '30' => 'first3_first3_group_6',
            '31' => 'first3_first3_group_combo_manual',
            '32' => 'first3_first3_sum_of_group',
            '33' => 'first3_first3_group3_manual',
            '34' => 'first3_first3_group6_manual',
            '35' => 'first3_first3_fixed_digit',
            '36' => 'first3_first3_sum_tail',
            '99' => 'fixed_place',
            '37' => 'mid3_straight_joint',
            '38' => 'mid3_manual',
            '39' => 'mid3_combo',
            '40' => 'mid3_sum',
            '41' => 'mid3_span',
            '42' => 'mid3_group_3',
            '43' => 'mid3_group_6',
            '44' => 'mid3_group_combo_manual',
            '45' => 'mid3_sum_of_group',
            '46' => 'mid3_group3_manual',
            '47' => 'mid3_group6_manual',
            '48' => 'mid_fixed_digit',
            '49' => 'mid3_sum_tail',
            '50' => 'last3_straight_joint',
            '51' => 'last3_straight_manual',
            '52' => 'last3_straight_combo',
            '53' => 'last3_sum',
            '54' => 'last3_span',
            '55' => 'last3_group_3',
            '56' => 'last3_group_6',
            '57' => 'last3_group_combo_manual',
            '58' => 'last3_sum_of_group',
            '59' => 'last3_group3_manual',
            '60' => 'last3_group6_manual',
            '61' => 'last3_fixed_digit',
            '62' => 'last3_sum_tail',
            '63' => 'first2_straight_joint',
            '64' => 'first2_straight_manual',
            '65' => 'first2_sum_of_first2',
            '66' => 'first2_span_of_first2',
            '67' => 'first2_group_joint',
            '68' => 'first2_group_manual',
            '69' => 'first2_sum_of_group',
            '70' => 'first2_fixed_digit',
            '91' => 'last2_straight_joint',
            '92' => 'last2_straight_manual',
            '93' => 'last2_sum_of_last2',
            '94' => 'last2_span_of_last2',
            '95' => 'last2_group_joint',
            '96' => 'last2_group_manual',
            '97' => 'last2_sum_of_group',
            '98' => 'last2_fixed_digit',
            '100' => 'any_place_1x3_first3',
            '101' => 'any_place_2x3_first3',
            '102' => 'any_place_1x3_mid3',
            '103' => 'any_place_2x3_mid3',
            '1041' => 'any_place_1x3_last3',
            '1051' => 'any_place_2x3_last3',
            '1061' => 'any_place_1x4_first4',
            '1071' => 'any_place_2x4_first4',
            '1081' => 'any_place_3x4_first4',
            '1091' => 'any_place_1x4_last4',
            '1101' => 'any_place_2x4_last4',
            '111' => 'any_place_3x4_last4',
            '112' => 'any_place_1x5_first5',
            '113' => 'any_place_2x5_first5',
            '114' => 'any_place_3x5_first5',
            '115' => 'bsoe_first2',
            '116' => 'bsoe_first3',
            '117' => 'bsoe_last2',
            '118' => 'bsoe_last3',
            '119' => 'bsoe_sum_all5',
            '120' => 'bsoe_sum_all3',
            '121' => 'fun_one_hit',
            '122'  => 'fun_two_hit',
            '123' => 'fun_three_hit',
            '124' => 'fun_four_hit',
            '125' => 'pick2_joint',
            '126' => 'pick2_manual',
            '127' => 'pick2_sum',
            '1281' => 'pick2__group_joint',
            '1291' => 'pick2_group_manual',
            '130' => 'pick2_group_sum',
            '131'  => 'pick2_fixed_digit',
            '132' => 'pick3_joint',
            '1331' => 'pick3_manual',
            '1341' => 'pick3_sum',
            '1351' => 'pick3_group3',
            '1361' => 'pick3_group6',
            '1371' => 'pick3_group_combo_manual',
            '1381' => 'pick3_group_sum',
            '1391' => 'pick4_joint',
            '1401' => 'pick4_manual',
            '1411'  => 'pick4_group24',
            '1421' => 'pick4_group12',
            '1431' => 'pick4_group6',
            '1441' => 'pick4_group4',
            '148' => 'bull_bull',
            '146' => 'stud',
            '147'=> 'three_card',


            // ********************Twosides *******

            '104,105,106,107,108,109,110' => 'twoside_allkinds',
            '128,129' => 'twoside_rapido',

            #---------------5D Long Dragon----------------=> 
            '133,134,135,136,137,138,139,140,141,142,143,144,149,150' => 'long_dragon',

            // *******************5D MAny  Table **************

            // '151' => 'mantable_fixed_place',
            // '152' => '',

            '145' => 'DragonTiger',


            // ****************Roadbet Games *******************

            '153,158,166' => 'FirstBall',
            '154,159,167' => 'SecondBall',
            '155,160,168' => 'ThirdBall',
            '156,161,169' => 'FourthBall',
            '157,162,170' => 'FifthBall',
            '163,164,165' => 'SumAllDrawNumber',

            #---------------Board Games -----------------
            '180,181,182,183' => 'bull_bull_bsoe',
            '184,185,186,187,188,189,190,191,192,193,194' => 'bull_bull_board',
            '195,196,197,198,199' => 'board_maximum',
            '200,201,202,203,204' => 'board_minimum',
            '205,206,207' => 'board_dragonTigerTie',
            '208,209,210,211,212,213,214,240' => 'studGroup',
            '215,216,217,218,219' => 'firstThreeForms',
            '220,221,222,223,224' => 'middleThreeForms',
            '225,226,227,228,229' => 'lastThreeForms',
            '230,231,233,234' => 'firstTwoForms',

            #---------------bacarat games --------------
            '235,236,237,238,239' => 'baracat',

            #---------------Fantan Games ---------------
            '241,242,243,244,250,251,252' => 'fantan_main_bsoedtt',

            '245,246,247,248,249' => 'fantan_main_sweetroses',

            '272,  ,259 ,264, 258, 266, 264, 261, 253, 254, 255,
             269,  ,262 ,263, 268, 261, 264, 254, 255, 256,
             270,  ,262 ,257, 265, 258, 266, 253, 255, 256, 271,
             260,  ,263 ,257, 265, 259, 267, 253, 254, 256 ' => 'fantanOne',

            '288, 290, 276, 274, 283, 282, 284,
             291, 285, 289, 274, 273, 277, 278,
             286, 290, 273, 275, 348, 349, 680,
             287, 289, 275, 276, 279, 280, 281' => 'fantan2',

            '292, 293, 294, 295, 296, 297, 298' => "fantan3Color",

            '312,303,308,304,309,305,310, 311, 306, 307, 346' => "fantanWithCombo",
            '302, 301, 299, 300' => 'fantanBSOE',

            '313, 331, 314, 315, 316, 317, 318, 319,
             320, 321, 322, 323, 324, 325, 326, 327, 328,
             329, 330, 332' => 'fantanAnd',

            '333, 334, 335, 336, 337, 338, 339, 340, 341, 342, 343, 344, 345' => 'fantanPosition'
        ];
    }
}
