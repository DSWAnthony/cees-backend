<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler{
    
    public function register(){}

    protected function unauthenticated($request, AuthenticationException $exception){
        return $request->expectsJson()
            ? response()->json(['message' => 'No autenticado'], 401)
            : response()->json(['message' => 'No autenticado'], 401);
    }

    public function render($request, Throwable $exception){
        if ($request->wantsJson()) {
    
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'message' => 'Error de validación',
                    'errors' => $exception->errors(),
            ], 422);
            }

        return response()->json([
            'message' => $exception->getMessage()
        ], 500);
    }

    return parent::render($request, $exception);
}
}