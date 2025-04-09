<?php
/*
__DIR__ là hằng số PHP trả về đường dẫn tuyệt đối đến thư mục hiện tại (tức là thư mục models/).

'../config/database.php' đi lên một cấp và vào thư mục config.

require_once đảm bảo file database.php chỉ được nạp một lần, tránh lỗi trùng lặp.
*/
    require_once __DIR__ . '/../config/database.php';
    
    //đại diện cho bảng su_kien trong cơ sở dữ liệu
    class SuKienModel{
        private $conn;

        public function __construct($db){
            $this->conn = $db;
        }

        public function LayTatCaSuKien(){
            $sql = "SELECT * FROM su_kien";
            $result = $this->conn->query($sql);

            $data = [];
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
    }
?>