<?php

// include("../dbconnection/db.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbFiles = "for_office";

// Create connection
$con = new mysqli($servername, $username, $password, $dbFiles);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}
// echo "Connected successfully";

// session_start();








if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['createdSaleOrder'])) {


        $userInputsData    =    $_POST['userInputData'];


        $username = $userInputsData['username'];
        $user_address  = $userInputsData['user_address'];
        $user_phone_number = $userInputsData['user_phone_number'];
        $user_email = $userInputsData['user_email'];
        $installation_is_required = $userInputsData['installation_is_required'];
        $installation_need_by_date = $userInputsData['installation_need_by_date'];
        $tntative_installation = $userInputsData['tntative_installation'];
        $perform_invoice = $userInputsData['perform_invoice'];
        $quotation_shared_date = $userInputsData['quotation_shared_date'];
        $remarks = $userInputsData['remarks'];
        $current_user = $_SESSION['username'];
        $current_date = date('Y-m-d H:i:s');

        $query = "INSERT INTO `for_office`.`sale_order_header` (`username`, `user_address`, `user_phone_number`, `user_email`, `installation_is_required`, `installation_need_by_date`, `tntative_installation`, `perform_invoice`, `quotation_shared_date`, `remarks`,`created_by`,`created_date`) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?);";

        $stmt = $con->prepare($query);

        // Bind parameters: the types string (s) and integer (i) need to be defined here
        // Assuming all the values are strings except installation_is_required which might be an integer
        $stmt->bind_param(
            "ssisssssssss",  // Types for each parameter (all strings in this case)
            $username,
            $user_address,
            $user_phone_number,
            $user_email,
            $installation_is_required,
            $installation_need_by_date,
            $tntative_installation,
            $perform_invoice,
            $quotation_shared_date,
            $remarks,
            $current_user,
            $current_date

        );

        $itemData = $_POST['inItems'];





        // Execute the statement
        if ($stmt->execute()) {


            $so_number =   $stmt->insert_id;





            foreach ($itemData as $key => $value) {


                $item_type = $value['item_type'];
                $itemcode =  $value['itemcode'];
                $itemname = $value['itemname'];
                $quantuty = (int) $value['quantuty'];
                $rate = (int) $value['rate'];
                $total_price = $rate * $quantuty;
                $so_number;
                $created_by = $_SESSION['username'];
                $created_date = date("y-m-h");
                $img = $value['item_image'];

                $shippingaddress = "shippingaddress";




                $sql = "INSERT INTO `for_office`.`sale_order_items_lines` (`so_number`, `item_code`, `item_name`, `qty`, `rate`, `total`, `shipping_address`, `item_image_path`, `item_type`, `created_by`, `created_date`)
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";











                $stmt = $con->prepare($sql);
                $stmt->bind_param("sssiiisssss", $so_number, $itemcode, $itemname, $qty, $rate, $total_price, $shippingaddress, $img, $item_type, $created_by, $created_date);



                if ($stmt->execute()) {



                    $response['success'] = true;
                    $response['message'] = 'successfully data inserted';
                } else {
                    $response['success'] = false;
                    $response['message'] = $stmt->error;
                }
            }

























            $response['so_number'] = $so_number;
        } else {



            $response['itemdata'] = $itemData;
            $response['success'] = false;
            $response['message'] = $stmt->error;
        }





















        $response['post_data']   = $userInputsData;
        $response['inItems']   = $_POST['inItems'];



        echo json_encode($response);
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {



    if (isset($_GET['getIBomItem'])) {





        $search_query = $_GET['searchQuery'];



        // $sql = "SELECT * FROM for_office.item_master_dp_cproduct where product_name like '%$search_query%'  or product_code like '%$search_query%' order by s_no DESC;";


        $sql = "SELECT * FROM `item_master_dpc_product` WHERE product_name LIKE '%$search_query%'";


        // $sql = "SELECT a.*,b.imagePath as item_image FROM for_office.item_master_dp_cproduct a   JOIN for_office.item_master_main b on a.item_code = b.item_code where a.item_name like '%$search_query%'  or a.item_code like '%$search_query%' order by a.header_id DESC;";

        $result  = mysqli_query($con, $sql);




        if (mysqli_num_rows($result) > 0) {
            $response['success'] =  true;

            $data = [];



            while ($row = mysqli_fetch_assoc($result)) {





                $data[] = $row;
            }


                


            // $response['success'] = true;
            $response['bom_data'] = $data;


        } else {
            $response['success'] = false;
            $response['message'] = mysqli_error($con);
            // $response['message'] = "This is error";
        }








        // $response['message'] = 'Acepted succss fyllu';






        echo json_encode($response);
    }
    if (isset($_GET['getRowItem'])) {




        $search_query = $_GET['searchQuery'];



        $sql = "SELECT * FROM for_office.item_master_main where Short_Description like '%$search_query%'  or item_code like '%$search_query%' order by S_No DESC ";

        $result  = mysqli_query($con, $sql);




        if (mysqli_num_rows($result) > 0) {
            $response['success'] =  true;

            $data = [];



            while ($row = mysqli_fetch_assoc($result)) {





                $data[] = $row;
            }





            $response['bom_data'] = $data;
        } else {
            $response['success'] = false;
            $response['message'] = mysqli_error($con);
        }








        $response['message'] = 'Acepted sucss fyllu';






        echo json_encode($response);
    }






    if (isset($_GET['getIBomItemOnlyData'])) {




        $search_id = $_GET['search_id'];



        $sql = "SELECT * FROM for_office.item_master_dp_cproduct where product_name= $search_id";
        // $sql = "SELECT a.*,b.imagePath as item_image FROM for_office.bom_hedar_detail a   JOIN for_office.item_master_main b on a.item_code = b.item_code where a.header_id = '$search_id'";

        $result= mysqli_query($con, $sql);




        if (mysqli_num_rows($result) > 0) {
            $response['success'] =  true;

            $data = [];



            while ($row = mysqli_fetch_assoc($result)) {





                $data[] = $row;
            }





            $response['bom_data'] = $data;
        } else {
            $response['success'] = false;
            $response['message'] = mysqli_error($con);
        }


        $response['message'] = 'Acepted success fully';


        echo json_encode($response);
    }
    if (isset($_GET['getIBomItemOnlyDataRow'])) {

        $search_id = $_GET['search_id'];


        $sql = "SELECT * FROM for_office.item_master_main where S_No = $search_id ;";
        $result  = mysqli_query($con, $sql);


        if (mysqli_num_rows($result) > 0) {
            $response['success'] =  true;

            $data = [];

            while ($row = mysqli_fetch_assoc($result)) {

                $data[] = $row;
            }


            $response['bom_data'] = $data;
        } else {
            $response['success'] = false;
            $response['message'] = mysqli_error($con);
        }


        $response['message'] = 'Acepted sucss fyllu';

        echo json_encode($response);
    }




    if (isset($_GET['getBomDataById'])) {



        $bom_id = $_GET['bom_id'];


        $sql = "SELECT *,b.item_code as line_item_code FROM for_office.bom_hedar_detail a JOIN for_office.bom_line_detail  b  on a.header_id= b.bom_id where a.header_id = $bom_id;";
//         $sql = "SELECT a.*,b.*,c.imagePath as imagepath,b.item_code as line_item_code,b.item_name as item_name_product FROM for_office.bom_hedar_detail a 
// JOIN for_office.bom_line_detail  b  on a.header_id= b.bom_id 
// JOIN for_office.item_master_main c on b.item_code= c.item_code where a.header_id = $bom_id ;";



        $result = mysqli_query($con, $sql);


        if ($result) {



            $data = [];

            while ($row = mysqli_fetch_assoc($result)) {

                $data[] = $row;
            }


            $response['success'] = true;
            $response['message'] = "Success fully get data";
            $response['data'] = $data;
        } else {


            $response['success'] = false;
            $response['error'] = mysqli_error($con);
        }



        echo json_encode($response);
    }



    if (isset($_GET["getDataOfLineBom"])) {





        $selectedSubCatId = 2;

        // include("db.php");

        include('../dbconnection/db.php');




        $bom_id = $_GET['bomId'];





        $sqlbom = "SELECT *,b.item_code as line_item_code FROM for_office.bom_hedar_detail a JOIN for_office.bom_line_detail  b  on a.header_id= b.bom_id where a.header_id = $bom_id;";



        $resultforBom = mysqli_query($con, $sqlbom);


        $totalnumofrow  =  mysqli_num_rows($resultforBom);


        if ($resultforBom) {




            $lineIds = [];
            $itemData = [];
            while ($row = mysqli_fetch_assoc($resultforBom)) {




                $item_code = $row['line_item_code'];
                $line_id = $row['id'];

                $lineIds[] = $line_id;


                $sql = "SELECT  subCatId FROM for_office.item_master_main where item_code = '$item_code'; ";


                $result1 = mysqli_query($con, $sql);

                if (mysqli_num_rows($result1) > 0) {


                    $row1  = mysqli_fetch_assoc($result1);

                    $selectedSubCatId = $row1['subCatId'];













                    $sql = "SELECT * FROM for_office.requireattributeforcatname where SubcatId=$selectedSubCatId";


                    $result = mysqli_query($con, $sql);

                    $data = [];

                    $columns = "SELECT item_code,Short_Description,Item_Category,subCatId    ";

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                            $data[] = $row["name"];
                            $columns .= " , " . $row["name"];
                        }
                        $columns .= " , " . "imagePath";
                        $columns .= " , " . "item_type";
                    }

                    // $columns .= " , " . "itemStatus";
                    // echo "<script>alert(errrol)</script>";



                    // $sql = "SELECT * FROM for_office.item_master_temp ;";/




                    $tbody_data = [];






                    $sql = "$columns from for_office.item_master_main where item_code='$item_code';";
                    // $sql = "$columns from for_office.item_master_main ";
                    $result3 = mysqli_query($con, $sql);

                    $row2 = mysqli_fetch_assoc($result3);


                    $tbody_data[] = $row2;





                    // $response["theaders"] = $data;





                    // $response["tbody_data"] = $tbody_data;

                    $response["success"] = true;





                    $itemData[$line_id] = $tbody_data;
                }
            }


            $response['itemdata'] = $itemData;
            $response['ids'] = $lineIds;
            $response['bom id'] = $bom_id;
            // $response['Total rows'] = $totalnumofrow;
            $response['Query'] = $sqlbom;

            echo  json_encode($response);
        }
    }
}
