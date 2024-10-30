<?php

// include("../dbconnection/db.php");
$con = mysqli_connect("localhost", "root", "Algo@123", "dpc_project") or die("connection failed");  

if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    if (isset($_GET['getRequireAttrs'])) {


        $sub_id = $_GET['sub_id'];


        $sql = "SELECT * FROM requireattributeforcatname where  SubcatId =$sub_id ;";



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
    if (isset($_GET['getAllAttrubte'])) {


        $sub_id = $_GET['sub_id'];


        // $sql = "SELECT * FROM require_atts;";
        $sql = "SELECT name
FROM require_atts aa where 1=1 
and aa.name not in (select name from requireattributeforcatname where  subcatid=$sub_id);";



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




    if (isset($_GET['getAllAttributeByFieldName'])) {


        $attr_id = $_GET['attr_id'];


        $sql = "SELECT * FROM fields_lookup where attr_id=$attr_id; ";



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
    if (isset($_GET['getAllMAinCatName'])) {


        // $attr_id = $_GET['attr_id'];


        $sql = "SELECT * FROM itemmastercategory; ";



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
    if (isset($_GET['getAllSubCatName'])) {



        // $attr_id = $_GET['attr_id'];


        $sql = "SELECT * FROM sub_category a join itemmastercategory b on a.catId=b.categoryId; ";



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
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['addNewAttributesToSubCat'])) {




        $checkedRowData = $_POST['checkedRowData'];
        $sub_Cat_id = $_POST['sub_Cat_id'];




        foreach ($checkedRowData as $key => $value) {
            # code...



            $sql = "INSERT INTO `requireattributeforcatname` (`SubcatId`, `name`) VALUES (?, ?);";


            $stmt = $con->prepare($sql);

            $stmt->bind_param("ss", $sub_Cat_id, $value);



            if ($stmt->execute()) {







                $response['success'] = true;
                $response['message'] = "Success fully updated";
            } else {


                $response['success'] = false;
                $response['error'] = mysqli_error($con);
            }
        }









        $response['success'] = true;

        $response['message'] = 'Request success';
        $response['sub_Cat_id'] = $_POST['sub_Cat_id'];
        $response['data'] = $checkedRowData;


















        echo  json_encode($response);
    }






    if (isset($_POST['addingNewAttributes'])) {


        $attr_id = $_POST['attr_id'];
        $validAttRnames = $_POST['validAttRnames'];
        $isDropDown = $_POST['isDropDown'];






        // var_dump($validAttRnames);


        $sql = "DELETE FROM `fields_lookup` WHERE (`attr_id` = '$attr_id')";

        $result2 = mysqli_query($con, $sql);


        if ($result2) {



            $sql2 = "UPDATE `requireattributeforcatname` SET `dropdown` = '$isDropDown' WHERE (`attr_id` = '$attr_id');";

            $result3 = mysqli_query($con, $sql2);
            if ($result3) {



                foreach ($validAttRnames as $key => $value) {
                    
                                // $i  = 1;

                    $sql = "INSERT INTO `fields_lookup` (`attr_id`, `description`) VALUES (?, ?);";


                    $stmt = $con->prepare($sql);

                    $stmt->bind_param("ss", $attr_id, $value);



                    if ($stmt->execute()) {







                        $response['success'] = true;
                        $response['message'] = "Success fully updated";
                    } else {


                        $response['success'] = false;
                        $response['error'] = mysqli_error($con);
                    }
                }
            } else {
                $response['success'] = false;
                $response['error'] = mysqli_error($con);
            }



            $response['success'] = true;
            $response['message'] = "Success fully updated";
        } else {


            $response['success'] = false;
            $response['error'] = mysqli_error($con);
        }











        $response['rec_data'] = $_POST;
        echo json_encode($response);
    }
    if (isset($_POST['createNewSubCat'])) {


        $mainCatId = $_POST['mainCatId'];
        $newSubName = $_POST['newSubName'];







        // var_dump($validAttRnames);


        $sql = "INSERT INTO `sub_category` (`catId`, `name`) VALUES (?, ?);";




        $stmt = $con->prepare($sql);

        $stmt->bind_param("ss", $mainCatId, $newSubName);

        $result2 = $stmt->execute();


        if ($result2) {

            $return_id = $stmt->insert_id;

            $sql = "INSERT INTO `requireattributeforcatname` (`SubcatId`, `name`) VALUES ('$return_id', 'name');";

            if (mysqli_query($con, $sql)) {





                $response['success'] = true;
                $response['message'] = "Success fully updated";
                $response['message2'] = "New attr is created success";
                $response['return_id'] = $return_id;
            } else {
                $response['success'] = false;
                $response['error'] = mysqli_error($con);
            }
        } else {


            $response['success'] = false;
            $response['error'] = mysqli_error($con);
        }











        $response['rec_data'] = $_POST;
        echo json_encode($response);
    }
    if (isset($_POST['createdNewCategory'])) {


        // $mainCatId = $_POST['mainCatId'];
        $newCatName = $_POST['newCatName'];







        // var_dump($validAttRnames);


        $sql = "INSERT INTO `itemmastercategory` (`catagory_name`) VALUES (?);";




        $stmt = $con->prepare($sql);

        $stmt->bind_param("s", $newCatName);

        $result2 = $stmt->execute();


        if ($result2) {

            $return_id = $stmt->insert_id;





            $response['success'] = true;
            $response['message'] = "Success fully updated";
            $response['message2'] = "New attr is created success";
            $response['return_id'] = $return_id;
        } else {


            $response['success'] = false;
            $response['error'] = mysqli_error($con);
        }











        $response['rec_data'] = $_POST;
        echo json_encode($response);
    }











    //REMOVING SUB CATEGORY

    if (isset($_POST['removeSubCategory'])) {



        $sub_id = $_POST['sub_id'];


        $sql = "DELETE FROM `sub_category` WHERE (`subCatId` = ?); ";



        $stmt = $con->prepare($sql);

        $stmt->bind_param("i", $sub_id);



        $result = $stmt->execute();






        if ($result) {



            $data = [];



            $response['success'] = true;
            $response['message'] = "Row successfully removed ";
            $response['data'] = $_POST;
        } else {


            $response['success'] = false;
            $response['error'] = mysqli_error($con);
        }



        echo json_encode($response);
    }
    if (isset($_POST['removeMainCategory'])) {



        $cat_id = $_POST['cat_id'];


        $sql = "DELETE FROM `itemmastercategory` WHERE (`categoryId` = ?);";



        $stmt = $con->prepare($sql);

        $stmt->bind_param("i", $cat_id);



        $result = $stmt->execute();






        if ($result) {  



            


            $response['success'] = true;
            $response['message'] = "Row successfully removed ";
            $response['data'] = $_POST;
        } else {


            $response['success'] = false;
            $response['error'] = mysqli_error($con);
        }



        echo json_encode($response);
    }
}
