<?php
  require_once 'lib/conn.inc.php';

  class RwService {

    private $conn = null;
    private $table = 'M_TingkatKesejahteraan';

    public function __construct() {
      $this->conn = new Conn();
      $this->conn->openMssqlConnection();
    }
    
    public function getAllRecord() {
      $sql = 'SELECT * FROM ' . $this->table . ' ORDER BY RWId';  
      $result = mssql_query( $sql );
      $data = array();

      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $data[] = array(
              'ID' => $val[ 'ID' ],
              'Tingkat' => $val[ 'Tingkat' ],
              'SortNumber' => $val[ 'SortNumber' ],
              'IsActive' => $val[ 'IsActive' ]
          );
        }
      }

      mssql_free_result( $result );

      return $data;
    }       

    public function getTingkatKesejahteraanById( $id ) {
      $sql = 'SELECT * FROM ' . $this->table . ' WHERE ID=' . $id;  
      $result = mssql_query( $sql );
      $data = array();

      if ( mssql_num_rows( $result ) > 0 ) {
        while ( $val = mssql_fetch_assoc( $result ) ) {      
          $data[] = array(
              'ID' => $val[ 'ID' ],
              'Tingkat' => $val[ 'Tingkat' ],
              'SortNumber' => $val[ 'SortNumber' ],
              'IsActive' => $val[ 'IsActive' ]
          );
        }
      }     
      
      mssql_free_result( $result ); 
      
      return $data;
    }
  }  
  
?>
