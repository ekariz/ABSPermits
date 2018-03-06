<?php

$tables = array();

$tables[] = 'HMCMP';
$tables[] = 'HMBRC';
$tables[] = 'HMBU';
$tables[] = 'HMDPT';
$tables[] = 'HMSCT';
$tables[] = 'HMWPT';
$tables[] = 'HPDSG';
$tables[] = 'HPGRD';
$tables[] = 'HMSTS';
$tables[] = 'HMEMT';
$tables[] = 'HMSGP';
$tables[] = 'HMCTG';
$tables[] = 'HMJTT';
$tables[] = 'HMSTAFF';
$tables[] = 'HMDPD';
$tables[] = 'HMLVT';
$tables[] = 'HMLVD';
$tables[] = 'HMLVE';
$tables[] = 'HMLVS';
$tables[] = 'PRSBA';
$tables[] = 'PRSITM';

 if(isset($tables) && is_array($tables) && sizeof($tables)>0) {

 $xml   = "<?xml version=\"1.0\"?> \r\n";
 $xml  .= "<schema version=\"0.3\"> \r\n";
 $xml  .= "\r\n";

 foreach ($tables as $table){

  $table_prefix = substr($table,0,2);
  $columns      = $db->MetaColumns($table,$notcasesensitive=true);

  if($columns && sizeof($columns)>0) {

    $xml .= "<table name=\"{$table}_LOG\"> \r\n";
    $xml .= "<descr>{$table}</descr> \r\n";
    $xml .= "<field name=\"OPERATION\" type=\"C\" size=\"10\" ><NOTNULL/></field>\r\n";
    $xml .= "<field name=\"OPDATE\"  type=\"D\" ><DEFDATE/></field>\r\n";
    $xml .= "<field name=\"OPTIME\"  type=\"T\" ><DEFTIMESTAMP/></field>\r\n";


   foreach ($columns as $column_name=>$properties) {

             $max_length     = $properties->max_length;
             $type           = get_standard_coltype($properties->type);

             $scale          = isset($properties->scale) && !empty($properties->scale) && $properties->scale>0 ? $properties->scale : null;
             $not_null       = isset($properties->not_null)  && $properties->not_null==1 ? 'NOTNULL' : null;

             $column1 = "  <field name=\"{$column_name}_OLD\" type=\"{$type}\" ";
             $column2 = "  <field name=\"{$column_name}_NEW\" type=\"{$type}\" ";

             switch ($type){
                case 'N':
                if(!is_null($scale)){
                 $column1 .= "size=\"{$max_length}.{$scale}\"";
                 $column2 .= "size=\"{$max_length}.{$scale}\"";
                }else{
                 $column1 .= "size=\"{$max_length}\"";
                 $column2 .= "size=\"{$max_length}\"";
                }
                break;
                case 'D':
                 $column1 .= "";
                 $column2 .= "";
                 break;
                case 'T':
                 $column1 .= "";
                 $column2 .= "";
                break;
                case 'text':
                 $column1 .= "";
                 $column2 .= "";
                case 'XL':
                 $column1 .= "";
                 $column2 .= "";
                break;
                default:
                 $column1 .= "size=\"{$max_length}\"";
                 $column2 .= "size=\"{$max_length}\"";
             }

             $column1 .=  "/>\r\n";
             $column2 .=  "/>\r\n";

             $xml .=  $column1;
             $xml .=  $column2;

  }//foreach column

  $xml .= "</table> \r\n";
  $xml .=  "\r\n";

  }//if table has columns
 }//foreach table

 $xml .= "</schema> \r\n";

 /*load xml */
  $schema = new adoSchema( $db );

  $schema->SetUpgradeMethod( 'BEST' );
  $schema->continueOnError = true;
  $schema->debug = 1;

  $sql    = $schema->ParseSchemaString($xml, false);
  $result = $schema->ExecuteSchema(null, true);


 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 //get new columns
  foreach ($tables as $table) {

    $table_prefix = substr($table,0,2);

    $xml .= "<table name=\"{$table}\"> \r\n";
    $xml .= " <descr>{$table}</descr> \r\n";

  $columns = $db->MetaColumns($table,$notcasesensitive=true);

  if($columns && sizeof($columns)>0){

  $new_columns = array();
  $old_columns = array();

   foreach ($columns as $column_name=>$properties) {

             $max_length     = $properties->max_length;
             $type           = get_standard_coltype($properties->type);
             $scale          = isset($properties->scale) && !empty($properties->scale) && $properties->scale>0 ? $properties->scale : null;

             $new_columns[$column_name] = "{$column_name}_NEW";
             $old_columns[$column_name] = "{$column_name}_OLD";

   }//foreach column

  switch ($db->databaseType){
  case 'mysql':

  $insert_columns = array();
  $insert_values  = array();

  if(count($new_columns)){
   foreach ($new_columns as $oldname=>$newname){
    $insert_columns[] = $newname;
    $insert_values[]  = "new.{$oldname}";
   }
  }

  $deleted_columns = array();
  $deleted_values  = array();

  if(count($old_columns)){
   foreach ($old_columns as $plainname=>$oldname){
    $deleted_columns[] = $oldname;
    $deleted_values[]  = "old.{$plainname}";
   }
  }


  $updated_columns = array();
  $updated_values  = array();

  $table_name_small = strtolower($table);
  $table_name_small = strtolower($table);

  $trigger_sql_insert = "
  CREATE TRIGGER trg_{$table_name_small}_insert AFTER INSERT ON {$table}
  FOR EACH ROW BEGIN
  INSERT INTO {$table}_LOG
  ( OPERATION, ".implode(',',$insert_columns)."
  )VALUES( 'INSERT',".implode(',',$insert_values)." );
  END;
  ";

  $trigger_sql_delete = "
  CREATE TRIGGER trg_{$table_name_small}_delete BEFORE DELETE ON {$table}
  FOR EACH ROW BEGIN
    INSERT INTO {$table}_LOG
    ( OPERATION,".implode(',',$deleted_columns)."
    )VALUES(
    'DELETE',".implode(',',$deleted_values).");
  END;
  ";

  $trigger_sql_update = "
  CREATE TRIGGER trg_{$table_name_small}_update AFTER UPDATE ON {$table} \r\n
  FOR EACH ROW BEGIN
  INSERT INTO {$table}_LOG
  (
   OPERATION, ".implode(',',$deleted_columns).", ".implode(',',$insert_columns)."
   )VALUES(
   'UPDATE', ".implode(',',$deleted_values).",".implode(',',$insert_values)."
  );
  END;
  ";

 $db->Execute("DROP TRIGGER trg_{$table_name_small}_insert");
 $db->Execute($trigger_sql_insert);

 $db->Execute("DROP TRIGGER trg_{$table_name_small}_delete");
 $db->Execute($trigger_sql_delete);

 $db->Execute("DROP TRIGGER trg_{$table_name_small}_update");
 $db->Execute($trigger_sql_update);

 break;
 case  'mssql':
 case  'odbc_mssql':
    //do

     $declare_insert =  " ";
  $declare_insert .=  " DECLARE @OPERATION VARCHAR(10); \r\n";
  $declare_insert .=  " DECLARE @OPDATE DATETIME; \r\n";

  $declare_delete =  " ";
  $declare_delete .=  " DECLARE @OPERATION VARCHAR(10); \r\n";
  $declare_delete .=  " DECLARE @OPDATE DATETIME; \r\n";

  $declare_update =  " ";
  $declare_update .=  " DECLARE @OPERATION VARCHAR(10); \r\n";
  $declare_update .=  " DECLARE @OPDATE DATETIME; \r\n";

  foreach ($columns as $column_name=>$properties)
  {

             $max_length     = $properties->max_length;
             $type           = get_standard_coltype($properties->type);
             $scale          = isset($properties->scale) && !empty($properties->scale) && $properties->scale>0 ? $properties->scale : null;

             $declare_old  = "DECLARE @{$column_name}_OLD {$properties->type} ";
             $declare_new  = "DECLARE @{$column_name}_NEW {$properties->type} ";

             switch ($type){
                case 'N':
                if(!is_null($scale)){
                 $declare_new .= "({$max_length},{$scale})";
                 $declare_old .= "({$max_length},{$scale})";
                }else{
                  $declare_new .= "({$max_length})";
                  $declare_old .= "({$max_length})";
                }
                break;
                case 'D':
                break;
                case 'T':
                break;
                case 'I':
                  $declare_new .= "";
                  $declare_old .= "";
                break;
                case 'text':
                case 'ntext':
                case 'ntext':
                  $declare_new .= "";
                  $declare_old .= "";
                break;
                default:
                  $declare_new .= "({$max_length})";
                  $declare_old .= "({$max_length})";
             }

                $declare_new .= ";\r\n";
                $declare_old .= ";\r\n";

                $declare_insert .= $declare_new;
                $declare_delete .= $declare_old;

                $declare_update .= $declare_new;
                $declare_update .= $declare_old;

  }//foreach column

  $declare_insert .= "\r\n";
  $declare_delete .= "\r\n";
  $declare_update .= "\r\n";

  $declare_insert .= " SET  @OPERATION = 'INSERT'; \r\n";
  $declare_insert .= " SET  @OPDATE = GETDATE(); \r\n";

  $declare_delete .= " SET  @OPERATION = 'DELETE'; \r\n";
  $declare_delete .= " SET  @OPDATE = GETDATE(); \r\n";

  $declare_update .= " SET  @OPERATION = 'UPDATE'; \r\n";
  $declare_update .= " SET  @OPDATE = GETDATE(); \r\n";

  $declare_insert .= "\r\n";
  $declare_delete .= "\r\n";
  $declare_update .= "\r\n";

  $insert_columns = array();
  $insert_values  = array();

  if(count($new_columns)){
   foreach ($new_columns as $oldname=>$newname){
    $declare_insert .="SELECT @{$newname} = I.{$oldname} FROM INSERTED I;   \r\n";
    $declare_update .="SELECT @{$newname} = I.{$oldname} FROM INSERTED I;   \r\n";
    $insert_columns[] = $newname;
    $insert_values[]  = "@{$newname}";
   }
  }

  $deleted_columns = array();
  $deleted_values  = array();

  if(count($old_columns)){
   foreach ($old_columns as $plainname=>$oldname){
    $declare_delete .="SELECT @{$oldname} = D.{$plainname} FROM DELETED D;  \r\n";
    $declare_update .="SELECT @{$oldname} = D.{$plainname} FROM DELETED D;  \r\n";
    $deleted_columns[] = $oldname;
    $deleted_values[]  = "@{$oldname}";
   }
  }

  $updated_columns = array();
  $updated_values  = array();

  $table_name_small = strtolower($table);

   $trigger_sql_insert = "
    CREATE TRIGGER trg_{$table_name_small}_insert ON {$table} \r\n
    FOR INSERT
     AS

  {$declare_insert}
   INSERT INTO {$table}_LOG
   ( OPERATION,OPDATE, ".implode(',',$insert_columns)."
  )VALUES(
   @OPERATION,@OPDATE,".implode(',',$insert_values)."
  );
  ";

$trigger_sql_delete = "

 CREATE TRIGGER trg_{$table_name_small}_delete ON {$table} \r\n
  FOR DELETE
  AS
  {$declare_delete}
  INSERT INTO {$table}_LOG
  (OPERATION,OPDATE, ".implode(',',$deleted_columns)."
  )VALUES(@OPERATION,@OPDATE, ".implode(',',$deleted_values)."
  );
  ";

$trigger_sql_update = "

 CREATE TRIGGER trg_{$table_name_small}_update ON {$table} \r\n
  FOR UPDATE
  AS
 {$declare_update}
  INSERT INTO {$table}_LOG
  (OPERATION,OPDATE,
   ".implode(',',$deleted_columns).",
   ".implode(',',$insert_columns)."
  )VALUES(
   @OPERATION,@OPDATE,
   ".implode(',',$deleted_values).",
   ".implode(',',$insert_values)."
  );
  ";

 $db->Execute("DROP TRIGGER trg_{$table_name_small}_insert");
 $db->Execute($trigger_sql_insert);

 $db->Execute("DROP TRIGGER trg_{$table_name_small}_delete");
 $db->Execute($trigger_sql_delete);

 $db->Execute("DROP TRIGGER trg_{$table_name_small}_update");
 $db->Execute($trigger_sql_update);

 break;
 case 'oci8':

  $insert_columns = array();
  $insert_values  = array();

  if(count($new_columns)){
   foreach ($new_columns as $oldname=>$newname){
    $insert_columns[] = $newname;
    $insert_values[]  = ":NEW.{$oldname}";
   }
  }

  $deleted_columns = array();
  $deleted_values  = array();

  if(count($old_columns)){
   foreach ($old_columns as $plainname=>$oldname){
    $deleted_columns[] = $oldname;
    $deleted_values[]  = ":OLD.{$plainname}";
   }
  }

  $updated_columns = array();
  $updated_values  = array();

$table_name_small = strtolower($table);

$trmname  = "TRG_{$table_name_small}_DML";

$db->Execute("DROP TRIGGER {$trmname}");

 $trigger_sql_insert_update_delete ="
 CREATE OR REPLACE TRIGGER {$trmname}
 AFTER INSERT OR UPDATE OR DELETE ON {$table}

 FOR EACH ROW
  DECLARE

  BEGIN

  IF INSERTING  THEN

   INSERT INTO {$table}_LOG
  ( OPERATION, ".implode(',',$insert_columns)."
  )VALUES( 'INSERT',".implode(',',$insert_values)."
  );

  ELSIF UPDATING THEN

  INSERT INTO {$table}_LOG
  (
   OPERATION, ".implode(',',$deleted_columns).", ".implode(',',$insert_columns)."
   )VALUES(
   'UPDATE', ".implode(',',$deleted_values).",".implode(',',$insert_values)."
  );

   ELSIF DELETING THEN

    INSERT INTO {$table}_LOG
    ( OPERATION,".implode(',',$deleted_columns)."
    )VALUES(
    'DELETE',".implode(',',$deleted_values).");

  END IF;

  END;
 ";

   $db->Execute($trigger_sql_insert_update_delete);

    break;
   }
  }//if table got columns
 }//foreach table
}
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 function get_standard_coltype ($column_type){

//echo "\$column_type={$column_type} <br>";//remove

    /*
  C:  Varchar capped to 255 characters.
  X:  Larger varchar capped to 4000 characters (to be compatible with Oracle).
  XL: For Oracle returns CLOB otherwise the largest varchar size.

  C2: Multibyte varchar
  X2: Multibyte varchar (largest size)

  B:  BLOB (binary large object)

  D:  D (some databases do not support this and we return a Dtime type)
  T:  Dtime or Timestamp
  L:  Integer field suitable for storing booleans (0 or 1)
  I:  Integer (mapped to I4)
  I1: 1-byte integer
  I2: 2-byte integer
  I4: 4-byte integer
  I8: 8-byte integer
  F:  Floating point N
  N:  Numeric or decimal N
*/
    $return      = $column_type;
    $column_type = strtolower($column_type);
    switch ($column_type){
        #--------------------------------
        case 'varchar':
        case 'varchar2':
         $return = 'C';
        break;
        #--------------------------------
        case 'nvarchar':
         $return = 'X';
         break;
        #--------------------------------
        case 'int':
         $return = 'I';
        break;
        #--------------------------------
        case 'date':
        case 'datetime':
         $return = 'D';
        break;
        case 'timestamp':
         $return = 'T';
        break;
        #--------------------------------
        case 'float':
        case 'decimal':
         $return = 'I';
         break;
        #--------------------------------
        case 'nchar':
        case 'char':
         $return = 'C';
         break;
        case 'numeric':
        case 'number':
         $return = 'N';
         break;
        #--------------------------------
        case 'clob':
        case 'longtext':
         $return = 'XL';
         break;
        #--------------------------------
        case 'blob':
        case 'image':
         $return = 'B';
         break;
        #--------------------------------
    }

    //echo "\$return={$return} <br>";//remove


  return $return;
 }

?>
