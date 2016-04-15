<?php

/**
 * @author Recep UNCU
 * @copyright 2012
 * www.ikradb.com
 */

class database {
	
	private $link = NULL;
	
	function database($username, $password, $databasename, $hostname){
		$this->link = @new mysqli($hostname, $username, $password, $databasename) or die("Connection Error!");
	} #Database End.

        function Destroy(){
                $this->link->close();
        } #Destroy End.
	
        private function execute($SQL) {
		return $this->link->query($SQL, MYSQLI_USE_RESULT);
        } #ExecuteSQL End.

        function DeleteSQL($TableName, $clause){
        	
        	$SQL = "DELETE FROM {$TableName} {$clause}";
        	$this->execute($SQL);

        } #DeleteSQL End.

        function InsertSQL($TableName, $fields=array(), $DataField=array()){
        	$sets = null;

        	$columns = "(".implode(',', $fields).")";
        	$values = "('".implode("','", $DataField)."')";        	
        	$SQL = "INSERT INTO $TableName {$columns} VALUES {$values};";
			
        	$this->execute($SQL);

        } #InsertSQL End.

        function ModifySQL($TableName, $fields=array(), $DataField=array(), $clause){
        	$sets = null; $brackets = ',';

        	$DataSource = array_combine($fields, $DataField);
        	foreach ($DataSource as $field => $data) { if(end($DataSource) === $data){ $brackets = null; }
        	$sets .= "{$field} = '{$data}'{$brackets}";
        	} $SQL = "UPDATE {$TableName} SET {$sets} {$clause};";
        	
		
        	$this->execute($SQL);
        	
        } #ModifySQL End.

        function Count($TableName, $clause){
            $SQL = "Select count(*) FROM {$TableName} {$clause};";
            $count = $this->execute($SQL);
            $count = $count->fetch_assoc();
            $count = $count['count(*)'];
            return $count;
        } #ModifySQL End.

        function Query($SQL){
                $data = array();
                
                $DataSource = $this->execute($SQL);

                while ($row = $DataSource->fetch_assoc()) : $data[] = $row; endwhile; 
                $DataSource->close();
                $this->link->next_result();

                return $data;
        } #Query End.

        function Table($TableName){
                $sets = null; $data = array();
                
                $SQL = "SELECT * FROM {$TableName};";
                $DataSource = $this->execute($SQL);

                while ($row = $DataSource->fetch_assoc()) : $data[] = $row; endwhile; 
                $DataSource->close();
                $this->link->next_result();

                return $data;
        } #Table End.
        
        function Find($TableName, $fields, $clauses){
                $sets = null; $data = array();
                if(!is_array($fields)){
                        $columns = $fields;
                }else{
                        $columns = implode(',', $fields);
                }

                $SQL = "SELECT {$columns} FROM {$TableName} $clauses;";
                //echo $SQL;
                $DataSource = $this->execute($SQL);

                while ($row = $DataSource->fetch_assoc()) : $data[] = $row; endwhile; 
                $DataSource->close();
                 if($this->link->more_results())$this->link->next_result();
                $data = current($data);

                return $data;
        } #Find End.

       function Liste($TableName, $fields, $clauses){
               $sets = null; $data = array();
               if(!is_array($fields)){
                       $columns = $fields;
               }else{
                       $columns = implode(',', $fields);
               }

               $SQL = "SELECT {$columns} FROM {$TableName} $clauses;";
               $DataSource = $this->execute($SQL);

               while ($row = $DataSource->fetch_assoc()) : $data[] = $row; endwhile; 
               $DataSource->close();
                if($this->link->more_results())$this->link->next_result();
               //$data = current($data);
               return $data;
       } #Find End.

        function RecordCount($DataSource){
                return count($DataSource);
        }

        function DBGrid($DataSource, $columns = array(), $RowCount = 10, $ActivePageIndex = 0){
                $grid = null; $thead = null; $tbody = null; $RecNo = 1;
                $DataSource = array_chunk($DataSource, $RowCount, true);
                if (!$columns):
                        $grid = '<table>'; $thead = "<th scope=\"col\"> </th>";
                        foreach ($DataSource[0][0] as $title => $column) {
                                $thead .= "<th scope=\"col\"> {$title} </th>";
                        }
                        foreach ($DataSource[$ActivePageIndex] as $row) {
                                $tbody .= "<tr>"; $tbody .= "<td> {$RecNo} </td>"; $RecNo++;
                                foreach ($DataSource[0][0] as $title => $column) {
                                        $tbody .= "<td> {$row[$title]} </td>";
                                }       $tbody .= "</tr>";
                        }
                        $grid .= "<thead><tr> {$thead} </tr></thead> <tbody> {$tbody} </tbody>";
                        $grid .= '</table>';
                elseif ($columns):
                        $grid = '<table>'; $thead = "<th scope=\"col\"> </th>";
                        foreach ($columns as $title) {
                                $thead .= "<th scope=\"col\"> {$title} </th>";
                        }
                        foreach ($DataSource[$ActivePageIndex] as $row) {
                                $tbody .= "<tr>"; $tbody .= "<td> {$RecNo} </td>"; $RecNo++;
                                foreach ($columns as $column => $title) {
                                        $tbody .= "<td> {$row[$column]} </td>";
                                }       $tbody .= "</tr>";
                        }
                        $grid .= "<thead><tr> {$thead} </tr></thead> <tbody> {$tbody} </tbody>";
                        $grid .= '</table>';
                endif; //if (!$columns)
                
                return $grid;
        } #DBGrid End.
	
} #class database End.

?>