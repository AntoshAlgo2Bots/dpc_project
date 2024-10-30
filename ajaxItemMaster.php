<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    if (isset($_GET['getColumnInfo'])) {


        $selectedSubCatId = $_GET['selectedSubCatId'];

        // include("db.php");
        // include('./dbconnection/db.php');
        include('./dbconnection/db.php');

        $sql = "SELECT * FROM requireattributeforcatname where SubcatId=$selectedSubCatId";


        $result = mysqli_query($con, $sql);

        $data = [];

        $columns = "SELECT S_No,Short_Description,item_code,Item_Category,subCatId";

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

                $data[] = $row["name"];
                $columns .= " , " . $row["name"];
            }
            $columns .= " , " . "imagePath";
            $columns .= " , " . "item_type";
        }

        $columns .= " , " . "itemStatus";
        // echo "<script>alert(errrol)</script>";



        // $sql = "SELECT * FROM item_master_temp ;";/




        $tbody_data = [];






        $sql = "$columns from item_master_temp where SubcatId=$selectedSubCatId;";
        $result = mysqli_query($con, $sql);

        // echo $sql;

        while ($row = mysqli_fetch_assoc($result)) {


            $tbody_data[] = $row;
        }




        // $response["theaders"] = $data;
        $response["error"]=mysqli_error($con);
        $response["tbody_data"] = $tbody_data;
        
        $response["success"] = true;






        echo  json_encode($response);
    }




    if (isset($_GET['getAllItemInfo'])) {


        $selectedSubCatId = $_GET['selectedSubCatId'];

        // include("db.php");
        include('./dbconnection/db.php');
        include('./dbconnection/db.php');

        $sql = "SELECT * FROM requireattributeforcatname where SubcatId=$selectedSubCatId";


        $result = mysqli_query($con, $sql);

        $data = [];

        $columns = "SELECT S_No,item_code,Short_Description,Item_Category,subCatId    ";

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



        // $sql = "SELECT * FROM item_master_temp ;";/




        $tbody_data = [];






        $sql = "$columns from item_master_main where SubcatId=$selectedSubCatId;";
        // $sql = "$columns from item_master_main ";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)) {


            $tbody_data[] = $row;
        }




        // $response["theaders"] = $data;

        $response["tbody_data"] = $tbody_data;

        $response["success"] = true;






        echo  json_encode($response);
    }





    if (isset($_GET['categoryFields'])) {



        $catId = $_GET['catId'];

        // include("db.php");
        include('./dbconnection/db.php');


        // $sql = "SELECT * FROM requireattributeforcatname where catId= $catId  ";
        $sql = "SELECT * FROM dpc_project.sub_category where catId=$catId  ;  ";
        $sql = "SELECT * FROM itemmastercategory a JOIN sub_category b ON a.categoryId =b.catId where b.catId = $catId ";


        $result = mysqli_query($con, $sql);
        // $row = mysqli_fetch_assoc($result);




        if ($result) {

            $data = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $subCatId = $row["subCatId"];

                $requireData = [];

                $sql1 = "SELECT * FROM requireattributeforcatname where SubcatId= $subCatId ";
                $result1 = mysqli_query($con, $sql1);


                if ($result1) {
                    while ($row1 = mysqli_fetch_assoc($result1)) {


                        $requireData[] = $row1;
                        // $requireData[]= "manish";

                    }
                } else {
                    $requireData[] = "no data found";
                }




                $data[$row["name"]] = $requireData;

                // $sql = "SELECT * FROM requireattributeforcatname WHERE SubcatId =$subCatId";
                // $result= mysqli_query($con,$sql);
                // $row1 = mysqli_fetch_assoc($result);        


                // $data["name"]=$subCatId;
                // $data["name"]=$row1;


            }



            $response["success"] = true;
            $response["data"] = $data;
        } else {



            $response["success"] = false;
            $response["message"] = "erroe when data fetching from mysql";
        }






        echo json_encode($response);
    }

    // this is the temp data sent request
    if (isset($_GET["itemMasterSave"])) {

        // include("./db.php");
        include('./dbconnection/db.php');

        $attr  = $_GET["attrData"];;





        $itemCode = isset($_GET["itemCodeGenrated"]) ? $_GET["itemCodeGenrated"] : null;
        $Item_Category = isset($_GET["manCatId"]) ? $_GET["manCatId"] : null;
        $Short_Description = isset($attr["Short_Description"]) ? $attr["Short_Description"] : null;
        $subCatId  = isset($_GET["SubCatid"]) ? $_GET["SubCatid"] : null;
        $Price  = isset($attr["Price"]) ? $attr["Price"] : null;
        $si_unit  = isset($attr["SI_unit"]) ? $attr["SI_unit"] : null;
        $material = isset($attr["Material"]) ? $attr["Material"] : null;
        $Design = isset($attr["Design"]) ? $attr["Design"] : null;
        $Finish_type = isset($attr["finish_type"]) ? $attr["finish_type"] : null;
        $Half_Full_Thread = isset($attr["Half_Full_Thread"]) ? $attr["Half_Full_Thread"] : null; // need t o cheng with attrbute 5
        $Holder_Thread = isset($attr["Holder_Thread"]) ? $attr["Holder_Thread"] : null;
        $Holder_type = isset($attr["Holder_type"]) ? $attr["Holder_type"] : null;
        $Thread = isset($attr["Thread"]) ? $attr["Thread"] : null;
        $brand = isset($attr["Brand"]) ? $attr["Brand"] : null;;
        // $brand = isset($attr["Brand"]) ? $attr["Brand"] : null;
        $Light_Output_colour = isset($attr["Light_Output_Colour"]) ? $attr["Light_Output_Colour"] : null;
        $Colour = isset($attr["Colour"]) ? $attr["Colour"] : null;
        $Cut = isset($attr["Cut"]) ? $attr["Cut"] : null;
        $Height = isset($attr["Height"]) ? $attr["Height"] : null;
        $Length = isset($attr["Length"]) ? $attr["Length"] : null;
        $Breadth = isset($attr["Breadth"]) ? $attr["Breadth"] : null;
        $Upper_Dia = isset($attr["Upper_Dia"]) ? $attr["Upper_Dia"] : null;
        $Bottom_Dia = isset($attr["Bottom_Dia"]) ? $attr["Bottom_Dia"] : null;
        $Centre_Hole_dia = isset($attr["Centre_Hole_dia"]) ? $attr["Centre_Hole_dia"] : null;
        $Size = isset($attr["Size"]) ? $attr["Size"] : null;
        $watt = isset($attr["Watt"]) ? $attr["Watt"] : null;
        $Shape = isset($attr["Shape"]) ? $attr["Shape"] : null;
        $Side_Hole_dia = isset($attr["Side_Hole_dia"]) ? $attr["Side_Hole_dia"] : null;
        $Top_hole_dia = isset($attr["Top_hole_dia"]) ? $attr["Top_hole_dia"] : null;
        $No_of_ply = isset($attr["No_of_ply"]) ? $attr["No_of_ply"] : null;
        $Style = isset($attr["Style"]) ? $attr["Style"] : null;
        $Thickness = isset($attr["Thickness"]) ? $attr["Thickness"] : null;
        $Weight = isset($attr["Weight"]) ? $attr["Weight"] : null;
        $Depth = isset($attr["Depth"]) ? $attr["Depth"] : null;
        $Bottom_hole_dia = isset($attr["Thickness"]) ? $attr["Thickness"] : null;
        $Core = isset($attr["Core"]) ? $attr["Core"] : null;
        $Inner_Outer_thread = isset($attr["Inner_Outer_thread"]) ? $attr["Inner_Outer_thread"] : null;
        $Upper_thread = isset($attr["Upper_thread"]) ? $attr["Upper_thread"] : null;
        $Lower_thread = isset($attr["Lower_thread"]) ? $attr["Lower_thread"] : null;
        $Thread_length = isset($attr["Thread_length"]) ? $attr["Thread_length"] : null;
        $Indian_Imported = isset($attr["Indian_Imported"]) ? $attr["Indian_Imported"] : null;
        $In_built_switch  = isset($attr["In_built_switch"]) ? $attr["In_built_switch"] : null;
        $Wire_type  = isset($attr["Wire_type"]) ? $attr["Wire_type"] : null;
        $Vendor  = isset($attr["Vendor"]) ? $attr["Vendor"] : null;
        $attribute1  = isset($attr["attribute1"]) ? $attr["attribute1"] : null;
        $attribute2  = isset($attr["attribute2"]) ? $attr["attribute2"] : null;
        $attribute3  = isset($attr["attribute3"]) ? $attr["attribute3"] : null;
        $imagePath  =  isset($_GET["filePath"]) ? $_GET["filePath"] :   null;
        $long_discription  =  isset($attr["Long_Description"]) ? $attr["Long_Description"] :   null;
        // $long_discription  =  "hekkir";
        $Pintop  =  isset($attr["Pintop"]) ? $attr["Pintop"] :   null;
        $Discount  =  isset($attr["Discount"]) ? $attr["Discount"] :   null;
        $fabric  =  isset($attr["fabric"]) ? $attr["fabric"] :   null;
        $piping  =  isset($attr["piping"]) ? $attr["piping"] :   null;
        $piping_color  =  isset($attr["piping_color"]) ? $attr["piping_color"] :   null;
        $acrylic_diffuser  =  isset($attr["acrylic_sheet"]) ? $attr["acrylic_sheet"] :   null;
        $gallery_heght  =  isset($attr["gallery_height"]) ? $attr["gallery_height"] :   null;
        $sheet =  isset($attr["sheet"]) ? $attr["sheet"] :   null;
        $sheet_color  =  isset($attr["sheet_color"]) ? $attr["sheet_color"] :   null;
        $powder_coating  =  isset($attr["Frame"]) ? $attr["Frame"] :   null;
        $fabric_colour = isset($attr["fabric_colour"]) ? $attr["fabric_colour"] :   null;
        $colour_temparature = isset($attr["Colour_Temparature"]) ? $attr["Colour_Temparature"] :   null;
        $Dimmable = isset($attr["Dimmable"]) ? $attr["Dimmable"] :   null;
        $Location = isset($attr["Location"]) ? $attr["Location"] :   null;
        $Dimmeter = isset($attr["Diameter"]) ? $attr["Diameter"] :   null;
        $Collar = isset($attr["Collar"]) ? $attr["Collar"] :   null;
        $Socket = isset($attr["Socket"]) ? $attr["Socket"] :   null;
        $Ink_type = isset($attr["Ink_type"]) ? $attr["Ink_type"] :   null;
        // $Finish_type = isset($attr["Finish_type"]) ? $attr["Finish_type"] :   null;
        $Transparent = isset($attr["Transparent"]) ? $attr["Transparent"] :   null;

        $departement = "departement";

        $createdBy = $_SESSION["username"];
        $createdDate = date("y-m-d");

        $itemStatus  = $_GET["currentItemStatus"];
        ///



        // $response["acceptes data"] = $attr;

        ////


        $sql = "INSERT into item_master_temp (item_code,
        Item_Category,
        Short_Description,
        subCatId,
        Price,
        SI_unit,
        material,
        Design,
        item_type,
        Half_Full_Thread,
        Holder_Thread,
        Holder_type,
        Thread,
        brand,
        Light_Output_colour,
        Colour,
        Cut,
        Height,
        Length,
        Breadth,
        Upper_Dia,
        Bottom_Dia,
        Centre_Hole_dia,
        Size,
        Watt,
        Shape,
        Side_Hole_dia,
        Top_hole_dia,
        No_of_ply,
        Style,
        Thickness,
        Weight,
        Depth,
        Bottom_hole_dia,
        Core,
        Inner_Outer_thread,
        Upper_thread,
        Lower_thread,
        Thread_length,
        Indian_Imported,
        In_built_switch,
        Wire_type,
        Vendor,
        attribute1,
        attribute2,
        attribute3,
        imagePath,
        Long_Description,
        Pintop,
        Discount,
        fabric,
        fabric_colour,
        piping,
        piping_color,
        acrylic_sheet,
        gallery_heght,
        sheet_color,
        Frame,
        departement,
        Transparent,
        colour_temparature,
        Dimmable,
        Collar,
        Socket,
        Ink_type,
        Location,
        createdBy,
        createdDate,
        itemStatus

        ) 
        values ('$itemCode',
        '$Item_Category',
        '$Short_Description',
        '$subCatId',
        '$Price',
        '$si_unit',
        '$material',
         '$Design' ,
        '$Finish_type',
        '$Half_Full_Thread',
        '$Holder_Thread',
        '$Holder_type',
        '$Thread',
        '$brand',
        '$Light_Output_colour',
        '$Colour',
        '$Cut',
        '$Height',
        '$Length',
        '$Breadth',
        '$Upper_Dia' ,
        '$Bottom_Dia',
        '$Centre_Hole_dia',
        '$Size',
        '$watt',
        '$Shape',
        '$Side_Hole_dia',
        '$Top_hole_dia',
        '$No_of_ply',
        '$Style',
        '$Thickness',
        '$Weight',
        '$Depth',
        '$Bottom_hole_dia',
        '$Core',
        '$Inner_Outer_thread',
        '$Upper_thread',
        '$Lower_thread',
        '$Thread_length',
        '$Indian_Imported',
        '$In_built_switch',
        '$Wire_type',
        '$Vendor',
        '$attribute1',
        '$attribute2',
        '$attribute3',
        '$imagePath',
        '$long_discription',
        '$Pintop',
        '$Discount',
        '$fabric',
        '$fabric_colour',
        '$piping',
        '$piping_color',
        '$acrylic_diffuser',
        '$gallery_heght',
        '$sheet_color',
        '$powder_coating',
        '$departement',
        '$Transparent',
        '$colour_temparature',
        '$Dimmable',
        '$Collar',
        '$Socket',
        '$Ink_type',
        '$Location',
        '$createdBy',
        '$createdDate',
        '$itemStatus'
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
        $response["ItemCode"] = $itemCode;
        $response["shortDiscription"] = $Short_Description;
        // if (isset($_FILES)) {

        //     $response["file"] = $_FILES;
        // }


        $response["statuss"] = $itemStatus;

        $response["success"] = true;







        echo json_encode($response);
    } else if ((isset($_GET["getOptionAttr"]))) {


        // include("./db.php");
        include('./dbconnection/db.php');


        $attrId = $_GET["attr_id"];


        // $sql = "SELECT * from fields_lookup where attr_id=$attrId";
        // $sql = "SELECT * from fields_lookup where attr_id=$attrId";
        $sql = "SELECT * from fields_lookup where attr_id=$attrId;";





        $result = mysqli_query($con, $sql);


        $data = [];


        while ($row = mysqli_fetch_array($result)) {

            $data[] = $row;
        }




        $response["success"] = true;
        $response["data"] = $data;




        echo  json_encode($response);
    }



    //this is for searchManager Item data n table


    else if ((isset($_GET["searchDataInitemTampTable"]))) {


        // include("./db.php");
        include('./dbconnection/db.php');

        $id = $_GET['searchData'];

        $response["success"] = true;

        $sql = "SELECT subCatId FROM item_master_temp where  S_No=$id";

        
        $result  = mysqli_query($con, $sql);

        $row = mysqli_fetch_assoc($result);

        $subCatId = $row["subCatId"];


        //finding all column names form require attributes table

        $sql  =  "SELECT * FROM requireattributeforcatname where SubcatId =$subCatId;";



        // for insert columns code into this line


        $result = mysqli_query($con, $sql);

        $data = [];

        $columns = "SELECT S_No,item_code,Item_Category,catagory_name,a.subCatId,name as sub_cat_name";

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

                $data[] = $row["name"];
                $columns .= " , " . $row["name"];
            }
            $columns .= " , " . "imagePath";
        }

        $columns .= " , " . "itemStatus";



        $sql = "$columns from item_master_temp a
