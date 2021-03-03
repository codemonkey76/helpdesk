<?php

return [
    'server'          => env('FUSION_SERVER'),
    'ctc_url'         => env('FUSION_CTC_URL', '/app/click_to_call/click_to_call.php'),
    'username'        => env('FUSION_USERNAME'),
    'password'        => env('FUSION_PASSWORD'),
    'src_cid_name'    => env('FUSION_SRC_CID_NAME'),
    'src_cid_number'  => env('FUSION_SRC_CID_NUMBER'),
    'dest_cid_name'   => env('FUSION_DEST_CID_NAME'),
    'dest_cid_number' => env('FUSION_DEST_CID_NUMBER'),
    'src' => env('FUSION_SRC'),
    'dest' => env('FUSION_DEST'),
    'rec' => env('FUSION_REC', false),
    'ringback'=> env('FUSION_RINGBACK', 'us-ring')
];
