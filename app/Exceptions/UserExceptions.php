<?php


namespace App\Exceptions;


use Illuminate\Http\Response;

final class UserExceptions
{

    public const NOT_FOUND = 'userNotFound';

    public static function notFound(string $message = null): BuildExceptions
    {
        return new BuildExceptions([
            'shortMessage' => $message ?? self::NOT_FOUND,
            'message' => trans('user_exceptions.' . self::NOT_FOUND),
            'httpCode' => Response::HTTP_NOT_FOUND
        ]);
    }

}
