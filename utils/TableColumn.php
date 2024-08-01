<?php 

class TableColumn {
    public static function getColumns($table) {
        return match($table) {
            'transaction' => [
                'uid','partner_uid','expenditure_amount','transaction_type','description','date_created','dateTime',
                'ip_address','status','balance','balance_before','game_type','order_type', 'remarks', 'order_id'],

            'drawTable' => ['draw_number','date_created','raw_date','time_added','draw_status', 'period','lottery_type',
                'opening_time','closing_time','draw_count'],

            'drawStorage' => ['draw_count','draw_date','draw_number','draw_time','draw_datetime'],

            'rebate' => ['agent_id','user_id','amount','betcode','lottery_id','date_created','time_created'],

             'fields' => ["allSelections", "userSelections", "multiplier", "gameId", "totalBetAmt", "betId", "lottery_id", "game_label", "bet_time", "bet_date"],

            default => ['game_type','game_group','game_name','game_label','game_model','game_id','user_selection','selection_group',
                'uid','balance_before','balance_after','bet_amount','win_bonus','bet_odds','unit_stake','bet_number','bet_status',
                'bet_code','bet_date','bet_time', 'bet_period','state','bettype','multiplier','num_wins','rebate','selfrebate','draw_period',
                'ip_address']
        };
    }
}