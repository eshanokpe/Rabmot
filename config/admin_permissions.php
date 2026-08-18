<?php

return [
    'areas' => [
        'orders'      => ['manage' => ['super_admin', 'operations_admin'], 'view' => ['support_admin']],
        'agents'      => ['manage' => ['super_admin', 'operations_admin'], 'view' => ['support_admin']],
        'commissions' => ['manage' => ['super_admin', 'finance_admin'],    'view' => ['support_admin']],
        'withdrawals' => ['manage' => ['super_admin', 'finance_admin'],    'view' => ['support_admin']],
        'messaging'   => ['manage' => ['super_admin', 'support_admin'],    'view' => []],
        'pricing'     => ['manage' => ['super_admin'], 'view' => ['support_admin']],
        'vehicles'    => ['manage' => ['super_admin'], 'view' => ['support_admin']],
        'users'       => ['manage' => ['super_admin'], 'view' => ['support_admin']],
        'promocode'   => ['manage' => ['super_admin'], 'view' => ['support_admin']],
        'faq'         => ['manage' => ['super_admin'], 'view' => ['support_admin']],
        'settings'    => ['manage' => ['super_admin'], 'view' => ['support_admin']],
        'reports'     => ['manage' => ['super_admin', 'finance_admin', 'operations_admin'], 'view' => ['support_admin']],
    ],
];
