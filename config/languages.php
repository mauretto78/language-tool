<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Language settings
     |--------------------------------------------------------------------------
     |
     | Here are specified the supported languages (as their unicode).
     | Every language must contain two keys:
     | - "name" as string
     | - "steps" as array
     |
     */

    "languages" => [
        "ja-JP" => [
            "name" => "Japanese",
            "steps" => [
                "RemoveSpaces",
                "AddSpaces",
            ],
        ],
        "zh-TW" => [
            "name" => "TraditionalChinese",
            "steps" => [
                "RemoveSpaces",
                "AddSpaces",
            ],
        ],
    ],
];