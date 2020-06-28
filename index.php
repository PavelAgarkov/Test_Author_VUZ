<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use src\ArrayPrinter;

$items = [
    'Category_1' => [
        'Subcategory_11' => [
            'SubSubCat_111' => [
                'Sub_1111' => [
                    'Subcategory_5' => [
                        'SubSubCat_6' => [
                            'Sub_7' => [
                                'Item56'
                            ],
                            'Item7',
                            'Item8'
                        ]
                    ]
                ],
                'Item2',
                'Item2'
            ]
        ]
    ],

    'Category_2' => [
        'Item3'
    ],

    'Item4',

    'Category_22' => [
        'Subcategory_11' => [
            'SubSubCat_111' => [
                'Sub_1111' => [
                    'Subcategory_5' => [
                        'SubSubCat_6' => [
                            'Sub_7' => [
                                'Item56'
                            ],
                            'Item7',
                            'Item8'
                        ]
                    ]
                ],
                'Item2',
                'Item2'
            ]
        ]
    ],
];


echo (new ArrayPrinter($items))->recursionRound()->render();




