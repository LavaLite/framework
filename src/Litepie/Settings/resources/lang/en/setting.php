<?php

return [

    /*
     * Singlular and plural name of the module
     */
    'name'        => 'Setting',
    'names'       => 'Settings',
    'title'       => [
        'user'  => 'My Settings',
        'admin' => 'Settings',
        'sub'   => [
            'user'  => 'Settings created by me',
            'admin' => 'Settings',
        ],
    ],

    /*
     * Options for select/radio/check.
     */
    'options'     => [
        'dateformat' => [
            'd-m-Y' => 'd-m-Y',
            'd/m/Y' => 'd/m/Y',
            'm-d-Y' => 'm-d-Y',
            'm.d.Y' => 'm.d.Y',
            'm/d/Y' => 'm/d/Y',
            'Y-m-d' => 'Y-m-d',
            'd.m.Y' => 'd.m.Y',
        ],
        'timeformat' => [
            'HH:mm'   => '24 Hr',
            'hh:mm A' => '12 Hr',
        ],
        'theme'      => [
            'blue'   => 'Blue',
            'black'  => 'Black',
            'purple' => 'Purple',
            'green'  => 'Green',
            'red'    => 'Red',
            'yellow' => 'Yellow',
        ],
        'currency'   => [
            'currency' => [
                'ARS' => 'Argentine Peso',
                'AUD' => 'Australian Dollar',
                'BRL' => 'Brazilian Real',
                'CAD' => 'Canadian Dollar',
                'CHF' => 'Swiss Frank',
                'DKK' => 'Danish Krone',
                'EUR' => 'Euro',
                'GBP' => 'British Pound',
                'HKD' => 'Hong Kong Dollar',
                'INR' => 'Indian Rupee',
                'JPY' => 'Japanese Yen',
                'MXN' => 'Mexican Peso',
                'NOK' => 'Norwegian Krone',
                'NZD' => 'New Zealand Dollar',
                'RUB' => 'Russian Rubble',
                'SEK' => 'Swedish Krona',
                'SGD' => 'Singapore Dollar',
                'TRY' => 'Turkish Lira',
                'USD' => 'US Dollar',
            ],
            'position' => [
                'left'  => 'Left',
                'right' => 'Right',
            ],
        ],
    ],

    /*
     * Placeholder for inputs
     */
    'placeholder' => [
        'name'       => 'name',
        'google'     => [
            'analytics' => 'Please enter google analytics code',
            'recaptcha' => 'Please enter google recaptcha code',
        ],
        'theme'      => 'Please select theme',
        'dateformat' => 'Please select date format',
        'timeformat' => 'Please select time format',
        'timezone'   => 'Please select timezone',
        'company'    => [
            'name'     => 'Please enter company name',
            'email'    => 'Please enter company email',
            'phone'    => 'Please enter company phone',
            'logo'     => 'Please enter company logo',
            'logo_big' => 'Please enter company logo(big)',
            'address'  => 'Please enter company address',
        ],
        'currency'   => [
            'currency'          => 'Please select currency',
            'position'          => 'Please select currency position',
            'thousandseperator' => 'Please enter thousand seperator',
            'decimalseperator'  => 'Please enter decimal seperator',
            'decimal'           => 'Please enter decimeal places',
        ],
    ],

    'help'        => [
        'name'       => 'Enter the name of the website or application.',
        'google'     => [
            'analytics' => 'Enter google analytics code',
            'recaptcha' => 'Enter google analytics code',
        ],
        'theme'      => 'Pick the theme for the admin panel',
        'dateformat' => 'Select the date format to be displayed',
        'timeformat' => 'Select the time format to be displayed',
        'timezone'   => 'Select the timezone',
    ],

    /*
     * Labels for inputs.
     */
    'label'       => [
        'name'       => 'Name',
        'google'     => [
            'analytics' => 'Google analytics code',
            'recaptcha' => 'Google recaptcha code',
        ],
        'dateformat' => 'Date format',
        'timeformat' => 'Time format',
        'timezone'   => 'Timezone',
        'company'    => [
            'name'     => 'Company name',
            'email'    => 'Company email',
            'phone'    => 'Company phone',
            'logo'     => 'Company logo',
            'logo_big' => 'Company logo(big)',
            'address'  => 'Company address',
        ],
        'currency'   => [
            'heading'           => 'Currency',
            'currency'          => 'Currency',
            'position'          => 'Currency position',
            'thousandseperator' => 'Thousand seperator',
            'decimalseperator'  => 'Decimal seperator',
            'decimal'           => 'Decimeal places',
        ],
        'theme'      => [
            'name'   => 'Theme',
            'admin'  => [
                'name'  => 'Admin',
                'color' => 'Color',
                'logo'  => [
                    'logo'  => 'Logo',
                    'big'   => 'Big logo',
                    'white' => 'White logo',
                ],
            ],
            'user'   => [
                'name'  => 'User',
                'color' => 'Color',
                'logo'  => [
                    'logo'  => 'Logo',
                    'big'   => 'Big logo',
                    'white' => 'White logo',
                ],
            ],
            'public' => [
                'name'  => 'Public',
                'color' => 'Color',
                'logo'  => [
                    'logo'  => 'Logo',
                    'big'   => 'Big logo',
                    'white' => 'White logo',
                ],
            ],
        ],
    ],

    /*
     * Tab labels
     */
    'tab'         => [
        'name' => 'Name',
    ],

    /*
     * Texts  for the module
     */
    'text'        => [
        'preview' => 'Click on the below list for preview',
    ],
];
