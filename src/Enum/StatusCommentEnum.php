<?php 

declare(strict_types= 1);

namespace App\Enum;

enum StatusCommentEnum : string{

    case POSTED = 'posted';
    case DELETED = 'deleted';
    case PENDING = 'pending';

}