JOIN  itemmastercategory b ON  a.Item_Category = b.categoryId
JOIN sub_category c ON a.subCatId  = c.subCatId where S_No=$id;";







        $result = mysqli_query($con, $sql);

        if (!mysqli_num_rows($result) > 0) {



            $response["error"] = "No data found";
        }

        while ($row = mysqli_fetch_assoc($result)) {


            $tbody_data[] = $row;
        }




        // $response["theaders"] = $data;

        $response["tbody_data"] = $tbody_data;


        ///     


        // $result  = mysqli_query($con, $sql);



        $columns = mysqli_fetch_assoc($result);



        $response["sql"] = $sql;
        $response['columns'] = $columns;



        echo  json_encode($response);
    }




    //this is for get item detail for update from item master ith item master

    else if ((isset($_GET["getItemWithItemCodeForUpdate"]))) {


        // include("./db.php");
        include('./dbconnection/db.php');

        $id = $_GET['selected_item_code'];

        $response["success"] = true;

        $sql = "SELECT subCatId FROM item_master_temp where   item_code='$id'";

        $result  = mysqli_query($con, $sql);

        $row = mysqli_fetch_assoc($result);
        // echo $row['subCatId'];


        $subCatId = $row["subCatId"];


        //finding all column names form require attributes table

        $sql  =  "SELECT * FROM requireattributeforcatname where SubcatId =$subCatId;";



        // for insert columns code into this line


        $result = mysqli_query($con, $sql);

        $data = [];

        $columns = "SELECT S_No,item_code,Short_Description,Item_Category,catagory_name,a.subCatId,name as sub_cat_name";

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

                $data[] = $row["name"];
                $columns .= " , " . $row["name"];
            }
            $columns .= " , " . "imagePath";
        
        
        }




        
        $columns .= " , " . "itemStatus";



        $sql = "$columns from item_master_temp a
