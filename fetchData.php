<?php 
// Database connection info 
$dbDetails = array( 
    'host' => 'localhost', 
    'user' => 'root', 
    'pass' => '', 
    'db'   => 'test' 
); 
 
// DB table to use 
$table = 'members'; 
 
// Table's primary key 
$primaryKey = 'id'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'first_name', 'dt' => 0 ), 
    array( 'db' => 'last_name',  'dt' => 1 ), 
    array( 'db' => 'email',      'dt' => 2 ), 
    array( 'db' => 'gender',     'dt' => 3 ), 
    array( 'db' => 'country',    'dt' => 4 ), 
    array( 
        'db'        => 'created', 
        'dt'        => 5, 
        'formatter' => function( $d, $row ) { 
            return date( 'jS M Y', strtotime($d)); 
        } 
    ), 
    array( 
        'db'        => 'status', 
        'dt'        => 6, 
        'formatter' => function( $d, $row ) { 
            return ($d == 1)?'Active':'Inactive'; 
        } 
    ) 
); 
 
$searchFilter = array(); 
// if(!empty($_GET['search_keywords'])){ 
//     $searchFilter['search'] = array( 
//         'first_name' => $_GET['search_keywords'], 
//         'last_name' => $_GET['search_keywords'], 
//         'email' => $_GET['search_keywords'], 
//         'country' => $_GET['search_keywords'] 
//     ); 
// } 
if(!empty($_GET['filter_option'])){ 
    $searchFilter['filter'] = array( 
        'gender' => $_GET['filter_option'] 
    ); 
} 
 
// Include SQL query processing class 
require 'ssp.class.php'; 
 
// Output data as json format 
echo json_encode( 
    SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns, $searchFilter ) 
);