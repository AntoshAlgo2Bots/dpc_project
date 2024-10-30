<?php


session_start();
include('../dbconnection/db.php');


// $con = mysqli_connect("localhost", "root", "Algo@123", "dpc_project") or die("connection failed");





if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['getSubCatAttrs'])) {




        $subCatId = $_GET['subCatId'];


        // include("db.php");


        // $sql = "SELECT * FROM requireattributeforcatname where catId= $catId  ";
        $sql = "SELECT * FROM requireattributeforcatname where SubcatId = $subCatId;";
        // $sql = "SELECT * FROM itemmastercategory a JOIN sub_category b ON a.categoryId =b.catId where b.catId = $catId ";


        $result = mysqli_query($con, $sql);
        // $row = mysqli_fetch_assoc($result);




        if ($result) {

            $data = [];

            while ($row = mysqli_fetch_assoc($result)) {

                
                



                $data[] = $row;
            }



            $response["success"] = true;
            $response["data"] = $data;
        } else {



            $response["success"] = false;
            $response["message"] = "erroe when data fetching from mysql";
        }






        echo json_encode($response);
    }
}



if($_SERVER['REQUEST_METHOD']=='POST'){



    if(isset($_POST['saveItemDataToTemp'])) {









        
        $attr  = $_POST["attrData"];;
        





        $item_code = isset($attr["item_code"]) ? $attr["item_code"] : null;
        $item_name = isset($attr["item_name"]) ? $attr["item_name"] : null;
        $item_description = isset($attr["item_description"]) ? $attr["item_description"] : null;
        $organization  = isset($attr["organization"]) ? $attr["organization"] : null;
        $item_category  = isset($attr["item_category"]) ? $attr["item_category"] : null;
        $item_sub_category  = isset($attr["item_sub_category"]) ? $attr["item_sub_category"] : null;
        $item_sub_sub_category = isset($attr["item_sub_sub_category"]) ? $attr["item_sub_sub_category"] : null;
        $finish_raw_material = isset($attr["finish_raw_material"]) ? $attr["finish_raw_material"] : null;
        $item_starting_date = isset($attr["item_starting_date"]) ? $attr["item_starting_date"] : null;
        // $Half_Full_Thread = isset($attr["Half_Full_Thread"]) ? $attr["Half_Full_Thread"] : null; // need t o cheng with attrbute 5
        // $Holder_Thread = isset($attr["Holder_Thread"]) ? $attr["Holder_Thread"] : null;
        // $Holder_type = isset($attr["Holder_type"]) ? $attr["Holder_type"] : null;
        // $Thread = isset($attr["Thread"]) ? $attr["Thread"] : null;
        // $brand = isset($attr["Brand"]) ? $attr["Brand"] : null;;
        // $brand = isset($attr["Brand"]) ? $attr["Brand"] : null;
        // $Light_Output_colour = isset($attr["Light_Output_Colour"]) ? $attr["Light_Output_Colour"] : null;
        // $Colour = isset($attr["Colour"]) ? $attr["Colour"] : null;
        // $Cut = isset($attr["Cut"]) ? $attr["Cut"] : null;
        // $Height = isset($attr["Height"]) ? $attr["Height"] : null;
        // $Length = isset($attr["Length"]) ? $attr["Length"] : null;
        // $Breadth = isset($attr["Breadth"]) ? $attr["Breadth"] : null;
        // $Upper_Dia = isset($attr["Upper_Dia"]) ? $attr["Upper_Dia"] : null;
        // $Bottom_Dia = isset($attr["Bottom_Dia"]) ? $attr["Bottom_Dia"] : null;
        // $Centre_Hole_dia = isset($attr["Centre_Hole_dia"]) ? $attr["Centre_Hole_dia"] : null;
        // $Size = isset($attr["Size"]) ? $attr["Size"] : null;
        // $watt = isset($attr["Watt"]) ? $attr["Watt"] : null;
        // $Shape = isset($attr["Shape"]) ? $attr["Shape"] : null;
        // $Side_Hole_dia = isset($attr["Side_Hole_dia"]) ? $attr["Side_Hole_dia"] : null;
        // $Top_hole_dia = isset($attr["Top_hole_dia"]) ? $attr["Top_hole_dia"] : null;
        // $No_of_ply = isset($attr["No_of_ply"]) ? $attr["No_of_ply"] : null;
        // $Style = isset($attr["Style"]) ? $attr["Style"] : null;
        // $Thickness = isset($attr["Thickness"]) ? $attr["Thickness"] : null;
        // $Weight = isset($attr["Weight"]) ? $attr["Weight"] : null;
        // $Depth = isset($attr["Depth"]) ? $attr["Depth"] : null;
        // $Bottom_hole_dia = isset($attr["Thickness"]) ? $attr["Thickness"] : null;
        // $Core = isset($attr["Core"]) ? $attr["Core"] : null;
        // $Inner_Outer_thread = isset($attr["Inner_Outer_thread"]) ? $attr["Inner_Outer_thread"] : null;
        // $Upper_thread = isset($attr["Upper_thread"]) ? $attr["Upper_thread"] : null;
        // $Lower_thread = isset($attr["Lower_thread"]) ? $attr["Lower_thread"] : null;
        // $Thread_length = isset($attr["Thread_length"]) ? $attr["Thread_length"] : null;
        // $Indian_Imported = isset($attr["Indian_Imported"]) ? $attr["Indian_Imported"] : null;
        // $In_built_switch  = isset($attr["In_built_switch"]) ? $attr["In_built_switch"] : null;
        // $Wire_type  = isset($attr["Wire_type"]) ? $attr["Wire_type"] : null;
        // $Vendor  = isset($attr["Vendor"]) ? $attr["Vendor"] : null;
        // $attribute1  = isset($attr["attribute1"]) ? $attr["attribute1"] : null;
        // $attribute2  = isset($attr["attribute2"]) ? $attr["attribute2"] : null;
        // $attribute3  = isset($attr["attribute3"]) ? $attr["attribute3"] : null;
        $imagePath  =  isset($_POST["filePath"]) ? $_POST["filePath"] :   null;
        // $long_discription  =  isset($attr["Long_Description"]) ? $attr["Long_Description"] :   null;
        // // $long_discription  =  "hekkir";
        // $Pintop  =  isset($attr["Pintop"]) ? $attr["Pintop"] :   null;
        // $Discount  =  isset($attr["Discount"]) ? $attr["Discount"] :   null;
        // $fabric  =  isset($attr["fabric"]) ? $attr["fabric"] :   null;
        // $piping  =  isset($attr["piping"]) ? $attr["piping"] :   null;
        // $piping_color  =  isset($attr["piping_color"]) ? $attr["piping_color"] :   null;
        // $acrylic_diffuser  =  isset($attr["acrylic_sheet"]) ? $attr["acrylic_sheet"] :   null;
        // $gallery_heght  =  isset($attr["gallery_height"]) ? $attr["gallery_height"] :   null;
        // $sheet =  isset($attr["sheet"]) ? $attr["sheet"] :   null;
        // $sheet_color  =  isset($attr["sheet_color"]) ? $attr["sheet_color"] :   null;
        // $powder_coating  =  isset($attr["Frame"]) ? $attr["Frame"] :   null;
        // $fabric_colour = isset($attr["fabric_colour"]) ? $attr["fabric_colour"] :   null;
        // $colour_temparature = isset($attr["Colour_Temparature"]) ? $attr["Colour_Temparature"] :   null;
        // $Dimmable = isset($attr["Dimmable"]) ? $attr["Dimmable"] :   null;
        // $Location = isset($attr["Location"]) ? $attr["Location"] :   null;
        // $Dimmeter = isset($attr["Diameter"]) ? $attr["Diameter"] :   null;
        // $Collar = isset($attr["Collar"]) ? $attr["Collar"] :   null;
        // $Socket = isset($attr["Socket"]) ? $attr["Socket"] :   null;
        // $Ink_type = isset($attr["Ink_type"]) ? $attr["Ink_type"] :   null;
        // // $Finish_type = isset($attr["Finish_type"]) ? $attr["Finish_type"] :   null;
        // $Transparent = isset($attr["Transparent"]) ? $attr["Transparent"] :   null;
        // $dwdwd = isset($attr["dwdwd"]) ? $attr["dwdwd"] :   null;

        // $departement = "departement";

        // $createdBy = $_SESSION["username"];
        $createdDate = date("y-m-d");

        // $itemStatus  = $_GET["currentItemStatus"];
        $itemStatus  = "SAVE";
        ///



        $response["acceptes data"] = $attr; 

        ////


        $sql = "INSERT into item_master_main (
        item_code,
        item_name,
        item_description,
        organization,
        item_category,
        item_sub_category,
        item_sub_sub_category,
        finish_raw_material,
        item_starting_date,
      
        imagePath
       

        ) 
        values (
        '$item_code',
        '$item_name',
        '$item_description',
        '$organization',
        '$item_category',
        '$item_sub_category',
         '$item_sub_sub_category' ,
        '$finish_raw_material',
        '$item_starting_date' ,
      '  $imagePath ' 
        )";



        $result = mysqli_query($con, $sql);







        // echo "Color: " . $color . "<br>";
        // echo "Sub Category ID: " . $subCatId . "<br>";
        // echo "Category ID: " . $catId . "<br>";
        // echo "Item Code: " . $itemCode . "<br>";
        // echo "Short Description: " . $shortDiscription . "<br>";
        // echo "Size: " . $size . "<br>";
        // echo "Watt: " . $watt . "<br>";
        // echo "Shape: " . $Shape . "<br>";
        // echo "Brand: " . $brand . "<br>";
        // echo "Light Output Colour: " . $Light_Output_colour . "<br>";
        // echo "Vendor: " . $vandore . "<br>";
        // echo "Description: " . $description . "<br>";
        // echo "Price: " . $price . "<br>";
        // echo "Length: " . $length . "<br>";
        // echo "Material: " . $material . "<br>";
        // echo "Wire Type: " . $wireType . "<br>";
        // echo "In-Built Switch: " . $inBuiltSwicth . "<br>";
        // echo "Pin Top: " . $pintop . "<br>";
        // echo "Holder Type: " . $holer . "<br>";
        // echo "Images: " . $images . "<br>";



        if (mysqli_error($con)) {

            $response["error"] = "" . mysqli_error($con);
        }


        $response["recordId"] = mysqli_insert_id($con);
        $response["item_code"] = $item_code;
        $response["item_description"] = $item_description;
        // if (isset($_FILES)) {

        //     $response["file"] = $_FILES;
        // }


        $response["statuss"] = $itemStatus;

        $response["success"] = true;


        echo json_encode($response);


    






    }



    if (isset($_FILES["itemImage"])) {

        $targetDir = "../images/";

        // Create a unique file name using the current timestamp
        $fileName = time() . '_' . basename($_FILES["itemImage"]["name"]);

        // The full path to the new file
        $newFileName = $targetDir . $fileName;

        $response = [];

        if ($_FILES["itemImage"]["error"] == UPLOAD_ERR_OK) {
            // Move the uploaded file to the target directory with the new name
            if (move_uploaded_file($_FILES["itemImage"]["tmp_name"], $newFileName)) {
                $response["data"] = "The file has been uploaded successfully.";
                $response["filePath"] = $fileName; // Return the file name (relative path)
                $response["success"] = true; // Return the file name (relative path)
            } else {
                $response["data"] = "There was an error moving the uploaded file.";
            }
            
            
            
        } else {
            $response["data"] = "There was an error during the file upload.";
            $response["success"] = false; // Return the file name (relative path)
        }

        // Output the response as JSON
        header('Content-Type: application/json');



        echo json_encode($response);
    }





}