JOIN  itemmastercategory b ON  a.Item_Category = b.categoryId
JOIN sub_category c ON a.subCatId  = c.subCatId where a.item_code ='$id';";







        $result = mysqli_query($con, $sql);

        if (!mysqli_num_rows($result) > 0) {



            $response["error"] = "No data found";
        }

        while ($row = mysqli_fetch_assoc($result)) {


            $tbody_data[] = $row;
        }


        $subId =  $subCatId;



                $sql = "SELECT * FROM requireattributeforcatname where SubcatId = $subId;";

                $result = mysqli_query($con,$sql);

                $inputFields = [];




                while($row = mysqli_fetch_assoc($result)){
                    $inputFields[] = $row;
                }



        $response["inputFields"] = $inputFields;

        $response["tbody_data"] = $tbody_data;


        ///     


        // $result  = mysqli_query($con, $sql);



        $columns = mysqli_fetch_assoc($result);



        $response["sql"] = $sql;
        $response['columns'] = $columns;



        echo  json_encode($response);
    }
}

//this send data to main item master
if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    if (isset($_POST["submitDataTOItemMaster"])) {

        // include("db.php");
        include('./dbconnection/db.php');




        $attr  = $_POST["attrData"];;


        $itemCode = isset($attr["item_code"]) ? $attr["item_code"] : null;
        // $itemCode = isset($_GET["itemCodeGenrated"]) ? $_GET["itemCodeGenrated"] : null;
        $Item_Category = isset($attr["Item_Category"]) ? $attr["Item_Category"] : null;
        $Short_Description = isset($attr["Short_Description"]) ? $attr["Short_Description"] : null;
        $subCatId  = isset($attr["subCatId"]) ? $attr["subCatId"] : null;
        $Price  = isset($attr["Price"]) ? $attr["Price"] : null;
        $si_unit  = isset($attr["SI_unit"]) ? $attr["SI_unit"] : null;
        $material = isset($attr["Material"]) ? $attr["Material"] : null;
        $Design = isset($attr["Design"]) ? $attr["Design"] : null;
        $Finish_type = isset($attr["item_type"]) ? $attr["item_type"] : null;
        $Half_Full_Thread = isset($attr["Half_Full_Thread"]) ? $attr["Half_Full_Thread"] : null; // need t o cheng with attrbute 5
        $Holder_Thread = isset($attr["Holder_Thread"]) ? $attr["Holder_Thread"] : null;
        $Holder_type = isset($attr["Holder_type"]) ? $attr["Holder_type"] : null;
        $Thread = isset($attr["Thread"]) ? $attr["Thread"] : null;
        $brand = isset($attr["Brand"]) ? $attr["Brand"] : null;;
        // $brand = isset($attr["Brand"]) ? $attr["Brand"] : null;
        $Light_Output_colour = isset($attr["Light_Output_Colour"]) ? $attr["Light_Output_Colour"] : null;
        $Colour = isset($attr["Colour"]) ? $attr["Colour"] : null;
        $Cut = isset($attr["Cut"]) ? $attr["Cut"] : null;
        $Height = isset($attr["Height"]) ? $attr["Height"] : null;
        $Length = isset($attr["Length"]) ? $attr["Length"] : null;
        $Breadth = isset($attr["Breadth"]) ? $attr["Breadth"] : null;
        $Upper_Dia = isset($attr["Upper_Dia"]) ? $attr["Upper_Dia"] : null;
        $Bottom_Dia = isset($attr["Bottom_Dia"]) ? $attr["Bottom_Dia"] : null;
        $Centre_Hole_dia = isset($attr["Centre_Hole_dia"]) ? $attr["Centre_Hole_dia"] : null;
        $Size = isset($attr["Size"]) ? $attr["Size"] : null;
        $watt = isset($attr["Watt"]) ? $attr["Watt"] : null;
        $Shape = isset($attr["Shape"]) ? $attr["Shape"] : null;
        $Side_Hole_dia = isset($attr["Side_Hole_dia"]) ? $attr["Side_Hole_dia"] : null;
        $Top_hole_dia = isset($attr["Top_hole_dia"]) ? $attr["Top_hole_dia"] : null;
        $No_of_ply = isset($attr["No_of_ply"]) ? $attr["No_of_ply"] : null;
        $Style = isset($attr["Style"]) ? $attr["Style"] : null;
        $Thickness = isset($attr["Thickness"]) ? $attr["Thickness"] : null;
        $Weight = isset($attr["Weight"]) ? $attr["Weight"] : null;
        $Depth = isset($attr["Depth"]) ? $attr["Depth"] : null;
        $Bottom_hole_dia = isset($attr["Thickness"]) ? $attr["Thickness"] : null;
        $Core = isset($attr["Core"]) ? $attr["Core"] : null;
        $Inner_Outer_thread = isset($attr["Inner_Outer_thread"]) ? $attr["Inner_Outer_thread"] : null;
        $Upper_thread = isset($attr["Upper_thread"]) ? $attr["Upper_thread"] : null;
        $Lower_thread = isset($attr["Lower_thread"]) ? $attr["Lower_thread"] : null;
        $Thread_length = isset($attr["Thread_length"]) ? $attr["Thread_length"] : null;
        $Indian_Imported = isset($attr["Indian_Imported"]) ? $attr["Indian_Imported"] : null;
        $In_built_switch  = isset($attr["In_built_switch"]) ? $attr["In_built_switch"] : null;
        $Wire_type  = isset($attr["Wire_type"]) ? $attr["Wire_type"] : null;
        $Vendor  = isset($attr["Vendor"]) ? $attr["Vendor"] : null;
        $attribute1  = isset($attr["attribute1"]) ? $attr["attribute1"] : null;
        $attribute2  = isset($attr["attribute2"]) ? $attr["attribute2"] : null;
        $attribute3  = isset($attr["attribute3"]) ? $attr["attribute3"] : null;
        // $imagePath  =  isset($_GET["filePath"]) ? $_GET["filePath"] :   null;
        $imagePath  =  isset($attr["imagePath"]) ? $attr["imagePath"] :   null;
        $long_discription  =  isset($attr["Long_Description"]) ? $attr["Long_Description"] :   null;
        // $long_discription  =  "hekkir";
        $Pintop  =  isset($attr["Pintop"]) ? $attr["Pintop"] :   null;
        $Discount  =  isset($attr["Discount"]) ? $attr["Discount"] :   null;
        $fabric  =  isset($attr["fabric"]) ? $attr["fabric"] :   null;
        $piping  =  isset($attr["piping"]) ? $attr["piping"] :   null;
        $piping_color  =  isset($attr["piping_color"]) ? $attr["piping_color"] :   null;
        $acrylic_sheet  =  isset($attr["acrylic_sheet"]) ? $attr["acrylic_diffuser"] :   null;
        $gallery_heght  =  isset($attr["gallery_height"]) ? $attr["gallery_height"] :   null;
        $gallery  =  isset($attr["gallery"]) ? $attr["gallery"] :   null;
        $Gallery_type  =  isset($attr["Gallery_type"]) ? $attr["Gallery_type"] :   null;
        $sheet =  isset($attr["sheet"]) ? $attr["sheet"] :   null;
        $sheet_color  =  isset($attr["sheet_color"]) ? $attr["sheet_color"] :   null;
        $powder_coating  =  isset($attr["powder_coating"]) ? $attr["powder_coating"] :   null;
        $fabric_colour = isset($attr["fabric_colour"]) ? $attr["fabric_colour"] :   null;
        $colour_temparature = isset($attr["Colour_Temparature"]) ? $attr["Colour_Temparature"] :   null;
        $Dimmable = isset($attr["Dimmable"]) ? $attr["Dimmable"] :   null;
        $Location = isset($attr["Location"]) ? $attr["Location"] :   null;
        $Dimmeter = isset($attr["Diameter"]) ? $attr["Diameter"] :   null;
        $Collar = isset($attr["Collar"]) ? $attr["Collar"] :   null;
        $Socket = isset($attr["Socket"]) ? $attr["Socket"] :   null;
        $Ink_type = isset($attr["Ink_type"]) ? $attr["Ink_type"] :   null;
        $Transparent = isset($attr["Transparent"]) ? $attr["Transparent"] :   null;
        $piping_length = isset($attr["piping_length"]) ? $attr["piping_length"] :   null;
        $Lining = isset($attr["Lining"]) ? $attr["Lining"] :   null;
        $Lining_colour = isset($attr["Lining_colour"]) ? $attr["Lining_colour"] :   null;

        $departement = "departement";

        $createdBy = $_SESSION["username"];
        $createdDate = date("y-m-d");

        $itemStatus  = $attr["itemStatus"];
        /// 
        $itemId = $attr["S_No"];



        // $response["acceptes data"] = $attr;

        ////
        $response["Status"] = $itemStatus;

        if ($itemStatus == "Approve") {

            $sql = "INSERT into item_master_main (item_code,
        Item_Category,
        Short_Description,
        subCatId,
        Price,
        SI_unit,
        material,
        Design,
        item_type,
        Half_Full_Thread,
        Holder_Thread,
        Holder_type,
        Thread,
        brand,
        Light_Output_colour,
        Colour,
        Cut,
        Height,
        Length,
        Breadth,
        Upper_Dia,
        Bottom_Dia,
        Centre_Hole_dia,
        Size,
        Watt,
        Shape,
        Side_Hole_dia,
        Top_hole_dia,
        No_of_ply,
        Style,
        Thickness,
        Weight,
        Depth,
        Bottom_hole_dia,
        Core,
        Inner_Outer_thread,
        Upper_thread,
        Lower_thread,
        Thread_length,
        Indian_Imported,
        In_built_switch,
        Wire_type,
        Vendor,
        attribute1,
        attribute2,
        attribute3,
        imagePath,
        Long_Description,
        Pintop,
        Discount,
        fabric,
        fabric_colour,
        piping,
        piping_color,
        piping_length,
        Lining,
        Lining_colour,
        acrylic_sheet,
        gallery_heght,
        gallery,
        Gallery_type,
        sheet_color,
        powder_coating,
        departement,
        Transparent,
        colour_temparature,
        Dimmable,
        Collar,
        Socket,
        Ink_type,
        Location,
        createdBy,
        createdDate,
        itemStatus

        ) 
        values ('$itemCode',
        '$Item_Category',
        '$Short_Description',
        '$subCatId',
        '$Price',
        '$si_unit',
        '$material',
         '$Design' ,
        '$Finish_type',
        '$Half_Full_Thread',
        '$Holder_Thread',
        '$Holder_type',
        '$Thread',
        '$brand',
        '$Light_Output_colour',
        '$Colour',
        '$Cut',
        '$Height',
        '$Length',
        '$Breadth',
        '$Upper_Dia' ,
        '$Bottom_Dia',
        '$Centre_Hole_dia',
        '$Size',
        '$watt',
        '$Shape',
        '$Side_Hole_dia',
        '$Top_hole_dia',
        '$No_of_ply',
        '$Style',
        '$Thickness',
        '$Weight',
        '$Depth',
        '$Bottom_hole_dia',
        '$Core',
        '$Inner_Outer_thread',
        '$Upper_thread',
        '$Lower_thread',
        '$Thread_length',
        '$Indian_Imported',
        '$In_built_switch',
        '$Wire_type',
        '$Vendor',
        '$attribute1',
        '$attribute2',
        '$attribute3',
        '$imagePath',
        '$long_discription',
        '$Pintop',
        '$Discount',
        '$fabric',
        '$fabric_colour',
        '$piping',
        '$piping_color',
        '$piping_length',
        '$Lining',
        '$Lining_colour',
        '$acrylic_sheet',
        '$gallery_heght',
        '$gallery',
        '$Gallery_type',
        '$sheet_color',
        '$powder_coating',
        '$departement',
        '$Transparent',
        '$colour_temparature',
        '$Dimmable',
        '$Collar',
        '$Socket',
        '$Ink_type',
        '$Location',
        '$createdBy',
        '$createdDate',
        '$itemStatus'
        )";









            $result = mysqli_query($con, $sql);


            if ($result) {







                $sql = "update item_master_temp set itemStatus='Approve' where S_No= $itemId;";


                $result1 = mysqli_query($con, $sql);




                if ($result1) {
                    $response["success"] = true;
                    $response["message"] = "data inserted successfully";
                }
            } else {
                $response["success"] = "false";
            }
            $response["success"] = true;
        } else {
            $response[] = "Item  hav been rejectd";
        }
        if ($itemStatus == "Reject") {


            $sql = "update item_master_temp set itemStatus='$itemStatus' where S_No= $itemId;";


            $result1 = mysqli_query($con, $sql);
            $response["success"] = true;


            if ($result1) {
                $response[] =  "reject Itemm has been success fully up dated";
            }
        }

        $response["attr"] = $attr;
        // $response["sql"] = $sql;


        $response["itemMasterId"] = mysqli_insert_id($con);








        echo json_encode($response);
    } else if (isset($_FILES)) {





        if (isset($_FILES["itemImage"])) {

            $targetDir = "images/";

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
                } else {
                    $response["data"] = "There was an error moving the uploaded file.";
                }
            } else {
                $response["data"] = "There was an error during the file upload.";
            }

            // Output the response as JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}
