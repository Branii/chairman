<?php 

enum Response : string {

    case SUCCESS = 'success';
    case ERROR = 'error';
    case WARNING = 'warning';
    case INFO = 'info';
    case DEBUG = 'debug';
    case CRITICAL = 'critical';
    case ALERT = 'alert';
    case EMERGENCY = 'emergency';
    case UNKNOWN = 'unknown';
    //---------------------------//
    case MISSING_REQUIRED_FIELDS = 'Missing required fields';
    case NOT_LOGGED_IN = 'User not logged in';
    case INSUFFICENT_FUNDS = 'Insufficient funds';
    case BET_TIME_EXPIRED = 'Bet time expired';
    case BET_NOT_PLACED = 'Bet could not be placed';
    case BET_ALREADY_PLACED = 'Bet placed successfully';
    case BET_NOT_FOUND = 'Bet not found';
    case INCORRECT_PASSWORD = 'Incorrect password';
    case NOT_ENOUGH_FUNDS = 'Not enough funds';
    case ALREADY_ACCEPTED = 'Already accepted';
    case ALREADY_REJECTED = 'Already rejected';
    case ALREADY_PLAYED = 'Already played';
    case TOO_MANY_PLAYERS = 'Too many players';
    case NOT_PLAYABLE = 'Not playable';
    case INVALID_ACTION = 'Invalid action';
    case ALREADY_SUBMITTED = 'Already submitted';
    case WRONG_FORMAT = 'Wrong format';
    case NO_RESULTS = 'No results found';
    case TOO_MANY_REQUESTS = 'Too many requests';
    case MAX_BET_LIMIT_REACHED = 'Maximum bet limit reached';
    case TOO_MANY_BETS_IN_PROGRESS = 'Too many bets in progress';
    case USER_ALREADY_EXISTS = 'User already exists';
    case USER_NOT_FOUND = 'User not found';
    case ALREADY_SUBSCRIBED = 'Already subscribed';
    case NOT_SUBSCRIBED = 'Not subscribed';
    case MAX_SUBSCRIPTIONS_REACHED = 'Maximum subscriptions reached';
    case NO_SUBSCRIPTIONS = 'No subscriptions found';
    case MAX_EMAIL_SUBSCRIPTIONS_REACHED = 'Maximum email subscriptions reached';
    case MAX_SMS_SUBSCRIPTIONS_REACHED = 'Maximum SMS subscriptions reached';
    case ALREADY_EXISTS_IN_LIST = 'Already exists in the list';
    case NOT_EXISTS_IN_LIST = 'Not exists in the list';
    case TOO_MANY_REQUESTS_IN_PROGRESS = 'Too many requests in progress';
    case MAX_REQUESTS_REACHED = 'Maximum requests reached';
    case UNAUTHORIZED = 'Access denied. Unauthorized';
    case RESOURCE_NOT_FOUND = 'Resource not found';
    //-----------------------------//
 
}


?>