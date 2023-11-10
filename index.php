
    <?php
//-------Session
    session_start();
    include('./config.php');
    
//------Types and Examples
    $arr = ['1', '2', '3'];
    $assoc_arr = ['one' => '1','two' => '2', 'three' => '3'];
    $name = 'Vinícius';
    $is_true = "Vinícius" == 'Vinícius';
    // echo "Olá, $name! $is_true";
    // foreach($arr as $num){}
    // foreach($assoc_arr as $key=>$num){}
    // for($i = 0; $i < count($arr); $i++){
    //     $num = $arr[$i];
    //     echo "<td><tr>$num</td></tr>";
    // }
          
    // $person_id = $_GET["person-id"];

//----Get Request
    if ($_SERVER['REQUEST_METHOD']=='GET') {
        $person_id = filter_input(INPUT_GET,'person-id', FILTER_SANITIZE_NUMBER_INT);

            if($person_id == false){
                $person_id = 'undefined';
            } 

        $person = (object) array('name'=> 'marcos', 'id'=> $person_id, 'email'=>(string)'marcos@email.com');
        $response = json_encode($person);
        echo $response;
    }     

//-----Post Request
//     $data = $_POST;
//     if (!empty($data)) {
//    $name = $data['name'];
//    $email = $data['email'];
//   echo ''. $name .''. $email .'';
//     } else {
//    http_response_code(400);
//    echo "No JSON data received";
//     }

//------ Post with json
if ($_SERVER['REQUEST_METHOD']=='POST') {

    $jsonData = file_get_contents('php://input');
    if($jsonData == false) {    
        $response = ['status'=> 'fail', 'message'=> 'fatal error on the server'];
        echo json_encode($response);
        die();  //stop
 }
 // Decode the JSON data into a PHP associative array
 $data = json_decode($jsonData, true);
 // Check if decoding was successful
 if ($data !== null) {
     // Access the data and perform operations
     //TODO sanitize
     $name = $data['name'];
     $email = $data['email'];
     $id = $data['id'];
     
     $response = ['status'=> 'success', 'name'=> $name, 'email'=> $email, 'id'=> $id];
     
     echo json_encode($response);
    } else {
        // JSON decoding failed
        http_response_code(400); // Bad Request
        echo "Invalid JSON data";
    }
}

//------Authenticate
    function authenticate_user($email, $password) {
        return true;
    }
    
?>
    
