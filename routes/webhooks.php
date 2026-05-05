<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use ShamimStack\ServerTheme\Facades\ServerTheme;

Route::prefix(config('servertheme.feedback_route_prefix', 'api/servertheme/webhook'))
    ->group(function () {
        Route::post('/feedback', function (\Illuminate\Http\Request $request) {
            $payload = $request->all();
            return response()->json(ServerTheme::handleFeedback($payload));
        });
    });
