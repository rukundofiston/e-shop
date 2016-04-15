<?php
header('Content-Type:text/html;charset=utf-8');
# First Step
require_once('ikra.php');

# Add database Object
$ikra = new database('root', 'abcabc', 'testbd','localhost');
// database( your_database_user , your_database_password , your_database , your_server );

# Add Modify Object
$dr = $ikra->ModifySQL('eleve', array('nom'), array('رقراق'),"");
// ModifySQL( your_table , your_table_columns , your_table_columns_new_values , your_sql_clause )

# Add Insert Object
//$dr = $ikra->InsertSQL('eleve', array('nom'), array('رقراق'));
// InsertSQL( your_table , your_table_columns , your_table_columns_insert_values )

# Add Delete Object
$dr = $ikra->DeleteSQL('eleve', "WHERE id = '62'");
// DeleteSQL( your_table , your_sql_clause )

# Add Table List Object
$table1 = $ikra->Table('eleve');
foreach ($table1 as $row) {
        echo $row["nom"].'<br>';
}
// Table( only_your_table_name )
/*
# Add Query List Object
$query1 = $ikra->Query("SELECT * FROM eleve");
foreach ($query1 as $row) {
        echo $row["nom"].'<br>';
}
//single row example
//echo $query1[0]["nom"];
// Query( only_your_sql_clause )

# Add Table Object
//$table1 = $ikra->Table('eleve'); //add table object
// Table( only_your_table_name )

# Add DBGrid with Table Object
//echo $ikra->DBGrid($table1, array('nom'=>"nom eleve"), 3, 0); //customize dbgrid columns
// DBGrid( your_table_object, table_columns, row_count , active_page_index )

# Add DBGrid with Table Object
//echo $ikra->DBGrid($table1, array(), 20, 0); //all columns
// DBGrid( your_table_object, array(), row_count , active_page_index )

# Add record count text with Table Object
//echo $ikra->RecordCount($table1); //show $table1 RecordCount
// RecordCount( only_your_table_name )

# Close database Object
$ikra->Destroy();
