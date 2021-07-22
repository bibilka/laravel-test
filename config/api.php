<?php

return [

    /**
     * Ключи для хранения кешированных значений.
     */
    'cache_keys' => [

        // статистика пользователя
        'user_stats' => 'api:users:{id}',

        // общая статистика
        'total_stats' => 'api-total-requests'
    ]
];