<?php

define('PAGINATE', 10);

//model id
define('USER_MODULE', 1);
define('CLIENTS_MODULE', 2);
define('CATEGORY_MODULE', 3);
define('PRODUCT_MODULE', 4);
define('ORDER_MODULE', 5);
define('ESTIMATES_MODULE', 6);
define('PERMISSIONS_MODULE', 7);

if (!function_exists('imageUrl')) {
    function imageUrl($img, $path, $default = 'default.png', $size = 'thumbnail')
    {
        $path = trim($path, '/');
        if (!empty($path)) {
            $path .= '/';
        }
        if ($size) {
            $path .= $size . '/';
        }
        if ($img) {
            return asset('uploads/' . $path . $img);
        }
        return asset('assets/img/' . $default);
    }
}

if (!function_exists('invoiceNumber')) {
    function invoiceNumber($type)
    {
        $latest = App\Models\Order::where('type',$type)->latest()->first();

        if (! $latest) {
            return 'BD/H-0001';
        }

        $string = preg_replace("/[^0-9\.]/", '', $latest->invoice_no);

        return 'BD/H-' . sprintf('%04d', $string+1);
    }
}

if (!function_exists('numberToWord')) {
    /**
     * Write code on Method
     *
     * @return response()
     */
    function numberToWord($num = '')
    {
        $num    = ( string ) ( ( int ) $num );
        
        if( ( int ) ( $num ) && ctype_digit( $num ) )
        {
            $words  = array( );
             
            $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );
             
            $list1  = array('','one','two','three','four','five','six','seven',
                'eight','nine','ten','eleven','twelve','thirteen','fourteen',
                'fifteen','sixteen','seventeen','eighteen','nineteen');
             
            $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
                'seventy','eighty','ninety','hundred');
             
            $list3  = array('','thousand','million','billion','trillion',
                'quadrillion','quintillion','sextillion','septillion',
                'octillion','nonillion','decillion','undecillion',
                'duodecillion','tredecillion','quattuordecillion',
                'quindecillion','sexdecillion','septendecillion',
                'octodecillion','novemdecillion','vigintillion');
             
            $num_length = strlen( $num );
            $levels = ( int ) ( ( $num_length + 2 ) / 3 );
            $max_length = $levels * 3;
            $num    = substr( '00'.$num , -$max_length );
            $num_levels = str_split( $num , 3 );
             
            foreach( $num_levels as $num_part )
            {
                $levels--;
                $hundreds   = ( int ) ( $num_part / 100 );
                $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
                $tens       = ( int ) ( $num_part % 100 );
                $singles    = '';
                 
                if( $tens < 20 ) { $tens = ( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas = count( $words ); if( $commas > 1 )
            {
                $commas = $commas - 1;
            }
             
            $words  = implode( ', ' , $words );
             
            $words  = trim( str_replace( ' ,' , ',' , ucwords( $words ) )  , ', ' );
            if( $commas )
            {
                $words  = str_replace( ',' , ' and' , $words );
            }
             
            return $words.' Only.';
        }
        else if( ! ( ( int ) $num ) )
        {
            return 'Zero';
        }
        return '';
    }
}

if (!function_exists('my_array_search')) {
    function my_array_search($array, $key, $value) {

        $results = array();
        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results = $array;
            }
            
            foreach ($array as $i => $subarray) {
                if(my_array_search($subarray, $key, $value,$i) !== null){
                    $results = array_merge($results, my_array_search($subarray, $key, $value));
                }
            }
        }

        return $results;
    }
}

if(!function_exists('checkOrNo')){
    function checkOrNo($value,$type){
        return (isset($value) && isset($value[$type]) && $value[$type]) ? 'checked=""' : '';
    }
}