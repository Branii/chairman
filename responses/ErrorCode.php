<?php 

enum ErrorCode : int {

    case NOT_FOUND = 404;
    case INTERNAL_SERVER_ERROR = 500;
    case UNAUTHORIZED = 401;
    case FORBIDDEN = 493;
    case BAD_REQUEST = 400;
    case TOO_MANY_REQUESTS = 429;
    case UNSUPPORTED_MEDIA_TYPE = 415;
    case PAYLOAD_TOO_LARGE = 413;
    case METHOD_NOT_ALLOWED = 405;
    case REQUEST_TIMEOUT = 408;
    case SERVICE_UNAVAILABLE = 503;
    case BAD_GATEWAY = 502;
    case GATEWAY_TIMEOUT = 504;
    case NOT_IMPLEMENTED = 501;

}