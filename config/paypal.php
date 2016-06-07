<?php
return array(
    // set your paypal credential
    'client_id' => 'Ae2b0NwHa-X5lKumUm5pqD5agyTQ_mD5-rZr4Yyaavyy85caj4aD3qFhKXI6Hbw8Jmnvoiy6n28cUJfz',
    'secret' => 'ENBHvZ_eJDbA1S1nkPAK7cq2vDcDUgs0P_DL0McjmtLthSD6WutxDL-__1cZtQywCpHpx1WRr1cas3KN',

        /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);



