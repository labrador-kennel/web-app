<?php declare(strict_types=1);

namespace App\Http\Exception;

use App\Exception\Exception;

final class SessionNotSetOnRequest extends Exception {

    public static function fromRequestDoesNotHaveAppropriateSessionAttribute(string $sessionKey) : self {
        return new self(sprintf(
            'The %s Request attribute has not been set. Please set this value to an appropriate Session instance.',
            $sessionKey
        ));
    }

}